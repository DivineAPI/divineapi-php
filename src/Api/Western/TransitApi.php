<?php

declare(strict_types=1);

namespace DivineApi\Api\Western;

use DivineApi\HttpClient;

/**
 * Western Transit API endpoints.
 *
 * #152-155,160 on astroapi-4; #156-159 on astroapi-8.
 */
class TransitApi
{
    private HttpClient $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * #152 Basic Transit
     * @param array Birth params + transit dates
     */
    public function basic(array $params): array
    {
        return $this->http->post('astroapi-4.divineapi.com', '/western-api/v1/transit/basic', $params);
    }

    /**
     * #153 Daily Transit
     */
    public function daily(array $params): array
    {
        return $this->http->post('astroapi-4.divineapi.com', '/western-api/v1/transit/daily', $params);
    }

    /**
     * #154 Weekly Transit
     * @param array Birth params + transit_planet
     */
    public function weekly(array $params): array
    {
        return $this->http->post('astroapi-4.divineapi.com', '/western-api/v1/transit/weekly', $params);
    }

    /**
     * #155 Monthly Transit
     * @param array Birth params + extensive params
     */
    public function monthly(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v2/transit/monthly', $params);
    }

    /**
     * #156 Full Transit
     * @param array Birth params + extensive params
     */
    public function full(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v1/full-transit', $params);
    }

    /**
     * Planetary Ingress
     * @param array{planet: string, month: int, year: int, place: string, lat: float, lon: float, tzone: float} $params
     */
    public function planetaryIngress(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v1/planetary-ingress', $params);
    }

    /**
     * #157 Planet Retrograde Transit (Western)
     * @param array{planet: string, month: int, year: int, place: string, lat: float, lon: float, tzone: float} $params
     */
    public function planetRetrogradeTransit(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v1/planet-retrograde-transit', $params);
    }

    /**
     * #158-159 Planet Combustion Transit (Western)
     * @param array{planet: string, month: int, year: int, place: string, lat: float, lon: float, tzone: float} $params
     */
    public function planetCombustionTransit(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v1/planet-combustion-transit', $params);
    }

    /**
     * Transit Wheel Chart
     */
    public function wheelChart(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v1/transit/wheel-chart', $params);
    }

    /**
     * Transit Planetary Positions
     */
    public function planetaryPositions(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v1/transit/planetary-positions', $params);
    }

    /**
     * #160 Transit House
     * @param array Birth params + full transit params
     */
    public function house(array $params): array
    {
        return $this->http->post('astroapi-4.divineapi.com', '/western-api/v1/transit/house', $params);
    }
}
