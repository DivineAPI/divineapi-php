# Astrology API PHP SDK (DivineAPI)

![Astrology API PHP SDK (DivineAPI)](https://raw.githubusercontent.com/DivineAPI/DivineAPI/main/assets/divineapi-php.png)

[![Packagist](https://img.shields.io/packagist/v/divineapi/divineapi)](https://packagist.org/packages/divineapi/divineapi)
[![Docs](https://img.shields.io/badge/Docs-developers.divineapi.com-blue)](https://developers.divineapi.com)
[![Trial](https://img.shields.io/badge/Trial-14--day-green)](https://divineapi.com/start-trial)
[![Status](https://img.shields.io/badge/Status-status.divineapi.com-lightgrey)](https://status.divineapi.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow)](LICENSE)
[![Ask DeepWiki](https://deepwiki.com/badge.svg)](https://deepwiki.com/DivineAPI/divineapi-php)

Verified live against the DivineAPI API on 2 October 2026.

Official [DivineAPI](https://divineapi.com) PHP client (Composer) for Vedic, Western, horoscope, tarot and numerology astrology endpoints. Responses come back as PHP arrays decoded from the API's JSON.

## Get your API key

1. Start the [14-day free trial](https://divineapi.com/start-trial) (credit card required to activate the trial).
2. Copy your **API key** and **auth token** from the DivineAPI dashboard. The SDK sends the token as an
   `Authorization: Bearer` header and the key as the `api_key` form field on every request.

## Requirements

- PHP 8.0 or higher
- [Guzzle HTTP](https://github.com/guzzle/guzzle) 7.x

## Installation

```bash
composer require divineapi/divineapi
```

## Quick Start

```php
<?php
require 'vendor/autoload.php';

use DivineApi\DivineApi;

$client = new DivineApi('YOUR_API_KEY', 'YOUR_AUTH_TOKEN');

// Daily horoscope for Leo: h_day is 'today', 'tomorrow' or 'yesterday'; tzone is a decimal offset
$result = $client->horoscope()->dailyHoroscope(['sign' => 'leo', 'h_day' => 'today', 'tzone' => 5.5]);

if (($result['success'] ?? 0) !== 1) {
    exit(print_r($result, true));
}
echo $result['data']['sign'], ' ', $result['data']['date'], PHP_EOL;
echo $result['data']['prediction']['luck'][1], PHP_EOL;
```

Real response from this endpoint (2 Oct 2026, trimmed with `...`):

```json
{
  "success": 1,
  "data": {
    "sign": "Leo",
    "date": "2026-10-02",
    "prediction": {
      "personal": "The Moon finishes its run through a talkative air sign today and crosses into water tonight, and that turn sets the shape of your day, Leo. ...",
      "health": "Your back and your heart are the places to tend today. ...",
      "profession": "Speech is where your career moves today. ...",
      "emotions": "Friendship carries the mood today. ...",
      "travel": "Put a date on something. ...",
      "luck": ["Colors of the day : Flame Red, Moonstone White", "Lucky Numbers of the day : 1, 44, 54", "..."]
    },
    "special": {
      "lucky_color_codes": ["#E25822", "#E0E0E0"],
      "horoscope_percentage": { "personal": 71, "health": 62, "profession": 71, "emotions": 74, "travel": 67, "luck": 76 }
    }
  }
}
```

## API Modules

The SDK is organized into modules that mirror the DivineAPI structure:

| Module | Access |
|--------|--------|
| Horoscope & Tarot | `$client->horoscope()` |
| Indian - Panchang | `$client->indian()->panchang()` |
| Indian - Festivals | `$client->indian()->festival()` |
| Indian - Kundli | `$client->indian()->kundli()` |
| Indian - Match Making | `$client->indian()->matchMaking()` |
| Western - Natal | `$client->western()->natal()` |
| Western - Synastry | `$client->western()->synastry()` |
| Western - Transit | `$client->western()->transit()` |
| Western - Composite | `$client->western()->composite()` |
| Western - Planet Returns | `$client->western()->planetReturns()` |
| Western - Progressions | `$client->western()->progressions()` |
| Western - Prenatal | `$client->western()->prenatal()` |
| PDF Reports | `$client->pdfReport()` |
| Numerology | `$client->numerology()` |
| Lifestyle | `$client->lifestyle()` |
| Calculators | `$client->calculator()` |
| Location (place search) | `$client->location()` |

## Usage Examples

### Horoscope

```php
// Weekly Horoscope
// week selects the period: 'current', 'prev', or 'next'.
$result = $client->horoscope()->weeklyHoroscope([
    'sign' => 'leo',
    'week' => 'current',
    'tzone' => 5.5,
    'lan' => 'en',
]);

// Yes or No Tarot
$result = $client->horoscope()->yesOrNoTarot(['lan' => 'en']);

// Love Compatibility
$result = $client->horoscope()->loveCompatibility([
    'sign_1' => 'aries',
    'sign_2' => 'leo',
    'lan' => 'en',
]);
```

### Indian API - Panchang

```php
// Find Panchang
$result = $client->indian()->panchang()->findPanchang([
    'day' => 15,
    'month' => 3,
    'year' => 2026,
    'place' => 'new delhi',
    'lat' => 28.6139,
    'lon' => 77.2090,
    'tzone' => 5.5,
    'lan' => 'en',
]);

// Grah Gochar (Planet Transit)
$result = $client->indian()->panchang()->grahGochar('saturn', [
    'month' => 3,
    'year' => 2026,
    'place' => 'mumbai',
    'lat' => 19.0760,
    'lon' => 72.8777,
    'tzone' => 5.5,
    'lan' => 'en',
]);
```

### Indian API - Kundli

```php
$birthParams = [
    'full_name' => 'John Doe',
    'day' => 15,
    'month' => 6,
    'year' => 1990,
    'hour' => 10,
    'min' => 30,
    'sec' => 0,
    'gender' => 'male',
    'place' => 'new delhi',
    'lat' => 28.6139,
    'lon' => 77.2090,
    'tzone' => 5.5,
    'lan' => 'en',
];

// Basic Astro Details
$result = $client->indian()->kundli()->basicAstroDetails($birthParams);

// weekday 'vedic' changes the day at sunrise, so a birth before sunrise gets the
// previous day's vaar ('civil', the default, changes it at midnight). Also accepted by
// varshphalVarshaPravesh, varshphalBasicAstroDetails and lalKitabVarshphalVarshaPravesh.
$result = $client->indian()->kundli()->basicAstroDetails(
    array_merge($birthParams, ['weekday' => 'vedic'])
);

// Horoscope Chart (D1, D9, etc.)
$result = $client->indian()->kundli()->horoscopeChart('D1', $birthParams);

// Manglik Dosha
$result = $client->indian()->kundli()->manglikDosha($birthParams);

// Vimshottari Dasha
$result = $client->indian()->kundli()->vimshottariDasha(
    array_merge($birthParams, ['dasha_type' => 'maha-dasha'])
);

// Graha Drishti (Vedic aspects): which planets aspect which houses and planets.
$result = $client->indian()->kundli()->grahaDrishti($birthParams);

// Jaimini Swamsa Chart: the Navamsa (D9) chart with the Karakamsha sign as house 1.
// Returns atmakaraka, swamsha_sign, lagnamsha_sign and the chart as svg / base64_image.
$result = $client->indian()->kundli()->jaiminiSwamsaChart($birthParams);

// Lal Kitab Teva
$result = $client->indian()->kundli()->lalKitabTeva($birthParams);

// Lal Kitab Planet Analysis
$result = $client->indian()->kundli()->lalKitabPlanetAnalysis(
    array_merge($birthParams, ['analysis_planet' => 'sun'])
);

// Lal Kitab Varshphal Chart
$result = $client->indian()->kundli()->lalKitabVarshphalChart(
    array_merge($birthParams, ['varshphal_year' => 2026])
);

// Lal Kitab Mahadasha Content (no birth data needed)
$result = $client->indian()->kundli()->lalKitabMahadashaContent([
    'maha_dasha' => 'saturn',
    'lan' => 'en',
]);

// Bhava Analysis
$result = $client->indian()->kundli()->bhavaAnalysis($birthParams);

// Planet Remedies (birth params + analysis_planet)
$result = $client->indian()->kundli()->planetRemedies(
    array_merge($birthParams, ['analysis_planet' => 'sun'])
);
```

> **Endpoint versions changed in v1.19.0** (to match the API docs and the Node SDK):
> - `subPlanetChart` now calls v1. Before v1.19.0 it called `/indian-api/v2/sub-planet-chart`, which does not exist, so every call failed with a 404.
> - `jaiminiPlanetaryPositions`, `kpPlanetaryPositions` and `subPlanetPositions` now call v2. The response is the same except two nakshatra spellings: `Mrigshira` is now `Mrigashira` and `Shravana` is now `Shravan`.
> - `shadbala` now calls v3, which adds `ishta_phala` and `kashta_phala` (one value per planet). Every other field is unchanged.

### Indian API - Match Making

```php
$coupleParams = [
    'p1_full_name' => 'Person One',
    'p1_day' => 15, 'p1_month' => 6, 'p1_year' => 1990,
    'p1_hour' => 10, 'p1_min' => 30, 'p1_sec' => 0,
    'p1_gender' => 'male',
    'p1_place' => 'new delhi', 'p1_lat' => 28.6139, 'p1_lon' => 77.2090, 'p1_tzone' => 5.5,

    'p2_full_name' => 'Person Two',
    'p2_day' => 20, 'p2_month' => 9, 'p2_year' => 1992,
    'p2_hour' => 14, 'p2_min' => 15, 'p2_sec' => 0,
    'p2_gender' => 'female',
    'p2_place' => 'mumbai', 'p2_lat' => 19.0760, 'p2_lon' => 72.8777, 'p2_tzone' => 5.5,

    'lan' => 'en',
];

$result = $client->indian()->matchMaking()->ashtakootMilan($coupleParams);
```

### Indian API - Festivals

```php
$festivalParams = [
    'year' => 2026,
    'place' => 'new delhi',
    'lat' => 28.6139,
    'lon' => 77.2090,
    'tzone' => 5.5,
];

// Chaitra Festivals
$result = $client->indian()->festival()->chaitraFestivals($festivalParams);

// Generic Hindu month festivals
$result = $client->indian()->festival()->hinduMonthFestivals('kartika', $festivalParams);

// Find specific festival (festival is a lowercase snake_case slug from the DivineAPI festival list)
$result = $client->indian()->festival()->findFestival(
    array_merge($festivalParams, ['festival' => 'maha_shivratri'])
);
```

> **`shraavanaFestivals` (and `hinduMonthFestivals('shraavana', ...)`) calls v3 since v1.19.0** (the other eleven months have no v3 and stay on v2). In v2, `hariyaali_teej`, `gayatri_jayanti`, `narali_purnima` and `sanskrit_divas` returned their date under `dates` instead of `date`; v3 fixes those four. `shraavana_somvaar_vrat` and `mangla_gauri_vrat` still use `dates` because they fall on every Monday and Tuesday of the month.

### Western API - Natal

```php
$westernBirth = [
    'full_name' => 'Jane Smith',
    'day' => 22,
    'month' => 7,
    'year' => 1995,
    'hour' => 14,
    'min' => 0,
    'sec' => 0,
    'gender' => 'female',
    'place' => 'london',
    'lat' => 51.5074,
    'lon' => -0.1278,
    'tzone' => 0,
    // house_system accepts a friendly name (placidus, koch, whole-sign, ...) or a
    // single-letter code (P, K, W, ...); the SDK normalises it to the API's letter code.
    'house_system' => 'placidus',
    'lan' => 'en',
];

// Planetary Positions
$result = $client->western()->natal()->planetaryPositions($westernBirth);  // 18 bodies incl. Vertex; see note below

// Natal Wheel Chart
$result = $client->western()->natal()->natalWheelChart($westernBirth);

// Natal Insights
$result = $client->western()->natal()->natalInsights($westernBirth);

// Persona Chart: the chart for the moment, within the first year of life, that the
// transiting Sun reaches the natal degree of persona_planet.
// output_include defaults to "raw_data" (~21 KB); image tokens are ~0.5 MB per SVG
// and output_include = "all" returns ~4.3 MB.
$result = $client->western()->natal()->personaChart(
    $westernBirth + ['persona_planet' => 'moon']
);
```

> **`planetaryPositions` changed in v1.10.0.** It now calls astroapi-8 instead of astroapi-4, so the response includes **Vertex** (18 bodies instead of 17). Two behaviour changes come with it:
> - the envelope is `['status' => 'success', 'code' => 200, 'message' => ..., 'data' => [...]]` - there is no longer a `success` key, so code checking `$result['success'] === 1` must switch to `$result['status'] === 'success'` (or just read `$result['data']`);
> - invalid input now throws `ValidationException` (HTTP 422) instead of returning `['success' => 2]`.
>
> The `data` list is otherwise unchanged: same fields, same types, identical values for the other 17 bodies.

### Western API - Synastry

```php
// Physical Compatibility
$result = $client->western()->synastry()->physicalCompatibility($coupleParams);

// Harmonious Aspect Reading
$result = $client->western()->synastry()->harmoniousAspectReading($coupleParams);
```

### Western API - Transit

```php
// Daily Transit
$result = $client->western()->transit()->daily($westernBirth);

// Full Transit
$result = $client->western()->transit()->full($westernBirth);
```

### PDF Reports

```php
// The API requires all seven branding fields below on every PDF request
// (a few legacy reports also need company_landline). The SDK treats
// company_mobile as optional, so make sure you pass it.
$reportParams = array_merge($birthParams, [
    'company_name' => 'YOUR_COMPANY_NAME',
    'company_url' => 'YOUR_COMPANY_URL',
    'company_email' => 'YOUR_COMPANY_EMAIL',
    'company_mobile' => 'YOUR_COMPANY_MOBILE',
    'company_bio' => 'YOUR_COMPANY_BIO',
    'logo_url' => 'YOUR_LOGO_URL',
    'footer_text' => 'YOUR_FOOTER_TEXT',
]);

// Kundali Sampoorna Report
$result = $client->pdfReport()->kundaliSampoorna($reportParams);

// Astrology Report with report code (report_code + theme are required, alongside the branding fields above)
$result = $client->pdfReport()->astrologyReport(
    array_merge($reportParams, ['report_code' => 'CAREER-REPORT', 'theme' => '001'])
);

// Optional cover on the 9 Vedic V1 PDFs: show only your image on page 1
$result = $client->pdfReport()->kundaliSampoorna(array_merge($reportParams, [
    'front_image' => 'https://example.com/cover.png',
    'hide_frontpage_details' => true,   // sent as 1, as this API expects
]));

// Reports V2: JSON body + x-api-key header (handled by the SDK). Needs a DivineAPI PDF
// account's API key and token; a standard API account gets 401 "Invalid Bearer token".
// Returns reportId, htmlUrl, pdfUrl, statusUrl; ready in about 10-30 seconds.
$result = $client->pdfReport()->reportsGenerate(
    array_merge($reportParams, ['report_type' => 'vedic-career-report'])
);
$result = $client->pdfReport()->westernReportsGenerate(
    array_merge($reportParams, ['report_type' => 'western-inner-moon', 'tier' => 'snapshot'])
);
// hide_frontpage_details => true shows only front_image on the cover (requires front_image)
$result = $client->pdfReport()->reportsGenerate(array_merge($reportParams, [
    'report_type' => 'vedic-career-report',
    'front_image' => 'https://example.com/cover.png',
    'hide_frontpage_details' => true,
]));
```

### Numerology

```php
// Loshu Grid
$result = $client->numerology()->loshuGrid([
    'day' => 15,
    'month' => 6,
    'year' => 1990,
    'fname' => 'John',
    'lname' => 'Doe',
    'lan' => 'en',
]);

// Core Numbers
$result = $client->numerology()->coreNumbers([
    'full_name' => 'John Doe',
    'day' => 15,
    'month' => 6,
    'year' => 1990,
    'gender' => 'male',
    'method' => 'chaldean',
]);
```

### Lifestyle

```php
$result = $client->lifestyle()->zodiacGiftGuru([
    'sign' => 'virgo',
    'h_day' => 'today',
    'tzone' => 5.5,
    'lan' => 'en',
]);
```

### Calculators

```php
// FLAMES Calculator
$result = $client->calculator()->flamesCalculator([
    'your_name' => 'John',
    'partner_name' => 'Jane',
]);

// Love Calculator
$result = $client->calculator()->loveCalculator([
    'your_name' => 'John',
    'partner_name' => 'Jane',
    'your_gender' => 'male',
    'partner_gender' => 'female',
]);
```

### Location

```php
// Place name (at least 3 characters) -> up to 10 matches with lat, lon and timezone
$result = $client->location()->search(['place' => 'Patna']);
$first = $result['data']['results'][0];   // latitude 25.41667, longitude 85.16667, timezone "Asia/Kolkata"

// timezone_value is the zone's UTC offset today. For a birth date in a zone with
// summer time (e.g. America/New_York: -5 in winter, -4 in summer) work out the offset
// for that date from $first['timezone'] before passing it as tzone.
// Place data (c) GeoNames (geonames.org), CC BY 4.0: $result['attribution'].
```

### Astro Chatbot

Needs an Astro Chatbot plan on your account. Same API key and auth token; the SDK sends
them as `x-api-key` and `Authorization: Bearer` headers to `ask.divineapi.com`. Every
conversation belongs to one of your end users: one key has many `user_id`s, each `user_id`
has many `session_id`s, and the same `session_id` under two `user_id`s is two separate
sessions.

```php
$chatbot = $client->chatbot();

// First message of a session: send the birth details once (numbers are fine,
// the SDK sends them as the strings the chatbot expects)
$res = $chatbot->chat([
    'user_id' => 'u_8812', 'session_id' => 's_1', 'message' => 'When will I get a job?',
    'full_name' => 'Priya Sharma', 'day' => 24, 'month' => 5, 'year' => 1996,
    'hour' => 14, 'min' => 40, 'gender' => 'female', 'place' => 'New Delhi',
    'lat' => 28.7041, 'lon' => 77.1025, 'tzone' => 5.5,
    'depth' => 'standard',          // quick 20 / standard 30 / deep 50 credits
]);
echo $res['answer'], ' ', $res['credits_charged'], ' ', $res['credits_remaining'];

// Follow-ups in the same session reuse the stored birth details
$chatbot->chat(['user_id' => 'u_8812', 'session_id' => 's_1', 'message' => 'And for marriage?',
    'school' => 'vedic', 'lens' => 'love', 'language' => 'Hindi']);

// Stream the answer: ['delta' => ...] events, then one ['done' => true, ...] receipt
foreach ($chatbot->chatStream(['user_id' => 'u_8812', 'session_id' => 's_1',
    'message' => 'What should I focus on this month?']) as $event) {
    if (isset($event['delta'])) {
        echo $event['delta'];
    }
}

// Daily horoscope for a date (full birth details on every call)
$chatbot->horoscopePrediction([
    'user_id' => 'u_8812', 'date' => '2026-10-31',
    'day' => 24, 'month' => 5, 'year' => 1996, 'hour' => 14, 'min' => 40, 'gender' => 'female',
    'place' => 'New Delhi', 'lat' => 28.7041, 'lon' => 77.1025, 'tzone' => 5.5,
]);

$chatbot->sessions(['user_id' => 'u_8812']);                             // code 404 if none yet
$chatbot->session(['user_id' => 'u_8812', 'session_id' => 's_1']);       // messages + birth_details
$chatbot->deleteSession(['user_id' => 'u_8812', 'session_id' => 's_1']); // permanent
$chatbot->balance();   // ['state' => 'active', 'credits_remaining' => ..., 'expires' => 'YYYY-MM-DD']
```

Other `chat()` options: `length_cap` (short / medium / full), `language` (any language
name, or `auto`), `school` (western / vedic / kp / lalkitab), `lens` (general / career /
love / health / money / spiritual), `confidence` (balanced / definitive / careful),
`sensitivity` (standard / strict), and free text `tone`, `framing`, `assistant_name`,
`brand_voice`, `sign_off` and `style_notes` (at most 500 characters). Guardrail replies
and failed requests are not charged. A missing user or session throws a
`DivineApiException` with code 404, and an out-of-credit account gets code 402.

## Error Handling

The SDK throws specific exceptions for different error types:

```php
use DivineApi\Exceptions\AuthenticationException;
use DivineApi\Exceptions\ValidationException;
use DivineApi\Exceptions\DivineApiException;

try {
    $result = $client->horoscope()->dailyHoroscope([...]);
} catch (AuthenticationException $e) {
    // Invalid API key or auth token (401/403)
    echo "Auth error: " . $e->getMessage();
    print_r($e->getResponseBody());
} catch (ValidationException $e) {
    // Invalid parameters (400/422)
    echo "Validation error: " . $e->getMessage();
    print_r($e->getResponseBody());
} catch (DivineApiException $e) {
    // Any other API error
    echo "API error ({$e->getCode()}): " . $e->getMessage();
}
```

## Configuration

### Custom Timeout

```php
// Set a 60-second timeout
$client = new DivineApi('api-key', 'auth-token', 60);
```

## Related repos

| Type | Repo |
|---|---|
| SDK | [divineapi-python](https://github.com/DivineAPI/divineapi-python): Python SDK (`pip install divineapi`) |
| SDK | [divineapi-node](https://github.com/DivineAPI/divineapi-node): Node.js / TypeScript SDK (`npm install divineapi`) |
| REST API | [kundli-api](https://github.com/DivineAPI/kundli-api): Kundli / Kundali API (Vedic birth chart, dashas, doshas) |
| REST API | [kundli-matching-api](https://github.com/DivineAPI/kundli-matching-api): Kundli matching API (Ashtakoot, Dashakoot) |
| REST API | [lal-kitab-api](https://github.com/DivineAPI/lal-kitab-api): Lal Kitab API |
| REST API | [panchang-api](https://github.com/DivineAPI/panchang-api): Panchang API |
| REST API | [hindu-festival-api](https://github.com/DivineAPI/hindu-festival-api): Hindu Festival API |
| REST API | [birth-chart-api](https://github.com/DivineAPI/birth-chart-api): Birth Chart API |
| REST API | [horoscope-api](https://github.com/DivineAPI/horoscope-api): Horoscope API |
| REST API | [tarot-api](https://github.com/DivineAPI/tarot-api): Tarot API |
| REST API | [numerology-api](https://github.com/DivineAPI/numerology-api): Numerology API |
| REST API | [astrology-api](https://github.com/DivineAPI/astrology-api): Astrology API (overview of all domains) |
| Model Context Protocol (MCP) | [mcp-indian-astrology](https://github.com/DivineAPI/mcp-indian-astrology): Vedic astrology MCP server |
| MCP | [mcp-western-astrology](https://github.com/DivineAPI/mcp-western-astrology): Western astrology MCP server |
| MCP | [mcp-horoscope-numerology](https://github.com/DivineAPI/mcp-horoscope-numerology): Horoscope, tarot and numerology MCP server |

## Support

- API reference: [developers.divineapi.com](https://developers.divineapi.com)
- Postman collection: [documenter.getpostman.com/view/26759678/2sBYAysU8Y](https://documenter.getpostman.com/view/26759678/2sBYAysU8Y)
- API status: [status.divineapi.com](https://status.divineapi.com)
- Help centre: [support.divineapi.com](https://support.divineapi.com)
- Plans and prices: [divineapi.com/pricing](https://divineapi.com/pricing)
- SDK bugs: open an issue in this repo

## License

MIT
