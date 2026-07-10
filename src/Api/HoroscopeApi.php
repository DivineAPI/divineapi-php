<?php

declare(strict_types=1);

namespace DivineApi\Api;

use DivineApi\HttpClient;

/**
 * Horoscope & Tarot API endpoints (astroapi-5.divineapi.com)
 *
 * Covers: Daily/Weekly/Monthly/Yearly Horoscope, Chinese Horoscope,
 * Numerology Horoscope, Tarot, Fortune, Coffee, and various readings.
 */
class HoroscopeApi
{
    private const HOST = 'astroapi-5.divineapi.com';

    private HttpClient $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    // ─── Horoscopes ──────────────────────────────────────────────

    /**
     * #1 Daily Horoscope
     * The reading is selected by h_day (today, tomorrow, or yesterday). The endpoint
     * ignores day/month/year, so they are not required.
     * @param array{sign: string, h_day: string, tzone: string|float, lan?: string} $params
     */
    public function dailyHoroscope(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v5/daily-horoscope', $params);
    }

    /**
     * #2 Weekly Horoscope
     * week selects the period: 'current', 'prev', or 'next' (not a date or number).
     * @param array{sign: string, week: string, tzone: string|float, lan?: string} $params
     */
    public function weeklyHoroscope(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v5/weekly-horoscope', $params);
    }

    /**
     * #3 Monthly Horoscope
     * month selects the period: 'current', 'prev', or 'next' (not a date or number).
     * @param array{sign: string, month: string, tzone: string|float, lan?: string} $params
     */
    public function monthlyHoroscope(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v5/monthly-horoscope', $params);
    }

    /**
     * #4 Yearly Horoscope
     * year selects the period: 'current', 'prev', or 'next' (not a calendar year).
     * @param array{sign: string, year: string, tzone: string|float, lan?: string} $params
     */
    public function yearlyHoroscope(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v5/yearly-horoscope', $params);
    }

    /**
     * #5 Chinese Horoscope
     * @param array{sign: string, h_day: string, tzone: string|float, lan?: string} $params
     */
    public function chineseHoroscope(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v3/chinese-horoscope', $params);
    }

    /**
     * #6 Numerology Horoscope
     * day/month/year must be today's date; the endpoint only serves today, tomorrow, or yesterday.
     * @param array{number: string|int, day: string|int, month: string|int, year: string|int, tzone: string|float, lan?: string} $params
     */
    public function numerologyHoroscope(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v2/numerology-horoscope', $params);
    }

    // ─── Tarot & Fortune ─────────────────────────────────────────

    /**
     * #7 Yes or No Tarot
     * @param array{lan?: string} $params
     */
    public function yesOrNoTarot(array $params = []): array
    {
        return $this->http->post(self::HOST, '/api/v2/yes-or-no-tarot', $params);
    }

    /**
     * #8 Daily Tarot
     * @param array{lan?: string} $params
     */
    public function dailyTarot(array $params = []): array
    {
        return $this->http->post(self::HOST, '/api/v2/daily-tarot', $params);
    }

    /**
     * #9 Fortune Cookie
     * @param array{lan?: string} $params
     */
    public function fortuneCookie(array $params = []): array
    {
        return $this->http->post(self::HOST, '/api/v2/fortune-cookie', $params);
    }

    /**
     * #10 Coffee Cup Reading
     * @param array{lan?: string} $params
     */
    public function coffeeCupReading(array $params = []): array
    {
        return $this->http->post(self::HOST, '/api/v2/coffee-cup-reading', $params);
    }

    // ─── Readings ────────────────────────────────────────────────

    /**
     * #11 Career Daily Reading
     * @param array{lan?: string} $params
     */
    public function careerDailyReading(array $params = []): array
    {
        return $this->http->post(self::HOST, '/api/v3/career-daily-reading', $params);
    }

