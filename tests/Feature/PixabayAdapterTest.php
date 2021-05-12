<?php

namespace CamilleG\Stocks\Tests\Feature;

use CamilleG\Stocks\Collection\StocksCollection;
use CamilleG\Stocks\Tests\TestCase;

class PixabayAdapterTest extends TestCase
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function test_pixabay()
    {
        $stockService = app()->make('stocks');

        $stockCollection = $stockService->adapter('pixabay')->getStocksCollection();
        $this->assertTrue($stockCollection instanceof StocksCollection);

        $stockCollectionArray = $stockCollection->toArray();
        $this->assertIsArray($stockCollectionArray);

        $this->assertArrayHasKey('url', $stockCollectionArray[0]);
        $this->assertArrayHasKey('width', $stockCollectionArray[0]);
        $this->assertArrayHasKey('height', $stockCollectionArray[0]);
    }

    // I could also mock an invalid adapter which returns an invalid format
    // Then I could assert InvalidStockFormat Exeception is thrown (StockCollection L:21)
    //public function test_invalid_adapter()
    //{
    //
    //}
}
