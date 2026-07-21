<?php

declare(strict_types=1);

namespace DivineApi\Api\Indian;

use DivineApi\HttpClient;

/**
 * Indian Kundli API endpoints (astroapi-3.divineapi.com)
 *
 * Covers: Jaimini, Sub Planets, KP, Kundali Transit, Bhinnashtakvarga,
 * Dasha Analysis, Lal Kitab, and all birth-chart related endpoints.
 */
class KundliApi
{
    private const HOST = 'astroapi-3.divineapi.com';

    private HttpClient $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    // ─── Jaimini (#72-75) ────────────────────────────────────────

    /**
     * #72 Jaimini Planetary Positions
     * @param array Birth params: full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan
     */
    public function jaiminiPlanetaryPositions(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/jaimini-astrology/planetary-positions', $params);
    }

    /**
     * #73 Jaimini Padas
     */
    public function jaiminiPadas(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/jaimini-astrology/padas', $params);
    }

    /**
     * #74 Jaimini Karakamsha Lagna
     */
    public function jaiminiKarakamshaLagna(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/jaimini-astrology/karakamsha-lagna', $params);
    }

    /**
     * #75 Jaimini Chara Dasha
     */
    public function jaiminiCharaDasha(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/jaimini-astrology/chara-dasha', $params);
    }

    // ─── Sub Planets (#76-77) ────────────────────────────────────

    /**
     * #76 Sub Planet Positions
     */
    public function subPlanetPositions(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/sub-planet-positions', $params);
    }

    /**
     * #77 Sub Planet Chart
     */
    public function subPlanetChart(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/sub-planet-chart', $params);
    }

    // ─── KP System (#78-82) ─────────────────────────────────────

    /**
     * #78 KP Planetary Positions
     */
    public function kpPlanetaryPositions(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/kp/planetary-positions', $params);
    }

    /**
     * #79 KP Cuspal
     */
    public function kpCuspal(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/kp/cuspal', $params);
    }

    /**
     * #80 KP Planetary Sub
     */
    public function kpPlanetarySub(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/kp/planetary-sub', $params);
    }

    /**
     * #81 KP Planetary Cuspal Significator Table
     */
    public function kpPlanetaryCuspalSignificatorTable(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/kp/planetary-cuspal-significator-table', $params);
    }

    /**
     * #82 KP Cuspal Sub
     */
    public function kpCuspalSub(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/kp/cuspal-sub', $params);
    }

    // ─── Kundali Transit (#83-84) ────────────────────────────────

    /**
     * #83 Kundali Transit Ascendant
     * @param array Birth params + transit params + chart styling
     */
    public function kundliTransitAscendant(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/kundli-transit/ascendant', $params);
    }

    /**
     * #84 Kundali Transit Moon
     * @param array Birth params + transit params + chart styling
     */
    public function kundliTransitMoon(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/kundli-transit/moon', $params);
    }

    // ─── Bhinnashtakvarga (#85-87) ──────────────────────────────

    /**
     * #85 Ashtakvarga
     */
    public function ashtakvarga(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/bhinnashtakvarga/ashtakvarga', $params);
    }

    /**
     * #86 Sarvashtakavarga Chart
     * @param string $chartId Chart identifier
     */
    public function sarvashtakavargaChart(string $chartId, array $params): array
    {
        return $this->http->post(self::HOST, "/indian-api/v1/bhinnashtakvarga/sarvashtakavarga/{$chartId}", $params);
    }

    /**
     * #87 Prasthara Chakra
     */
    public function prastharaChakra(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/bhinnashtakvarga/prasthara-chakra', $params);
    }

    // ─── Dasha Analysis (#88-90) ────────────────────────────────

    /**
     * #88 Maha Dasha Analysis
     * @param array{maha_dasha: string, lan?: string} $params
     */
    public function mahaDashaAnalysis(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/maha-dasha-analysis', $params);
    }

    /**
     * #89 Antar Dasha Analysis
     * @param array{maha_dasha: string, antar_dasha: string, lan?: string} $params
     */
    public function antarDashaAnalysis(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/antar-dasha-analysis', $params);
    }

