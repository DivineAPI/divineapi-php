<?php

declare(strict_types=1);

namespace DivineApi\Api\Western;

use DivineApi\HttpClient;

/**
 * Western Prenatal API endpoints (astroapi-8.divineapi.com)
 *
 * #170-171.
 */
class PrenatalApi
{
    private const HOST = 'astroapi-8.divineapi.com';

    private HttpClient $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * #170 Prenatal List
     * @param array Birth params + prenatal_type
     */
    public function prenatalList(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v1/prenatal-list', $params);
    }

    /**
     * #171 Prenatal Details
     * @param array Birth params + prenatal_key
     */
    public function prenatalDetails(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v1/prenatal-details', $params);
    }
}
