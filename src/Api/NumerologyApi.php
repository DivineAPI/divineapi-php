<?php

declare(strict_types=1);

namespace DivineApi\Api;

use DivineApi\HttpClient;

/**
 * Numerology API endpoints.
 *
 * #188-189 Mobile (astroapi-7), #190-201 Chaldean (astroapi-7),
 * #202 Core Numbers (astroapi-4).
 */
class NumerologyApi
{
    private HttpClient $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    // ─── Mobile Numerology (#188-189) ───────────────────────────

    /**
     * #188 New Mobile Number
     * @param array{fname: string, lname: string, day: int, month: int, year: int} $params
     */
    public function newMobileNumber(array $params): array
    {
        return $this->http->post('astroapi-7.divineapi.com', '/numerology/v1/new-mobile-number', $params);
    }

    /**
     * #189 Analyze Mobile Number
     * @param array{fname: string, lname: string, day: int, month: int, year: int, mobile_number: string} $params
     */
    public function analyzeMobileNumber(array $params): array
    {
        return $this->http->post('astroapi-7.divineapi.com', '/numerology/v1/analyze-mobile-number', $params);
    }

    // ─── Chaldean Numerology (#190-201) ─────────────────────────

    /**
     * #190 Loshu Grid
     * @param array{day: int, month: int, year: int, fname: string, lname: string, lan?: string} $params
     */
    public function loshuGrid(array $params): array
    {
        return $this->http->post('astroapi-7.divineapi.com', '/numerology/v1/loshu-grid', $params);
    }

    /**
     * #191 Zodiac Planet Number
     */
    public function zodiacPlanetNumber(array $params): array
    {
        return $this->http->post('astroapi-7.divineapi.com', '/numerology/v1/zodiac-planet-number', $params);
    }

    /**
     * #192 Luck Numerology
     */
    public function luckNumerology(array $params): array
    {
        return $this->http->post('astroapi-7.divineapi.com', '/numerology/v1/luck-numerology', $params);
    }

    /**
     * #193 Name Number
     */
    public function nameNumber(array $params): array
    {
        return $this->http->post('astroapi-7.divineapi.com', '/numerology/v1/name-number', $params);
    }

    /**
     * #194 Birthday Number
     */
    public function birthdayNumber(array $params): array
    {
        return $this->http->post('astroapi-7.divineapi.com', '/numerology/v1/birthday-number', $params);
    }

    /**
     * #195 Missing Numbers
     */
    public function missingNumbers(array $params): array
    {
        return $this->http->post('astroapi-7.divineapi.com', '/numerology/v1/missing-numbers', $params);
    }

    /**
     * #196 Driver and Conductor Numbers
     */
    public function driverAndConductorNumbers(array $params): array
    {
        return $this->http->post('astroapi-7.divineapi.com', '/numerology/v1/driver-and-conductor-numbers', $params);
    }

    /**
     * #197 Two Numbers Arrows
     */
    public function twoNumbersArrows(array $params): array
    {
        return $this->http->post('astroapi-7.divineapi.com', '/numerology/v1/two-numbers-arrows', $params);
    }

    /**
     * #198 Three Numbers Arrows
     */
    public function threeNumbersArrows(array $params): array
    {
        return $this->http->post('astroapi-7.divineapi.com', '/numerology/v1/three-numbers-arrows', $params);
    }

    /**
     * #199 Repeating Numbers
     */
    public function repeatingNumbers(array $params): array
    {
        return $this->http->post('astroapi-7.divineapi.com', '/numerology/v1/repeating-numbers', $params);
    }

    /**
     * #200 Yearly Prediction
     */
    public function yearlyPrediction(array $params): array
    {
        return $this->http->post('astroapi-7.divineapi.com', '/numerology/v1/yearly-prediction', $params);
    }

    /**
     * #201 Gemstones
     */
    public function gemstones(array $params): array
    {
        return $this->http->post('astroapi-7.divineapi.com', '/numerology/v1/gemstones', $params);
    }

    // ─── Core Numbers (#202) ────────────────────────────────────

    /**
     * #202 Core Numbers
     * @param array{full_name: string, day: int, month: int, year: int, gender: string, method: string} $params
     */
    public function coreNumbers(array $params): array
    {
        return $this->http->post('astroapi-4.divineapi.com', '/numerology/v1/core-numbers', $params);
    }
}
