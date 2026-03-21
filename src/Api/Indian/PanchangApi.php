<?php

declare(strict_types=1);

namespace DivineApi\Api\Indian;

use DivineApi\HttpClient;

/**
 * Indian Panchang API endpoints.
 *
 * Covers: Sun & Moon, Panchang, Chandramasa, Samvat, Nakshatra, Tithi, Yoga,
 * Karana, Ritu, Timings, Nivas, Calendars, Chandrashtama, Transits,
 * Chandrabalam, Panchak, Uday Lagna, Choghadiya, and monthly lists.
 */
class PanchangApi
{
    private HttpClient $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    // ─── Core Panchang ───────────────────────────────────────────

    /**
     * #30 Find Sun And Moon
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string} $params
     */
    public function findSunAndMoon(array $params): array
    {
        return $this->http->post('astroapi-2.divineapi.com', '/indian-api/v2/find-sun-and-moon', $params);
    }

    /**
     * #31 Find Panchang
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string, sanskrit_sign?: string} $params
     */
    public function findPanchang(array $params): array
    {
        return $this->http->post('astroapi-1.divineapi.com', '/indian-api/v2/find-panchang', $params);
    }

    /**
     * #32 Find Chandramasa
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string, month_type?: string} $params
     */
    public function findChandramasa(array $params): array
    {
        return $this->http->post('astroapi-3.divineapi.com', '/indian-api/v2/chandramasa', $params);
    }

    /**
     * #33 Find Samvat
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string} $params
     */
    public function findSamvat(array $params): array
    {
        return $this->http->post('astroapi-2.divineapi.com', '/indian-api/v1/find-samvat', $params);
    }

    /**
     * #34 Find Nakshatra
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string} $params
     */
    public function findNakshatra(array $params): array
    {
        return $this->http->post('astroapi-1.divineapi.com', '/indian-api/v2/find-nakshatra', $params);
    }

    /**
     * #35 Find Surya Nakshatra
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string} $params
     */
    public function findSuryaNakshatra(array $params): array
    {
        return $this->http->post('astroapi-1.divineapi.com', '/indian-api/v2/find-surya-nakshatra', $params);
    }

    /**
     * #36 Find Tithi
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string} $params
     */
    public function findTithi(array $params): array
    {
        return $this->http->post('astroapi-1.divineapi.com', '/indian-api/v1/find-tithi', $params);
    }

    /**
     * #37 Find Yoga
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string} $params
     */
    public function findYoga(array $params): array
    {
        return $this->http->post('astroapi-1.divineapi.com', '/indian-api/v2/find-yoga', $params);
    }

    /**
     * #38 Find Karana
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string} $params
     */
    public function findKarana(array $params): array
    {
        return $this->http->post('astroapi-1.divineapi.com', '/indian-api/v1/find-karana', $params);
    }

    /**
     * #39 Ritu And Anaya
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string, sanskrit_sign?: string} $params
     */
    public function rituAndAnaya(array $params): array
    {
        return $this->http->post('astroapi-2.divineapi.com', '/indian-api/v1/find-ritu-and-anaya', $params);
    }

    // ─── Timings ─────────────────────────────────────────────────

    /**
     * #40 Auspicious Timings
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string} $params
     */
    public function auspiciousTimings(array $params): array
    {
        return $this->http->post('astroapi-3.divineapi.com', '/indian-api/v1/auspicious-timings', $params);
    }

    /**
     * #41 Inauspicious Timings
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string} $params
     */
    public function inauspiciousTimings(array $params): array
    {
        return $this->http->post('astroapi-3.divineapi.com', '/indian-api/v1/inauspicious-timings', $params);
    }

    /**
     * #42 Nivas And Shool
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string} $params
     */
    public function nivasAndShool(array $params): array
    {
        return $this->http->post('astroapi-2.divineapi.com', '/indian-api/v1/find-nivas-and-shool', $params);
    }

