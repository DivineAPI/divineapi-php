<?php

declare(strict_types=1);

namespace DivineApi\Api;

use DivineApi\HttpClient;

/**
 * Horoscope & Tarot API endpoints (astroapi-5.divineapi.com)
 *
 * Covers: Daily/Weekly/Monthly/Yearly Horoscope, Chinese Horoscope (daily/weekly/monthly/yearly,
 * top signs of the year),
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
     * data has sign, date and prediction. special_info => true adds data.special,
     * as in chineseWeeklyHoroscope.
     * @param array{sign: string, h_day: string, tzone: string|float, lan?: string, special_info?: bool|int} $params
     */
    public function chineseHoroscope(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v3/chinese-horoscope', self::withSpecialInfo($params));
    }

    /**
     * #30 Chinese Weekly Horoscope
     * sign is a Chinese animal (rat, ox, tiger, rabbit, dragon, snake, horse, goat, monkey,
     * rooster, dog, pig). week selects the period: 'current', 'prev', or 'next' (not a date).
     * data has sign, week (e.g. "08 Nov 2026 to 14 Nov 2026") and prediction
     * (growth, health, wealth, career, love, family, fortune).
     * special_info => true adds data.special: lucky_colors (two colours, each name + hex),
     * horoscope_percentage (0-100 for growth, health, wealth, career, love, family, luck)
     * and summary. Off by default, which leaves the response unchanged.
     * @param array{sign: string, week: string, tzone: string|float, lan?: string, special_info?: bool|int} $params
     */
    public function chineseWeeklyHoroscope(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v3/chinese-horoscope-weekly', self::withSpecialInfo($params));
    }

    /**
     * #31 Chinese Monthly Horoscope
     * month selects the period: 'current', 'prev', or 'next' (not a month number).
     * data has sign, month (e.g. "November 2026") and prediction, like chineseWeeklyHoroscope;
     * special_info works the same way.
     * @param array{sign: string, month: string, tzone: string|float, lan?: string, special_info?: bool|int} $params
     */
    public function chineseMonthlyHoroscope(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v3/chinese-horoscope-monthly', self::withSpecialInfo($params));
    }

    /**
     * #32 Chinese Yearly Horoscope
     * year selects the period: 'current', 'prev', or 'next' (not a calendar year).
     * data has sign, year and prediction, like chineseWeeklyHoroscope; special_info works
     * the same way.
     * @param array{sign: string, year: string, tzone: string|float, lan?: string, special_info?: bool|int} $params
     */
    public function chineseYearlyHoroscope(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v3/chinese-horoscope-yearly', self::withSpecialInfo($params));
    }

    /**
     * #246 Chinese Yearly Top Signs
     * The top 3 Chinese signs of the year in each life area. There is no sign: all twelve
     * animals are ranked. year selects the period: 'current', 'prev', or 'next'.
     * data has year (e.g. "2026") and areas, keyed by area (career, health, love, wealth),
     * each a list of three [rank, sign, reason] entries sorted by rank (1 = best).
     * A year without a ranking answers success 0, "Data not found.".
     * @param array{year: string, tzone: string|float, lan?: string} $params
     */
    public function chineseYearlyTopSigns(array $params): array
    {
        return $this->http->post(self::HOST, '/api/v3/chinese-yearly-top-signs', $params);
    }

    /**
     * The Chinese endpoints add data.special only for special_info=1. Sends 1 when it is
     * on (true or 1) and drops the field otherwise, so a call without it is unchanged.
     */
    private static function withSpecialInfo(array $params): array
    {
        if (array_key_exists('special_info', $params)) {
            $value = $params['special_info'];
            $on = $value === true || (is_scalar($value) && (string) $value === '1');
            unset($params['special_info']);
            if ($on) {
                $params['special_info'] = 1;
            }
        }
        return $params;
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
