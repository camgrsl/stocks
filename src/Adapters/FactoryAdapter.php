<?php

namespace CamilleG\Stocks\Adapters;

use CamilleG\Stocks\Collection\StocksCollection;

abstract class FactoryAdapter
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @return mixed
     */
    abstract public function requestApi(): string;

    /**
     * @param string $response
     * @return \CamilleG\Stocks\Collection\StocksCollection
     */
    abstract public function parseResponse(string $response): StocksCollection;

    /**
     * FactoryAdapter constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return \CamilleG\Stocks\Collection\StocksCollection
     */
    final public function getStocksCollection(): StocksCollection
    {
        return $this->parseResponse($this->requestApi());
    }

    /**
     * @return mixed
     */
    protected function getApiUrl(): string
    {
        return $this->config['url'];
    }

    /**
     * @return mixed
     */
    protected function getApiToken(): string
    {
        return $this->config['key'];
    }
}