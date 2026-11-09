<?php

declare(strict_types=1);

namespace DivineApi\Api;

use DivineApi\HttpClient;

/**
 * Location API endpoints (geolocation.divineapi.com): place name -> coordinates and timezone.
 *
 * #238.
 */
class LocationApi
{
    private const HOST = 'geolocation.divineapi.com';

    private HttpClient $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * #238 Location Search
     *
     * Returns up to 10 matches, largest population first, under data.results:
     * each has place_id, name, full_name, country, admin1, latitude, longitude,
     * timezone (IANA name), timezone_value and population, plus the GeoNames
     * attribution (CC BY 4.0).
     *
     * timezone_value is the zone's UTC offset today. For a birth date in a zone
     * with summer time it can differ by an hour, so compute the offset for the
     * birth date from timezone before using it as tzone.
     *
     * @param array{place: string} $params place: at least 3 characters
     */
    public function search(array $params): array
    {
        return $this->http->post(self::HOST, '/location', $params);
    }
}
