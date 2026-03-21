<?php

declare(strict_types=1);

namespace DivineApi\Api\Indian;

use DivineApi\HttpClient;

/**
 * Indian API - combines Panchang, Festival, Kundli, and MatchMaking sub-modules.
 */
class IndianApi
{
    private HttpClient $http;
    private ?PanchangApi $panchang = null;
    private ?FestivalApi $festival = null;
    private ?KundliApi $kundli = null;
    private ?MatchMakingApi $matchMaking = null;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    public function panchang(): PanchangApi
    {
        if ($this->panchang === null) {
            $this->panchang = new PanchangApi($this->http);
        }
        return $this->panchang;
    }

    public function festival(): FestivalApi
    {
        if ($this->festival === null) {
            $this->festival = new FestivalApi($this->http);
        }
        return $this->festival;
    }

    public function kundli(): KundliApi
    {
        if ($this->kundli === null) {
            $this->kundli = new KundliApi($this->http);
        }
        return $this->kundli;
    }

    public function matchMaking(): MatchMakingApi
    {
        if ($this->matchMaking === null) {
            $this->matchMaking = new MatchMakingApi($this->http);
        }
        return $this->matchMaking;
    }
}
