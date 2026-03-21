<?php

declare(strict_types=1);

namespace DivineApi\Api\Western;

use DivineApi\HttpClient;

/**
 * Western Planet Returns API endpoints (astroapi-8.divineapi.com)
 *
 * #165-166. Accept birth params + planet + return params.
 */
class PlanetReturnsApi
{
    private const HOST = 'astroapi-8.divineapi.com';

    private HttpClient $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * #165 Planet Returns List
     * @param array Birth params + planet + return params
     */
    public function planetReturnsList(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v1/planet-returns-list', $params);
    }

    /**
     * #166 Planet Return Details
     * @param array Birth params + planet + return params
     */
    public function planetReturnDetails(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v1/planet-return-details', $params);
    }
}
