<?php

declare(strict_types=1);

namespace DivineApi\Api\Western;

use DivineApi\HttpClient;

/**
 * Western Synastry API endpoints (astroapi-4.divineapi.com)
 *
 * All accept couple params (p1_*, p2_*) + lan + house_system.
 * house_system accepts friendly names (placidus, koch, ...) or single-letter
 * codes (P, K, O, R, C, E, W, M, B); it is normalised to the letter code.
 */
class SynastryApi
{
    private const HOST = 'astroapi-4.divineapi.com';

    private HttpClient $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    // ─── Core Synastry (#139-146) ────────────────────────────────

    /**
     * #139 Synastry Planetary Positions
     */
    public function planetaryPositions(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v1/synastry/planetary-positions', HouseSystem::apply($params));
    }

    /**
     * #140 Synastry House Cusps
     */
    public function houseCusps(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v1/synastry/house-cusps', HouseSystem::apply($params));
    }

    /**
     * #141 Synastry Natal Wheel Chart
     */
    public function natalWheelChart(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v2/synastry/natal-wheel-chart', HouseSystem::apply($params));
    }

    /**
     * #142 Synastry Aspect Table
     */
    public function aspectTable(array $params): array
    {
        return $this->http->post('astroapi-8.divineapi.com', '/western-api/v2/synastry/aspect-table', HouseSystem::apply($params));
    }

    /**
     * #143 Harmonious Aspect Reading
     */
    public function harmoniousAspectReading(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v1/synastry/harmonious-aspect-reading', HouseSystem::apply($params));
    }

    /**
     * #144 Conflicting Aspect Reading
     */
    public function conflictingAspectReading(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v1/synastry/conflicting-aspect-reading', HouseSystem::apply($params));
    }

    /**
     * #145 Contrasting Aspect Reading
     */
    public function contrastingAspectReading(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v1/synastry/contrasting-aspect-reading', HouseSystem::apply($params));
    }

    /**
     * #146 Intense Aspect Reading
     */
    public function intenseAspectReading(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v1/synastry/intense-aspect-reading', HouseSystem::apply($params));
    }

    // ─── Compatibility (#147-151) ────────────────────────────────

    /**
     * #147 Physical Compatibility
     */
    public function physicalCompatibility(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v2/synastry/physical-compatibility', HouseSystem::apply($params));
    }

    /**
     * #148 Emotional Compatibility
     */
    public function emotionalCompatibility(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v2/synastry/emotional-compatibility', HouseSystem::apply($params));
    }

    /**
     * #149 Sexual Compatibility
     */
    public function sexualCompatibility(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v2/synastry/sexual-compatibility', HouseSystem::apply($params));
    }

    /**
     * #150 Spiritual Compatibility
     */
    public function spiritualCompatibility(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v2/synastry/spiritual-compatibility', HouseSystem::apply($params));
    }

    /**
     * #151 Financial Compatibility
     */
    public function financialCompatibility(array $params): array
    {
        return $this->http->post(self::HOST, '/western-api/v2/synastry/financial-compatibility', HouseSystem::apply($params));
    }
}