    /**
     * #90 Pratyantar Dasha Analysis
     * @param array{maha_dasha: string, antar_dasha: string, pratyantar_dasha: string, lan?: string} $params
     */
    public function pratyantarDashaAnalysis(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/pratyantar-dasha-analysis', $params);
    }

    // ─── Kundli Endpoints (#91-109) ─────────────────────────────

    /**
     * #91 Basic Astro Details
     */
    public function basicAstroDetails(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v3/basic-astro-details', $params);
    }

    /**
     * #92 Planetary Positions
     */
    public function planetaryPositions(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/planetary-positions', $params);
    }

    /**
     * #93 Horoscope Chart
     * @param string $chartId Chart identifier (e.g., 'D1', 'D9', etc.)
     */
    public function horoscopeChart(string $chartId, array $params): array
    {
        return $this->http->post(self::HOST, "/indian-api/v1/horoscope-chart/{$chartId}", $params);
    }

    /**
     * #94 Vimshottari Dasha
     * @param array Birth params + dasha_type
     */
    public function vimshottariDasha(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/vimshottari-dasha', $params);
    }

    /**
     * #95 Kaal Sarpa Yoga
     */
    public function kaalSarpaYoga(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/kaal-sarpa-yoga', $params);
    }

    /**
     * #96 Manglik Dosha
     */
    public function manglikDosha(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/manglik-dosha', $params);
    }

    /**
     * #97 Ascendant Report
     */
    public function ascendantReport(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/ascendant-report', $params);
    }

    /**
     * #98 Composite Friendship
     */
    public function compositeFriendship(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/composite-friendship', $params);
    }

    /**
     * #99 Bhava Kundli
     * @param string $chartId Chart identifier
     */
    public function bhavaKundli(string $chartId, array $params): array
    {
        return $this->http->post(self::HOST, "/indian-api/v1/bhava-kundli/{$chartId}", $params);
    }

    /**
     * #100 Sadhe Sati
     */
    public function sadheSati(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v3/sadhe-sati', $params);
    }

    /**
     * #101 Ghata Chakra
     */
    public function ghataChakra(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/ghata-chakra', $params);
    }

    /**
     * #102 Shadbala
     */
    public function shadbala(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/shadbala', $params);
    }

    /**
     * #103 Gemstone Suggestion
     */
    public function gemstoneSuggestion(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/gemstone-suggestion', $params);
    }

    /**
     * #104 Yogini Dasha
     */
    public function yoginiDasha(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/yogini-dasha', $params);
    }

    /**
     * #105 Kaal Chakra Dasha
     */
    public function kaalChakraDasha(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/kaal-chakra-dasha', $params);
    }

    /**
     * #106 Yogas
     */
    public function yogas(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/yogas', $params);
    }

    /**
     * #107 Pitra Dosha
     */
    public function pitraDosha(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/pitra-dosha', $params);
    }

    /**
     * #108 Planet Analysis
     * @param array Birth params + analysis_planet
     */
    public function planetAnalysis(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/planet-analysis', $params);
    }

    /**
     * #109 Sudarshana Chakra
     */
    public function sudarshanaChakra(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/sudarshana-chakra', $params);
    }

    // ─── Lal Kitab (#213-228) ───────────────────────────────────

    /**
     * #213 Lal Kitab Planetary Positions
     * @param array Birth params: full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan
     */
    public function lalKitabPlanetaryPositions(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/lal-kitab/planetary-positions', $params);
    }

    /**
     * #214 Lal Kitab Horoscope Chart
     * @param array Birth params: full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan
     */
    public function lalKitabHoroscopeChart(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/lal-kitab/horoscope-chart', $params);
    }

    /**
     * #215 Lal Kitab House Position
     * @param array Birth params: full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan
     */
    public function lalKitabHousePosition(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/lal-kitab/house-position', $params);
    }

    /**
     * #216 Lal Kitab Conjunctions
     * @param array Birth params: full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan
     */
    public function lalKitabConjunctions(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/lal-kitab/conjunctions', $params);
    }

    /**
     * #217 Lal Kitab Teva
     * @param array Birth params: full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan
     */
    public function lalKitabTeva(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/lal-kitab/teva', $params);
    }