    /**
     * #12 Divine Angel Reading
     * @param array{lan?: string} $params
     */
    public function divineAngelReading(array $params = []): array
    {
        return $this->http->post(self::HOST, '/api/v3/divine-angel-reading', $params);
    }

    /**
     * #13 Divine Magic Reading
     * @param array{card_image: string, lan?: string} $params
     */
    public function divineMagicReading(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v2/divine-magic-reading', $params);
    }

    /**
     * #14 Dream Come True
     * @param array{lan?: string} $params
     */
    public function dreamComeTrue(array $params = []): array
    {
        return $this->http->post(self::HOST, '/api/v3/dream-come-true-reading', $params);
    }

    /**
     * #15 Egyptian Prediction
     * @param array{lan?: string} $params
     */
    public function egyptianPrediction(array $params = []): array
    {
        return $this->http->post(self::HOST, '/api/v3/egyptian-prediction', $params);
    }

    /**
     * #16 Erotic Love Reading
     * @param array{lan?: string} $params
     */
    public function eroticLoveReading(array $params = []): array
    {
        return $this->http->post(self::HOST, '/api/v3/erotic-love-reading', $params);
    }

    /**
     * #17 Ex-Flame Reading
     * @param array{lan?: string} $params
     */
    public function exFlameReading(array $params = []): array
    {
        return $this->http->post(self::HOST, '/api/v3/ex-flame-reading', $params);
    }

    /**
     * #18 Flirt Love Reading
     * @param array{lan?: string} $params
     */
    public function flirtLoveReading(array $params = []): array
    {
        return $this->http->post(self::HOST, '/api/v3/flirt-love-reading', $params);
    }

    /**
     * #19 Heartbreak Reading
     * @param array{card_image: string, lan?: string} $params
     */
    public function heartbreakReading(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v2/heartbreak-reading', $params);
    }

    /**
     * #20 In-Depth Love Reading
     * @param array{lan?: string} $params
     */
    public function inDepthLoveReading(array $params = []): array
    {
        return $this->http->post(self::HOST, '/api/v3/in-depth-love-reading', $params);
    }

    /**
     * #21 Know Your Friend
     * @param array{lan?: string} $params
     */
    public function knowYourFriend(array $params = []): array
    {
        return $this->http->post(self::HOST, '/api/v3/know-your-friend-reading', $params);
    }

    /**
     * #22 Love Compatibility
     * @param array{sign_1: string, sign_2: string, lan?: string} $params
     */
    public function loveCompatibility(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v2/love-compatibility', $params);
    }

    /**
     * #23 Love Triangle
     * @param array{card_image: string, lan?: string} $params
     */
    public function loveTriangle(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v2/love-triangle-reading', $params);
    }

    /**
     * #24 Made For Each Other
     * @param array{lan?: string} $params
     */
    public function madeForEachOther(array $params = []): array
    {
        return $this->http->post(self::HOST, '/api/v3/made-for-each-other-or-not-reading', $params);
    }

    /**
     * #25 Power Life Reading
     * @param array{lan?: string} $params
     */
    public function powerLifeReading(array $params = []): array
    {
        return $this->http->post(self::HOST, '/api/v3/power-life-reading', $params);
    }

    /**
     * #26 Past Lives Connection
     * @param array{lan?: string} $params
     */
    public function pastLivesConnection(array $params = []): array
    {
        return $this->http->post(self::HOST, '/api/v3/past-lives-connection-reading', $params);
    }

    /**
     * #27 Past-Present-Future
     * @param array{card_image: string, lan?: string} $params
     */
    public function pastPresentFuture(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v3/past-present-future-reading', $params);
    }

    /**
     * #28 Which Animal Are You
     * @param array{full_name: string, day: string|int, month: string|int, year: string|int, lan?: string} $params
     */
    public function whichAnimalAreYou(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v2/which-animal-are-you-reading', $params);
    }

    /**
     * #29 Wisdom Reading
     * @param array{card_image: string, lan?: string} $params
     */
    public function wisdomReading(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v2/wisdom-reading', $params);
    }
}
