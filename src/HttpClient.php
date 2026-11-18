<?php

declare(strict_types=1);

namespace DivineApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use DivineApi\Exceptions\AuthenticationException;
use DivineApi\Exceptions\DivineApiException;
use DivineApi\Exceptions\ValidationException;

class HttpClient
{
    protected string $apiKey;
    protected string $authToken;
    protected Client $client;
    protected int $timeout;

    public function __construct(string $apiKey, string $authToken, int $timeout = 30)
    {
        $this->apiKey = $apiKey;
        $this->authToken = $authToken;
        $this->timeout = $timeout;
        $this->client = new Client([
            'timeout' => $this->timeout,
            'http_errors' => true,
        ]);
    }

    /**
     * Send a POST request with form-data.
     *
     * @param string $host The base host (e.g., 'astroapi-5.divineapi.com')
     * @param string $path The endpoint path (e.g., '/api/v5/daily-horoscope')
     * @param array $params Form parameters (api_key is added automatically)
     * @return array Decoded JSON response
     * @throws DivineApiException
     * @throws AuthenticationException
     * @throws ValidationException
     */
    public function post(string $host, string $path, array $params = []): array
    {
        $url = "https://{$host}{$path}";

        $params['api_key'] = $this->apiKey;

        return $this->send($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->authToken,
                'Accept' => 'application/json',
            ],
            'multipart' => $this->buildMultipart($params),
        ]);
    }

    /**
     * POST a JSON body with the API key in an x-api-key header.
     *
     * Used by Reports V2 (/api/v1/reports/generate and /api/v1/western/reports/generate),
     * which rejects form-encoded requests with 401 "x-api-key header required", and by
     * the Astro Chatbot (ask.divineapi.com).
     *
     * @throws DivineApiException
     * @throws AuthenticationException
     * @throws ValidationException
     */
    public function postJson(string $host, string $path, array $body = []): array
    {
        return $this->send("https://{$host}{$path}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->authToken,
                'x-api-key' => $this->apiKey,
                'Accept' => 'application/json',
            ],
            // An empty PHP array would be sent as [], not the JSON object {}.
            'json' => $body ?: new \stdClass(),
        ]);
    }

    /**
     * POST a JSON body like postJson() and read a Server-Sent Events reply.
     *
     * The request is sent when iteration starts. Yields each event's JSON data
     * payload, decoded to an array, as it arrives; a reply that is plain JSON
     * instead of a stream is yielded as one event. The timeout applies to each
     * wait for data. Leaving the loop early closes the connection.
     *
     * @return \Generator<int, array>
     * @throws DivineApiException
     * @throws AuthenticationException
     * @throws ValidationException
     */
    public function postJsonStream(string $host, string $path, array $body = []): \Generator
    {
        $url = "https://{$host}{$path}";
        try {
            $response = $this->client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->authToken,
                    'x-api-key' => $this->apiKey,
                    'Accept' => 'text/event-stream',
                ],
                'json' => $body ?: new \stdClass(),
                'stream' => true,
                'read_timeout' => $this->timeout,
            ]);
        } catch (GuzzleException $e) {
            throw $this->toException($e);
        }

        $stream = $response->getBody();
        try {
            if (!str_contains($response->getHeaderLine('Content-Type'), 'text/event-stream')) {
                yield $this->decode((string) $stream, $response->getStatusCode());
                return;
            }

            $line = '';
            $dataLines = [];
            while (!$stream->eof()) {
                // One byte at a time: through PHP's chunked-transfer filter a larger
                // read waits until that many bytes have arrived, which would hold
                // every event back until the answer is complete. The bytes come
                // from PHP's own read buffer, so this costs little.
                try {
                    $byte = $stream->read(1);
                } catch (\RuntimeException $e) {
                    throw new DivineApiException("Stream from {$url} broke off: " . $e->getMessage(), 0, [], $e);
                }
                if ($byte === '') {
                    if ($stream->getMetadata('timed_out')) {
                        throw new DivineApiException("Stream from {$url} timed out after {$this->timeout}s");
                    }
                    continue;
                }
                if ($byte !== "\n") {
                    $line .= $byte;
                    continue;
                }
                $line = rtrim($line, "\r");
                if (str_starts_with($line, 'data:')) {
                    $dataLines[] = str_starts_with($line, 'data: ') ? substr($line, 6) : substr($line, 5);
                } elseif ($line === '' && $dataLines) {
                    yield $this->parseEvent($dataLines, $url);
                    $dataLines = [];
                }
                $line = '';
            }
            $line = rtrim($line, "\r");
            if (str_starts_with($line, 'data:')) {
                $dataLines[] = str_starts_with($line, 'data: ') ? substr($line, 6) : substr($line, 5);
            }
            if ($dataLines) {
                yield $this->parseEvent($dataLines, $url);
            }
        } finally {
            $stream->close();
        }
    }

    /**
     * Send the request and map HTTP failures to SDK exceptions.
     */
    private function send(string $url, array $options): array
    {
        try {
            $response = $this->client->post($url, $options);
        } catch (GuzzleException $e) {
            throw $this->toException($e);
        }

        return $this->decode((string) $response->getBody(), $response->getStatusCode());
    }

    /**
     * Decode a JSON response body.
     */
    private function decode(string $body, int $statusCode): array
    {
        $decoded = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new DivineApiException(
                'Failed to decode API response: ' . json_last_error_msg(),
                $statusCode
            );
        }

        return $decoded;
    }

    /**
     * Decode the joined data lines of one Server-Sent Event.
     */
    private function parseEvent(array $dataLines, string $url): array
    {
        $data = implode("\n", $dataLines);
        $decoded = json_decode($data, true);
        if (!is_array($decoded)) {
            throw new DivineApiException("Unreadable event in the stream from {$url}: " . substr($data, 0, 200));
        }

        return $decoded;
    }

    /**
     * Map a Guzzle failure to the matching SDK exception.
     */
    private function toException(GuzzleException $e): DivineApiException
    {
        if ($e instanceof ClientException) {
            $statusCode = $e->getResponse()->getStatusCode();
            $body = (string) $e->getResponse()->getBody();
            $decoded = json_decode($body, true);
            $decoded = is_array($decoded) ? $decoded : [];

            $message = $decoded['message'] ?? $decoded['error'] ?? self::detailMessage($decoded['detail'] ?? null);
            if (!is_string($message) || $message === '') {
                $message = $e->getMessage();
            }

            if ($statusCode === 401 || $statusCode === 403) {
                return new AuthenticationException($message, $statusCode, $decoded, $e);
            }

            if ($statusCode === 422 || $statusCode === 400) {
                return new ValidationException($message, $statusCode, $decoded, $e);
            }

            return new DivineApiException($message, $statusCode, $decoded, $e);
        }

        return new DivineApiException(
            'HTTP request failed: ' . $e->getMessage(),
            (int) $e->getCode(),
            [],
            $e
        );
    }

    /**
     * Text of a FastAPI "detail" (ask.divineapi.com errors): a string, or a list
     * of field errors such as [{"loc": ["body", "user_id"], "msg": "Field required"}].
     *
     * @param mixed $detail
     */
    private static function detailMessage($detail): string
    {
        if (is_string($detail)) {
            return $detail;
        }
        if (!is_array($detail)) {
            return '';
        }
        $parts = [];
        foreach ($detail as $item) {
            if (is_array($item)) {
                $loc = isset($item['loc']) && is_array($item['loc']) ? $item['loc'] : [];
                $field = $loc ? (string) end($loc) : '';
                $msg = isset($item['msg']) ? (string) $item['msg'] : '';
                $parts[] = $field !== '' ? "{$field}: {$msg}" : $msg;
            } elseif (is_scalar($item)) {
                $parts[] = (string) $item;
            }
        }

        return implode('; ', array_filter($parts, static fn ($p) => $p !== ''));
    }

    /**
     * Convert associative array to Guzzle multipart format.
     */
    protected function buildMultipart(array $params): array
    {
        $multipart = [];
        foreach ($params as $name => $value) {
            if ($value === null) {
                continue;
            }
            $multipart[] = [
                'name' => (string) $name,
                'contents' => (string) $value,
            ];
        }
        return $multipart;
    }
}
