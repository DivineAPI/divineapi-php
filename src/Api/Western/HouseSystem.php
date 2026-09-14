<?php

declare(strict_types=1);

namespace DivineApi\Api\Western;

/**
 * Maps friendly house-system names to the Swiss Ephemeris single-letter codes
 * the live API accepts. The API rejects word values like "placidus" on
 * astroapi-4 (and silently ignores them on astroapi-8), so every western
 * payload must carry the letter code.
 *
 * Friendly names and already-valid letter codes are both accepted. Any value
 * that is neither a known name nor a valid letter is passed through unchanged
 * so the API remains the final arbiter (preserves the SDK's passthrough style).
 */
final class HouseSystem
{
    /** Friendly name (lowercase) => single-letter API code. */
    private const FRIENDLY_TO_LETTER = [
        'placidus'      => 'P',
        'koch'          => 'K',
        'porphyry'      => 'O',
        'regiomontanus' => 'R',
        'campanus'      => 'C',
        'equal'         => 'E',
        'equal-asc'     => 'A',
        'equal_asc'     => 'A',
        'equal-mc'      => 'D',
        'equal_mc'      => 'D',
        'vehlow'        => 'V',
        'vehlow-equal'  => 'V',
        'whole-sign'    => 'W',
        'whole_sign'    => 'W',
        'wholesign'     => 'W',
        'meridian'      => 'X',
        'axial-rotation' => 'X',
        'morinus'       => 'M',
        'sripati'       => 'S',
        'topocentric'   => 'T',
        'polich-page'   => 'T',
        'alcabitius'    => 'B',
        'whole-sign-aries' => 'N',
        'whole_sign_aries' => 'N',
    ];

    /**
     * Valid single-letter codes the API accepts. Verified 2026-09-14 against
     * astroapi-4 /planetary-positions and astroapi-8 /persona-chart: all
     * sixteen return success. A and E are both Equal (from Asc).
     */
    private const VALID_LETTERS = [
        'P', 'K', 'O', 'R', 'C', 'A', 'E', 'D',
        'V', 'W', 'X', 'M', 'S', 'T', 'B', 'N',
    ];

    /**
     * Resolve a single house_system value to its letter code.
     * Valid letters pass through (upper-cased); friendly names map to letters;
     * anything else is returned unchanged.
     */
    public static function resolve(string $value): string
    {
        $trimmed = trim($value);
        if ($trimmed === '') {
            return $value;
        }
        if (in_array(strtoupper($trimmed), self::VALID_LETTERS, true)) {
            return strtoupper($trimmed);
        }
        return self::FRIENDLY_TO_LETTER[strtolower($trimmed)] ?? $value;
    }

    /**
     * Return a copy of $params with house_system normalised to a letter code
     * (if present). Callers with no house_system key are unaffected.
     */
    public static function apply(array $params): array
    {
        if (isset($params['house_system']) && is_scalar($params['house_system'])) {
            $params['house_system'] = self::resolve((string) $params['house_system']);
        }
        return $params;
    }
}
