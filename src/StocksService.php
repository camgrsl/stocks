<?php

namespace CamilleG\Stocks;

use CamilleG\Stocks\Adapters\FactoryAdapter;
use CamilleG\Stocks\Exceptions\InvalidStocksAdapter;
use Illuminate\Support\Collection;

class StocksService
{
    /**
     * @var array
     */
    protected $adapterInstances;

    /**
     * @var Collection
     */
    protected $filteredAdaptersConfig;

    /**
     * StocksService constructor.
     *
     * @param array $stocksConfig
     */
    public function __construct(array $stocksConfig)
    {
        $this->filteredAdaptersConfig = $this->filterAvailableStocksAdapters($stocksConfig);
    }

    /**
     * @param $driverName
     * @return \CamilleG\Stocks\Adapters\FactoryAdapter
     * @throws \CamilleG\Stocks\Exceptions\InvalidStocksAdapter
     */
    public function adapter($driverName): FactoryAdapter
    {
        if (! isset($this->adapterInstances[$driverName])) {
            if ($config = $this->filteredAdaptersConfig->get($driverName)) {
                $adapterClass = $config['class'];
                $this->adapterInstances[$driverName] = new $adapterClass($config);
            } else {
                throw new InvalidStocksAdapter();
            }
        }

        return $this->adapterInstances[$driverName];
    }

    /**
     * @param array $stocksConfig
     * @return \Illuminate\Support\Collection
     */
    protected function filterAvailableStocksAdapters(array $stocksConfig): Collection
    {
        return collect($stocksConfig)
            ->where('url', '!=', null)
            ->where('key', '!=', null)
            ->where('enabled', true);
    }
}
