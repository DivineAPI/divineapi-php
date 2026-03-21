<?php

declare(strict_types=1);

namespace DivineApi;

use DivineApi\Api\HoroscopeApi;
use DivineApi\Api\Indian\IndianApi;
use DivineApi\Api\Western\WesternApi;
use DivineApi\Api\PdfReportApi;
use DivineApi\Api\NumerologyApi;
use DivineApi\Api\LifestyleApi;
use DivineApi\Api\CalculatorApi;

/**
 * Divine API PHP SDK
 *
 * Main client class providing access to all API modules.
 *
 * Usage:
 *   $client = new \DivineApi\DivineApi('your-api-key', 'your-auth-token');
 *   $result = $client->horoscope()->dailyHoroscope([...]);
 *   $result = $client->indian()->panchang()->findPanchang([...]);
 *   $result = $client->western()->natal()->planetaryPositions([...]);
 */
class DivineApi
{
    private HttpClient $http;
    private ?HoroscopeApi $horoscope = null;
    private ?IndianApi $indian = null;
    private ?WesternApi $western = null;
    private ?PdfReportApi $pdfReport = null;
    private ?NumerologyApi $numerology = null;
    private ?LifestyleApi $lifestyle = null;
    private ?CalculatorApi $calculator = null;

    /**
     * Create a new DivineApi client.
     *
     * @param string $apiKey Your Divine API key (sent as api_key in form body)
     * @param string $authToken Your Bearer auth token (sent in Authorization header)
     * @param int $timeout HTTP request timeout in seconds (default: 30)
     */
    public function __construct(string $apiKey, string $authToken, int $timeout = 30)
    {
        $this->http = new HttpClient($apiKey, $authToken, $timeout);
    }

    /**
     * Horoscope & Tarot API (29 endpoints)
     * Daily/Weekly/Monthly/Yearly Horoscope, Chinese, Numerology Horoscope,
     * Tarot, Fortune, Coffee, and various readings.
     */
    public function horoscope(): HoroscopeApi
    {
        if ($this->horoscope === null) {
            $this->horoscope = new HoroscopeApi($this->http);
        }
        return $this->horoscope;
    }

    /**
     * Indian API (Panchang, Kundli, MatchMaking, Festivals)
     * Access sub-modules via: indian()->panchang(), indian()->kundli(), etc.
     */
    public function indian(): IndianApi
    {
        if ($this->indian === null) {
            $this->indian = new IndianApi($this->http);
        }
        return $this->indian;
    }

    /**
     * Western API (Natal, Synastry, Transit, Composite, PlanetReturns, Progressions, Prenatal)
     * Access sub-modules via: western()->natal(), western()->synastry(), etc.
     */
    public function western(): WesternApi
    {
        if ($this->western === null) {
            $this->western = new WesternApi($this->http);
        }
        return $this->western;
    }

    /**
     * PDF Report API (13 endpoints)
     * Kundali reports, match making, vedic predictions, astrology & numerology reports.
     */
    public function pdfReport(): PdfReportApi
    {
        if ($this->pdfReport === null) {
            $this->pdfReport = new PdfReportApi($this->http);
        }
        return $this->pdfReport;
    }

    /**
     * Numerology API (15 endpoints)
     * Mobile numerology, Chaldean numerology, and Core Numbers.
     */
    public function numerology(): NumerologyApi
    {
        if ($this->numerology === null) {
            $this->numerology = new NumerologyApi($this->http);
        }
        return $this->numerology;
    }

    /**
     * Lifestyle API (3 endpoints)
     * Zodiac Gift Guru, Beauty By The Stars, Astro Chic Picks.
     */
    public function lifestyle(): LifestyleApi
    {
        if ($this->lifestyle === null) {
            $this->lifestyle = new LifestyleApi($this->http);
        }
        return $this->lifestyle;
    }

    /**
     * Calculator API (2 endpoints)
     * FLAMES Calculator, Love Calculator.
     */
    public function calculator(): CalculatorApi
    {
        if ($this->calculator === null) {
            $this->calculator = new CalculatorApi($this->http);
        }
        return $this->calculator;
    }
}
