<?php

declare(strict_types=1);

namespace DivineApi\Api;

use DivineApi\HttpClient;

/**
 * Lifestyle API endpoints (astroapi-7.divineapi.com)
 *
 * #185-187.
 */
class LifestyleApi
{
    private const HOST = 'astroapi-7.divineapi.com';

    private HttpClient $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * #185 Zodiac Gift Guru
     * @param array{sign: string, h_day: string, tzone: float, lan?: string} $params
     */
    public function zodiacGiftGuru(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v1/zodiac-gift-guru', $params);
    }

    /**
     * #186 Beauty By The Stars
     * @param array{sign: string, h_day: string, tzone: float, lan?: string} $params
     */
    public function beautyByTheStars(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v1/beauty-by-the-stars', $params);
    }

    /**
     * #187 Astro Chic Picks
     * @param array{sign: string, h_day: string, tzone: float, lan?: string} $params
     */
    public function astroChicPicks(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v1/astro-chic-picks', $params);
    }
}
