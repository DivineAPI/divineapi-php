<?php

declare(strict_types=1);

namespace DivineApi\Api\Indian;

use DivineApi\HttpClient;

/**
 * Indian Match Making API endpoints (astroapi-3.divineapi.com)
 *
 * All methods accept couple params: p1_* and p2_* (full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone) + lan
 */
class MatchMakingApi
{
    private const HOST = 'astroapi-3.divineapi.com';

    private HttpClient $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * #110 Ashtakoot Milan
     */
    public function ashtakootMilan(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/ashtakoot-milan', $params);
    }

    /**
     * #111 Dashakoot Milan
     */
    public function dashakootMilan(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/dashakoot-milan', $params);
    }

    /**
     * #112 Nav Pancham Yoga
     */
    public function navPanchamYoga(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/nav-pancham-yoga', $params);
    }

    /**
     * #113 Matching Basic Astro Details
     */
    public function matchingBasicAstroDetails(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v3/matching/basic-astro-details', $params);
    }

    /**
     * #114 Matching Planetary Positions
     */
    public function matchingPlanetaryPositions(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/matching/planetary-positions', $params);
    }

    /**
     * #115 Matching Vimshottari Dasha
     */
    public function matchingVimshottariDasha(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/matching/vimshottari-dasha', $params);
    }

    /**
     * #116 Matching Manglik Dosha
     */
    public function matchingManglikDosha(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/matching/manglik-dosha', $params);
    }

    /**
     * #117 Matching Horoscope Chart
     * @param string $chartId Chart identifier
     */
    public function matchingHoroscopeChart(string $chartId, array $params): array
    {
        return $this->http->post(self::HOST, "/indian-api/v1/matching/horoscope-chart/{$chartId}", $params);
    }
}
