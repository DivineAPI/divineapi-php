<?php

declare(strict_types=1);

namespace DivineApi\Api;

use DivineApi\Exceptions\ValidationException;
use DivineApi\HttpClient;

/**
 * Location API endpoints (geolocation.divineapi.com): place search, the timezone
 * offset on a date, and the service health.
 *
 * #238, #244, #245.
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
     * with summer time it can differ by an hour, so get the offset for the
     * birth date with timezone() before using it as tzone.
     *
     * @param array{place: string} $params place: at least 3 characters
     */
    public function search(array $params): array
    {
        return $this->http->post(self::HOST, '/location', $params);
    }

    /**
     * #244 Timezone
     *
     * The UTC offset that applied at a place on a local date and time, with
     * summer time (DST) and historical changes: data.timezone_value is the
     * tzone to send for a birth date.
     *
     * The place is one of: place_id from search() (the documented input),
     * lat + lon (the nearest known place), or timezone (an IANA name such as
     * 'America/New_York'). None or several throws a ValidationException
     * (with several, the API would silently use place_id). Give day, month,
     * year, hour and min together (sec defaults to 0), or none of them for
     * the current time.
     *
     * data holds place (null for a timezone name), timezone, local_datetime,
     * utc_datetime, timezone_value (decimal hours, e.g. 5.5 or -4),
     * utc_offset (e.g. '+05:30'), is_dst and ambiguous.
     * - ambiguous is true when the local time happened twice (clocks went
     *   back): the first of the two is used.
     * - A local time skipped when the clocks went forward is a
     *   ValidationException (HTTP 422).
     * - An unknown place_id is a DivineApiException with code 404.
     *
     * @param array{place_id?: int, lat?: float, lon?: float, timezone?: string, day?: int, month?: int, year?: int, hour?: int, min?: int, sec?: int} $params
     * @throws ValidationException
     */
    public function timezone(array $params): array
    {
        $filled = static fn ($v): bool => $v !== null && trim((string) $v) !== '';
        $given = [];
        if ($filled($params['place_id'] ?? null)) {
            $given[] = 'place_id';
        }
        if ($filled($params['lat'] ?? null) || $filled($params['lon'] ?? null)) {
            $given[] = 'lat/lon';
        }
        if ($filled($params['timezone'] ?? null)) {
            $given[] = 'timezone';
        }
        if (count($given) !== 1) {
            throw new ValidationException(
                'Give exactly one of place_id, lat and lon, or timezone'
                . ($given ? ' (got ' . implode(' and ', $given) . ')' : '')
            );
        }
        if (isset($params['timezone']) && is_string($params['timezone'])) {
            $params['timezone'] = trim($params['timezone']);
        }

        return $this->http->post(self::HOST, '/timezone', array_filter(
            $params,
            static fn ($v): bool => $v !== null
        ));
    }

    /**
     * #245 Geo-location Health
     *
     * Checks that the Location API service is up (GET /health). Needs no
     * credentials and uses no credits. When healthy, data is
     * ['service' => 'location-api', 'status' => 'ok'].
     */
    public function health(): array
    {
        return $this->http->get(self::HOST, '/health');
    }
}
