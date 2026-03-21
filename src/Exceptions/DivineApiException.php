<?php

declare(strict_types=1);

namespace DivineApi\Exceptions;

use Exception;

class DivineApiException extends Exception
{
    protected array $responseBody;

    public function __construct(string $message = '', int $code = 0, array $responseBody = [], ?\Throwable $previous = null)
    {
        $this->responseBody = $responseBody;
        parent::__construct($message, $code, $previous);
    }

    public function getResponseBody(): array
    {
        return $this->responseBody;
    }
}
