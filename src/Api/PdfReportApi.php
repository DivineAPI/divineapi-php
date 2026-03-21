<?php

declare(strict_types=1);

namespace DivineApi\Api;

use DivineApi\HttpClient;

/**
 * PDF Report API endpoints (pdf.divineapi.com)
 *
 * #172-184. All accept birth params + company branding params.
 * Couple reports also accept p1_*/p2_* params.
 */
class PdfReportApi
{
    private const HOST = 'pdf.divineapi.com';

    private HttpClient $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    // ─── Indian Kundali Reports (#172-174) ──────────────────────

    /**
     * #172 Kundali Sampoorna
     * @param array Birth params + company branding params
     */
    public function kundaliSampoorna(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/kundali-sampoorna', $params);
    }

    /**
     * #173 Kundali Ananta
     */
    public function kundaliAnanta(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/kundali-ananta', $params);
    }

    /**
     * #174 Kundali Prakash
     */
    public function kundaliPrakash(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/kundali-prakash', $params);
    }

    // ─── Match Making (#175) ────────────────────────────────────

    /**
     * #175 Match Making Report
     * @param array Couple params + company branding params
     */
    public function matchMaking(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/match-making', $params);
    }

    // ─── Specialized Reports (#176-177) ─────────────────────────

    /**
     * #176 Government Job Report
     */
    public function governmentJobReport(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/government-job-report', $params);
    }

    /**
     * #177 Foreign Travel Settlement
     */
    public function foreignTravelSettlement(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/foreign-travel-settlement', $params);
    }

    // ─── Vedic Yearly Predictions (#178-180) ────────────────────

    /**
     * #178 Vedic Yearly Prediction - 5 Year
     */
    public function vedicYearlyPrediction5Year(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/vedic-yearly-prediction-5-year', $params);
    }

    /**
     * #179 Vedic Yearly Prediction - 10 Year
     */
    public function vedicYearlyPrediction10Year(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/vedic-yearly-prediction-10-year', $params);
    }

    /**
     * #180 Vedic Yearly Prediction - 15 Year
     */
    public function vedicYearlyPrediction15Year(array $params): array
    {
        return $this->http->post(self::HOST, '/indian-api/v2/vedic-yearly-prediction-15-year', $params);
    }

    // ─── Astrology Reports (#181-182) ───────────────────────────

    /**
     * #181 Astrology Report
     * @param array Birth params + report_code + theme + company branding params
     */
    public function astrologyReport(array $params): array
    {
        return $this->http->post(self::HOST, '/astrology/v2/report', $params);
    }

    /**
     * #182 Astrology Couple Report
     * @param array Couple params + report_code + company branding params
     */
    public function astrologyCoupleReport(array $params): array
    {
        return $this->http->post(self::HOST, '/astrology/v1/couple', $params);
    }

    // ─── Numerology Reports (#183-184) ──────────────────────────

    /**
     * #183 Numerology Prediction Reports
     * @param array Birth params + report_code + company branding params
     */
    public function numerologyPredictionReports(array $params): array
    {
        return $this->http->post(self::HOST, '/numerology/v1/prediction_reports', $params);
    }

    /**
     * #184 Numerology Report
     * @param array Birth params + report_code + company branding params
     */
    public function numerologyReport(array $params): array
    {
        return $this->http->post(self::HOST, '/numerology/v2/report', $params);
    }
}
