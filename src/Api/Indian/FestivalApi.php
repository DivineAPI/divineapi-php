<?php

declare(strict_types=1);

namespace DivineApi\Api\Indian;

use DivineApi\HttpClient;

/**
 * Indian Festival API endpoints (astroapi-3.divineapi.com)
 *
 * Covers: Hindu month festivals, English calendar festivals, date-specific festivals, and find-festival.
 */
class FestivalApi
{
    private const HOST = 'astroapi-3.divineapi.com';

    private HttpClient $http;

    private const HINDU_MONTHS = [
        'margashirsh', 'ashvina', 'magha', 'phalguna', 'chaitra',
        'vaishakha', 'jyeshtha', 'ashada', 'shraavana', 'bhadrapada',
        'kartika', 'pausha',
    ];

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    // ─── Hindu Month Festivals (#57-68) ──────────────────────────

    /**
     * Get festivals for a specific Hindu month.
     * @param string $month Hindu month name (e.g., 'margashirsh', 'chaitra')
     * @param array{year: int, place: string, lat: float, lon: float, tzone: float} $params
     */
    public function hinduMonthFestivals(string $month, array $params): array
    {
        return $this->http->post(self::HOST, "/indian-api/v2/{$month}-festivals", $params);
    }

    /** #57 Margashirsh Festivals */
    public function margashirshFestivals(array $params): array
    {
        return $this->hinduMonthFestivals('margashirsh', $params);
    }

    /** #58 Ashvina Festivals */
    public function ashvinaFestivals(array $params): array
    {
        return $this->hinduMonthFestivals('ashvina', $params);
    }

    /** #59 Magha Festivals */
    public function maghaFestivals(array $params): array
    {
        return $this->hinduMonthFestivals('magha', $params);
    }

    /** #60 Phalguna Festivals */
    public function phalgunaFestivals(array $params): array
    {
        return $this->hinduMonthFestivals('phalguna', $params);
    }

    /** #61 Chaitra Festivals */
    public function chaitraFestivals(array $params): array
    {
        return $this->hinduMonthFestivals('chaitra', $params);
    }

    /** #62 Vaishakha Festivals */
    public function vaishakhaFestivals(array $params): array
    {
        return $this->hinduMonthFestivals('vaishakha', $params);
    }

    /** #63 Jyeshtha Festivals */
    public function jyeshthaFestivals(array $params): array
    {
        return $this->hinduMonthFestivals('jyeshtha', $params);
    }

    /** #64 Ashada Festivals */
    public function ashadaFestivals(array $params): array
    {
        return $this->hinduMonthFestivals('ashada', $params);
    }

    /** #65 Shraavana Festivals */
    public function shraavanaFestivals(array $params): array
    {
        return $this->hinduMonthFestivals('shraavana', $params);
    }

    /** #66 Bhadrapada Festivals */
    public function bhadrapadaFestivals(array $params): array
    {
        return $this->hinduMonthFestivals('bhadrapada', $params);
    }

    /** #67 Kartika Festivals */
    public function kartikaFestivals(array $params): array
    {
        return $this->hinduMonthFestivals('kartika', $params);
    }

    /** #68 Pausha Festivals */
    public function paushaFestivals(array $params): array
    {
        return $this->hinduMonthFestivals('pausha', $params);
    }

    // ─── Calendar Festivals ──────────────────────────────────────

    /**
     * #69 English Calendar Festivals
     * @param array{year: int, month: int, place: string, lat: float, lon: float, tzone: float} $params
     */
    public function englishCalendar(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/english-calendar-festivals', $params);
    }

    /**
     * #70 Date Specific Festivals
     * @param array{year: int, month: int, day: int, place: string, lat: float, lon: float, tzone: float} $params
     */
    public function dateSpecific(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/date-specific-festivals', $params);
    }

    /**
     * #71 Festival Specific
     * @param array{year: int, place: string, lat: float, lon: float, tzone: float, festival: string} $params
     */
    public function findFestival(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/find-festival', $params);
    }
}
