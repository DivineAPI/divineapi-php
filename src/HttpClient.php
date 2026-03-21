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

        try {
            $response = $this->client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->authToken,
                    'Accept' => 'application/json',
                ],
                'multipart' => $this->buildMultipart($params),
            ]);

            $body = (string) $response->getBody();
            $decoded = json_decode($body, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new DivineApiException(
                    'Failed to decode API response: ' . json_last_error_msg(),
                    $response->getStatusCode()
                );
            }

            return $decoded;
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $body = (string) $e->getResponse()->getBody();
            $decoded = json_decode($body, true) ?? [];

            $message = $decoded['message'] ?? $decoded['error'] ?? $e->getMessage();

            if ($statusCode === 401 || $statusCode === 403) {
                throw new AuthenticationException($message, $statusCode, $decoded, $e);
            }

            if ($statusCode === 422 || $statusCode === 400) {
                throw new ValidationException($message, $statusCode, $decoded, $e);
            }

            throw new DivineApiException($message, $statusCode, $decoded, $e);
        } catch (GuzzleException $e) {
            throw new DivineApiException(
                'HTTP request failed: ' . $e->getMessage(),
                (int) $e->getCode(),
                [],
                $e
            );
        }
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
