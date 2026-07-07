# Divine API PHP SDK

Official PHP SDK for [Divine API](https://divineapi.com) - Astrology, Horoscope, Numerology, Tarot, Kundli, Panchang, and more.

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

$client = new DivineApi('your-api-key', 'your-auth-token');

// Daily Horoscope
$result = $client->horoscope()->dailyHoroscope([
    'sign' => 'aries',
    'day' => 15,
    'month' => 3,
    'year' => 2026,
    'tzone' => 5.5,
    'lan' => 'en',
]);

print_r($result);
```

## API Modules

The SDK is organized into modules that mirror the Divine API structure:

| Module | Access | Endpoints |
|--------|--------|-----------|
| Horoscope & Tarot | `$client->horoscope()` | 29 |
| Indian - Panchang | `$client->indian()->panchang()` | 28 |
| Indian - Festivals | `$client->indian()->festival()` | 16 |
| Indian - Kundli | `$client->indian()->kundli()` | 38 |
| Indian - Match Making | `$client->indian()->matchMaking()` | 8 |
| Western - Natal | `$client->western()->natal()` | 21 |
| Western - Synastry | `$client->western()->synastry()` | 13 |
| Western - Transit | `$client->western()->transit()` | 9 |
| Western - Composite | `$client->western()->composite()` | 4 |
| Western - Planet Returns | `$client->western()->planetReturns()` | 2 |
| Western - Progressions | `$client->western()->progressions()` | 3 |
| Western - Prenatal | `$client->western()->prenatal()` | 2 |
| PDF Reports | `$client->pdfReport()` | 13 |
| Numerology | `$client->numerology()` | 15 |
| Lifestyle | `$client->lifestyle()` | 3 |
| Calculators | `$client->calculator()` | 2 |

## Usage Examples

### Horoscope

```php
// Weekly Horoscope
$result = $client->horoscope()->weeklyHoroscope([
    'sign' => 'leo',
    'week' => 12,
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
    'place' => 'New Delhi',
    'lat' => 28.6139,
    'lon' => 77.2090,
    'tzone' => 5.5,
    'lan' => 'en',
]);

// Grah Gochar (Planet Transit)
$result = $client->indian()->panchang()->grahGochar('saturn', [
    'month' => 3,
    'year' => 2026,
    'place' => 'Mumbai',
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
    'place' => 'New Delhi',
    'lat' => 28.6139,
    'lon' => 77.2090,
    'tzone' => 5.5,
    'lan' => 'en',
];

// Basic Astro Details
$result = $client->indian()->kundli()->basicAstroDetails($birthParams);

// Horoscope Chart (D1, D9, etc.)
$result = $client->indian()->kundli()->horoscopeChart('D1', $birthParams);

// Manglik Dosha
$result = $client->indian()->kundli()->manglikDosha($birthParams);

// Vimshottari Dasha
$result = $client->indian()->kundli()->vimshottariDasha(
    array_merge($birthParams, ['dasha_type' => 'maha'])
);
```

### Indian API - Match Making

```php
$coupleParams = [
    'p1_full_name' => 'Person One',
    'p1_day' => 15, 'p1_month' => 6, 'p1_year' => 1990,
    'p1_hour' => 10, 'p1_min' => 30, 'p1_sec' => 0,
    'p1_gender' => 'male',
    'p1_place' => 'New Delhi', 'p1_lat' => 28.6139, 'p1_lon' => 77.2090, 'p1_tzone' => 5.5,

    'p2_full_name' => 'Person Two',
    'p2_day' => 20, 'p2_month' => 9, 'p2_year' => 1992,
    'p2_hour' => 14, 'p2_min' => 15, 'p2_sec' => 0,
    'p2_gender' => 'female',
    'p2_place' => 'Mumbai', 'p2_lat' => 19.0760, 'p2_lon' => 72.8777, 'p2_tzone' => 5.5,

    'lan' => 'en',
];

$result = $client->indian()->matchMaking()->ashtakootMilan($coupleParams);
```

### Indian API - Festivals

```php
$festivalParams = [
    'year' => 2026,
    'place' => 'New Delhi',
    'lat' => 28.6139,
    'lon' => 77.2090,
    'tzone' => 5.5,
];

// Chaitra Festivals
$result = $client->indian()->festival()->chaitraFestivals($festivalParams);

// Generic Hindu month festivals
$result = $client->indian()->festival()->hinduMonthFestivals('kartika', $festivalParams);

// Find specific festival
$result = $client->indian()->festival()->findFestival(
    array_merge($festivalParams, ['festival' => 'diwali'])
);
```

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
    'place' => 'London',
    'lat' => 51.5074,
    'lon' => -0.1278,
    'tzone' => 0,
    'house_system' => 'placidus',
    'lan' => 'en',
];

// Planetary Positions
$result = $client->western()->natal()->planetaryPositions($westernBirth);

// Natal Wheel Chart
$result = $client->western()->natal()->natalWheelChart($westernBirth);

// Natal Insights
$result = $client->western()->natal()->natalInsights($westernBirth);
```

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
$reportParams = array_merge($birthParams, [
    'company_name' => 'My Astrology Co',
    'company_url' => 'https://example.com',
    'company_email' => 'info@example.com',
    'company_mobile' => '+1234567890',
    'company_bio' => 'Expert astrology services',
    'logo_url' => 'https://example.com/logo.png',
    'footer_text' => 'Generated by My Astrology Co',
]);

// Kundali Sampoorna Report
$result = $client->pdfReport()->kundaliSampoorna($reportParams);

// Astrology Report with report code
$result = $client->pdfReport()->astrologyReport(
    array_merge($reportParams, ['report_code' => 'NATAL', 'theme' => 'classic'])
);
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
    'full_name' => 'John',
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

## License

MIT