    /**
     * #218 Lal Kitab Planet Analysis
     * @param array Birth params (full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan) + analysis_planet (sun, moon, mars, mercury, jupiter, venus, saturn, rahu or ketu)
     */
    public function lalKitabPlanetAnalysis(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/lal-kitab/planet-analysis', $params);
    }

    /**
     * #219 Lal Kitab Dasha
     * @param array Birth params: full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan
     */
    public function lalKitabDasha(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/lal-kitab/dasha', $params);
    }

    /**
     * #220 Lal Kitab Planet Types
     * @param array Birth params: full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan
     */
    public function lalKitabPlanetTypes(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/lal-kitab/planet-types', $params);
    }

    /**
     * #221 Lal Kitab Mahadasha Content (no birth data needed)
     * @param array{maha_dasha: string, lan?: string} $params
     */
    public function lalKitabMahadashaContent(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/lal-kitab/mahadasha-content', $params);
    }

    /**
     * #222 Lal Kitab Antardasha Content (no birth data needed)
     * The antar_dasha must be valid for the chosen maha_dasha; the API lists the valid values on mismatch.
     * @param array{maha_dasha: string, antar_dasha: string, lan?: string} $params
     */
    public function lalKitabAntardashaContent(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/lal-kitab/antardasha-content', $params);
    }

    /**
     * #223 Lal Kitab Debts
     * @param array Birth params: full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan
     */
    public function lalKitabDebts(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/lal-kitab/debts', $params);
    }

    /**
     * #224 Lal Kitab House Signification
     * @param array Birth params (full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan) + house_no (1-12)
     */
    public function lalKitabHouseSignification(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/lal-kitab/house-signification', $params);
    }

    /**
     * #225 Lal Kitab Varshphal Varsha Pravesh
     * @param array Birth params (full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan) + varshphal_year
     */
    public function lalKitabVarshphalVarshaPravesh(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/lal-kitab/varshphal/varsha-pravesh', $params);
    }

    /**
     * #226 Lal Kitab Varshphal Planetary Positions
     * @param array Birth params (full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan) + varshphal_year
     */
    public function lalKitabVarshphalPlanetaryPositions(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/lal-kitab/varshphal/planetary-positions', $params);
    }

    /**
     * #227 Lal Kitab Varshphal Muntha
     * @param array Birth params (full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan) + varshphal_year
     */
    public function lalKitabVarshphalMuntha(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/lal-kitab/varshphal/muntha', $params);
    }

    /**
     * #228 Lal Kitab Varshphal Chart
     * @param array Birth params (full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan) + varshphal_year
     */
    public function lalKitabVarshphalChart(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/lal-kitab/varshphal/chart', $params);
    }

    // ─── Additional Kundli Analysis (#229-234) ──────────────────

    /**
     * #229 Vargottama Planets
     * @param array Birth params: full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan
     */
    public function vargottamaPlanets(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/vargottama-planets', $params);
    }

    /**
     * #230 Bhav Bala
     * @param array Birth params: full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan
     */
    public function bhavBala(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/bhav-bala', $params);
    }

    /**
     * #231 Shani Ashtam Shani
     * @param array Birth params: full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan
     */
    public function shaniAshtamShani(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/shani-ashtam-shani', $params);
    }

    /**
     * #232 Bhava Analysis
     * @param array Birth params: full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan
     */
    public function bhavaAnalysis(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/bhava-analysis', $params);
    }

    /**
     * #233 Bhava Group Predictions
     * @param array Birth params: full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan
     */
    public function bhavaGroupPredictions(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/bhava-group-predictions', $params);
    }

    /**
     * #234 Planet Remedies
     * @param array Birth params (full_name, day, month, year, hour, min, sec, gender, place, lat, lon, tzone, lan) + analysis_planet (sun, moon, mars, mercury, jupiter, venus, saturn, rahu or ketu)
     */
    public function planetRemedies(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/planet-remedies', $params);
    }

    /**
     * Rudraksh Suggestion.
     */
    public function rudrakshaSuggestion(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v1/rudraksha-suggestion', $params);
    }
}
