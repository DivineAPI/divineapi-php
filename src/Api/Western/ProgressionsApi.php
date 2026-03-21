<?php

declare(strict_types=1);

namespace DivineApi\Api\Western;

use DivineApi\HttpClient;

/**
 * Western Progressions API endpoints (astroapi-8.divineapi.com)
 *
 * #167-169.
 */
class ProgressionsApi
{
    private const HOST = 'astroapi-8.divineapi.com';

    private HttpClient $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * #167 Progressed Lunar Events
     */
    public function progressedLunarEvents(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v1/progressed-lunar-events', $params);
    }

    /**
     * #168 Planetary Arc Directions
     */
    public function planetaryArcDirections(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v1/planetary-arc-directions', $params);
    }

    /**
     * #169 Secondary Progressions
     */
    public function secondaryProgressions(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v1/secondary-progressions', $params);
    }
}
