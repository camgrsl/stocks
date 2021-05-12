<?php

namespace CamilleG\Stocks\Collection;

use CamilleG\Stocks\Exceptions\InvalidStockFormat;

class StocksCollection
{
    /**
     * @var array
     */
    protected $stocks = [];

    /**
     * @param array $stock
     * @return $this
     * @throws \Exception
     */
    public function push(array $stock): self
    {
        if (! isset($stock['url']) || ! isset($stock['height']) || ! isset($stock['width'])) {
            throw new InvalidStockFormat('Invalid format');
        }

        $this->stocks[] = [
            'url'    => $stock['url'],
            'height' => $stock['height'],
            'width'  => $stock['width'],
        ];

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->stocks;
    }
}