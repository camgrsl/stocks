<?php

namespace CamilleG\Stocks\Adapters;

use CamilleG\Stocks\Collection\StocksCollection;
use Illuminate\Support\Facades\Http;

class PixabayAdapter extends FactoryAdapter
{
    /**
     * @return string
     * @throws \Exception
     */
    public function requestApi(): string
    {
        $response = Http::get($this->getApiUrl(), [
            'key' => $this->getApiToken(),
        ]);

        if ($response->failed()) {
            throw new \Exception('Failed requesting api');
        }

        return $response->body();
    }

    /**
     * @param string $response
     * @return \CamilleG\Stocks\Collection\StocksCollection
     * @throws \Exception
     */
    public function parseResponse(string $response): StocksCollection
    {
        $decodedResponse = json_decode($response);
        $collection = new StocksCollection();

        foreach ($decodedResponse->hits as $entry) {
            $collection->push([
                'url'    => $entry->largeImageURL,
                'width'  => $entry->imageWidth,
                'height' => $entry->imageHeight,
            ]);
        }

        return $collection;
    }
}