    /**
     * #43 Other Calendars
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string} $params
     */
    public function otherCalendars(array $params): array
    {
        return $this->http->post('astroapi-2.divineapi.com', '/indian-api/v2/find-other-calendars-and-epoch', $params);
    }

    // ─── Transits & Advanced ─────────────────────────────────────

    /**
     * #44 Chandrashtama
     * @param array{month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string, sanskrit_sign?: string} $params
     */
    public function chandrashtama(array $params): array
    {
        return $this->http->post('astroapi-3.divineapi.com', '/indian-api/v2/chandrashtama', $params);
    }

    /**
     * #45 Grah Gochar (Planet Transit)
     * @param string $planet Planet name
     * @param array{month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string, sanskrit_sign?: string} $params
     */
    public function grahGochar(string $planet, array $params): array
    {
        return $this->http->post('astroapi-3.divineapi.com', "/indian-api/v2/grah-gochar/{$planet}", $params);
    }

    /**
     * #46 Planet Nakshatra Transit
     * @param string $planet Planet name
     * @param array{month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string, pada_transit?: string} $params
     */
    public function planetNakshatraTransit(string $planet, array $params): array
    {
        return $this->http->post('astroapi-3.divineapi.com', "/indian-api/v2/planet-nakshatra-transit/{$planet}", $params);
    }

    /**
     * #47 Planet Retrograde Transit
     * @param string $planet Planet name
     * @param array{month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string} $params
     */
    public function planetRetrogradeTransit(string $planet, array $params): array
    {
        return $this->http->post('astroapi-3.divineapi.com', "/indian-api/v2/planet-retrograde-transit/{$planet}", $params);
    }

    /**
     * #48 Planet Combustion Transit
     * @param string $planet Planet name
     * @param array{month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string} $params
     */
    public function planetCombustionTransit(string $planet, array $params): array
    {
        return $this->http->post('astroapi-3.divineapi.com', "/indian-api/v2/planet-combustion-transit/{$planet}", $params);
    }

    /**
     * #49 Chandrabalam Tarabalam
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string, sanskrit_sign?: string} $params
     */
    public function chandrabalamTarabalam(array $params): array
    {
        return $this->http->post('astroapi-2.divineapi.com', '/indian-api/v2/find-chandrabalam-and-tarabalam', $params);
    }

    /**
     * #50 Panchak Rahita
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string} $params
     */
    public function panchakRahita(array $params): array
    {
        return $this->http->post('astroapi-3.divineapi.com', '/indian-api/v1/panchak-rahita', $params);
    }

    /**
     * #51 Uday Lagna
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string, sanskrit_sign?: string} $params
     */
    public function udayLagna(array $params): array
    {
        return $this->http->post('astroapi-3.divineapi.com', '/indian-api/v2/uday-lagna', $params);
    }

    /**
     * #52 Choghadiya
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string} $params
     */
    public function choghadiya(array $params): array
    {
        return $this->http->post('astroapi-2.divineapi.com', '/indian-api/v1/find-choghadiya', $params);
    }

    // ─── Monthly Lists (astroapi-8) ─────────────────────────────

    /**
     * #53 Month Sunrise-Sunset
     * @param array{month: int, year: int, place: string, lat: float, lon: float, tzone: float} $params
     */
    public function monthSunriseSunset(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/indian-api/v1/month-sunrise-sunset-list', $params);
    }

    /**
     * #54 Month Nakshatra
     * @param array{month: int, year: int, place: string, lat: float, lon: float, tzone: float} $params
     */
    public function monthNakshatra(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/indian-api/v1/month-nakshatra-list', $params);
    }

    /**
     * #55 Month Tithi
     * @param array{month: int, year: int, place: string, lat: float, lon: float, tzone: float} $params
     */
    public function monthTithi(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/indian-api/v1/month-tithi-list', $params);
    }

    /**
     * #56 Month Surya Nakshatra
     * @param array{day: int, month: int, year: int, place: string, lat: float, lon: float, tzone: float, lan?: string} $params
     */
    public function monthSuryaNakshatra(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/indian-api/v1/month-surya-nakshatra-list', $params);
    }
}
