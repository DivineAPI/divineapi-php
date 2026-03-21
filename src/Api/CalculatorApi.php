<?php

declare(strict_types=1);

namespace DivineApi\Api;

use DivineApi\HttpClient;

/**
 * Calculator API endpoints (astroapi-7.divineapi.com)
 *
 * #211-212.
 */
class CalculatorApi
{
    private const HOST = 'astroapi-7.divineapi.com';

    private HttpClient $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * #211 FLAMES Calculator
     * @param array{full_name: string, partner_name: string} $params
     */
    public function flamesCalculator(array $params): array
    {
        return $this->http->post(self::HOST, '/calculator/v1/flames-calculator', $params);
    }

    /**
     * #212 Love Calculator
     * @param array{your_name: string, partner_name: string, your_gender: string, partner_gender: string} $params
     */
    public function loveCalculator(array $params): array
    {
        return $this->http->post(self::HOST, '/calculator/v1/love-calculator', $params);
    }
}
