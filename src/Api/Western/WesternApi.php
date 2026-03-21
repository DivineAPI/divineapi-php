<?php

declare(strict_types=1);

namespace DivineApi\Api\Western;

use DivineApi\HttpClient;

/**
 * Western API - combines Natal, Synastry, Transit, Composite,
 * PlanetReturns, Progressions, and Prenatal sub-modules.
 */
class WesternApi
{
    private HttpClient $http;
    private ?NatalApi $natal = null;
    private ?SynastryApi $synastry = null;
    private ?TransitApi $transit = null;
    private ?CompositeApi $composite = null;
    private ?PlanetReturnsApi $planetReturns = null;
    private ?ProgressionsApi $progressions = null;
    private ?PrenatalApi $prenatal = null;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    public function natal(): NatalApi
    {
        if ($this->natal === null) {
            $this->natal = new NatalApi($this->http);
        }
        return $this->natal;
    }

    public function synastry(): SynastryApi
    {
        if ($this->synastry === null) {
            $this->synastry = new SynastryApi($this->http);
        }
        return $this->synastry;
    }

    public function transit(): TransitApi
    {
        if ($this->transit === null) {
            $this->transit = new TransitApi($this->http);
        }
        return $this->transit;
    }

    public function composite(): CompositeApi
    {
        if ($this->composite === null) {
            $this->composite = new CompositeApi($this->http);
        }
        return $this->composite;
    }

    public function planetReturns(): PlanetReturnsApi
    {
        if ($this->planetReturns === null) {
            $this->planetReturns = new PlanetReturnsApi($this->http);
        }
        return $this->planetReturns;
    }

    public function progressions(): ProgressionsApi
    {
        if ($this->progressions === null) {
            $this->progressions = new ProgressionsApi($this->http);
        }
        return $this->progressions;
    }

    public function prenatal(): PrenatalApi
    {
        if ($this->prenatal === null) {
            $this->prenatal = new PrenatalApi($this->http);
        }
        return $this->prenatal;
    }
}
