<?php

declare(strict_types=1);

namespace DivineApi\Api\Western;

use DivineApi\HttpClient;

/**
 * Western Natal API endpoints.
 *
 * #118-127 on astroapi-4, #128-138 on astroapi-8.
 * All accept birth params + house_system unless noted.
 *
 * house_system accepts friendly names (placidus, koch, porphyry, regiomontanus,
 * campanus, equal, whole-sign, morinus, alcabitius) or single-letter codes
 * (P, K, O, R, C, E, W, M, B); it is normalised to the letter code the API needs.
 */
class NatalApi
{
    private HttpClient $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    // ─── astroapi-4 endpoints (#118-127) ─────────────────────────

    /**
     * #118 Planetary Positions
     */
    public function planetaryPositions(array $params): array
    {
        return $this->http->post('astroapi-4.divineapi.com', '/western-api/v1/planetary-positions', HouseSystem::apply($params));
    }

    /**
     * #119 House Cusps
     */
    public function houseCusps(array $params): array
    {
        return $this->http->post('astroapi-4.divineapi.com', '/western-api/v1/house-cusps', HouseSystem::apply($params));
    }

    /**
     * #120 Aspect Table
     */
    public function aspectTable(array $params): array
    {
        return $this->http->post('astroapi-4.divineapi.com', '/western-api/v2/aspect-table', HouseSystem::apply($params));
    }

    /**
     * #121 Natal Wheel Chart
     * @param array Birth params + house_system + styling params
     */
    public function natalWheelChart(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v2/natal-wheel-chart', HouseSystem::apply($params));
    }

    /**
     * #122 General Sign Report
     * @param string $planet Planet name
     */
    public function generalSignReport(string $planet, array $params): array
    {
        return $this->http->post('astroapi-4.divineapi.com', "/western-api/v2/general-sign-report/{$planet}", HouseSystem::apply($params));
    }

    /**
     * #123 General House Report
     * @param string $planet Planet name
     */
    public function generalHouseReport(string $planet, array $params): array
    {
        return $this->http->post('astroapi-4.divineapi.com', "/western-api/v2/general-house-report/{$planet}", HouseSystem::apply($params));
    }

    /**
     * #124 Moon Phases
     */
    public function moonPhases(array $params): array
    {
        return $this->http->post('astroapi-4.divineapi.com', '/western-api/v2/moon-phases', HouseSystem::apply($params));
    }

    /**
     * #125 Ascendant Report
     */
    public function ascendantReport(array $params): array
    {
        return $this->http->post('astroapi-4.divineapi.com', '/western-api/v2/ascendant-report', HouseSystem::apply($params));
    }

    /**
     * #126 Moon Phase Calendar
     */
    public function moonPhaseCalendar(array $params): array
    {
        return $this->http->post('astroapi-4.divineapi.com', '/western-api/v1/moon-phase-calendar', HouseSystem::apply($params));
    }

    /**
     * #127 Natal Insights
     */
    public function natalInsights(array $params): array
    {
        return $this->http->post('astroapi-4.divineapi.com', '/western-api/v1/natal-insights', HouseSystem::apply($params));
    }

    // ─── astroapi-8 endpoints (#128-138) ─────────────────────────

    /**
     * #128 Arabic Lots
     */
    public function arabicLots(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v1/arabic-lots', HouseSystem::apply($params));
    }

    /**
     * #129 Asteroid Positions
     */
    public function asteroidPositions(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v1/asteroid-positions', HouseSystem::apply($params));
    }

    /**
     * #130 Fixed Stars List (api_key only)
     */
    public function fixedStarsList(array $params = []): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v1/fixed-stars-list', HouseSystem::apply($params));
    }

    /**
     * #131 Fixed Stars Details
     * @param array Birth params + star_list
     */
    public function fixedStarsDetails(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v1/fixed-stars-details', HouseSystem::apply($params));
    }

    /**
     * #132 Planetary Midpoints
     */
    public function planetaryMidpoints(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v1/planetary-midpoints', HouseSystem::apply($params));
    }

    /**
     * #133 Eclipse
     */
    public function eclipse(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v1/eclipse', HouseSystem::apply($params));
    }

    /**
     * #134 Declinations Parallels
     */
    public function declinationsParallels(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v1/declinations-parallels', HouseSystem::apply($params));
    }

    /**
     * #135 Aspect Patterns
     */
    public function aspectPatterns(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v1/aspect-patterns', HouseSystem::apply($params));
    }

    /**
     * #136 Chart Shape
     */
    public function chartShape(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v1/chart-shape', HouseSystem::apply($params));
    }

    /**
     * #137 Other Minor Bodies
     */
    public function otherMinorBodies(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v1/other-minor-bodies', HouseSystem::apply($params));
    }

    /**
     * #138 Dominants
     * @param array Birth params + method
     */
    public function dominants(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v1/dominants', HouseSystem::apply($params));
    }
}
