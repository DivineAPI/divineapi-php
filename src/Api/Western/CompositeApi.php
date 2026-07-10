<?php

declare(strict_types=1);

namespace DivineApi\Api\Western;

use DivineApi\HttpClient;

/**
 * Western Composite API endpoints (astroapi-8.divineapi.com)
 *
 * #161-164. All accept couple params.
 */
class CompositeApi
{
    private const HOST = 'astroapi-8.divineapi.com';

    private HttpClient $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * #161 Composite Planetary Positions
     */
    public function planetaryPositions(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v1/composite/planetary-positions', HouseSystem::apply($params));
    }

    /**
     * #162 Composite House Cusps
     */
    public function houseCusps(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v1/composite/house-cusps', HouseSystem::apply($params));
    }

    /**
     * #163 Composite Aspect Table
     */
    public function aspectTable(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v1/composite/aspect-table', HouseSystem::apply($params));
    }

    /**
     * #164 Composite Natal Wheel Chart
     */
    public function natalWheelChart(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v1/composite/natal-wheel-chart', HouseSystem::apply($params));
    }
}
