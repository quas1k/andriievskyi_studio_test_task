<?php

namespace Bot\Services;

use Bot\Config\Config;
use Ramsey\Uuid\Uuid;

class CoingeckoService extends BaseService implements ServiceInterface
{
    /**
     * Return prices for pairs
     * @param string $pairs
     * @param string $vs_currency
     * @return \Psr\Http\Message\ResponseInterface|void
     */
    public function getPairsPrices(string $pairs, string $vs_currency)
    {
        try {
            return $this->client->request('GET', 'https://api.coingecko.com/api/v3/simple/price', [
                'query' => [
                    'ids' => $pairs,
                    'vs_currencies' => $vs_currency,
                    'precision' => 2
                ]
            ]);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            die("Error with Coingecko request: " . $e->getMessage());
        }
    }

    /**
     * Add data to database
     * @param $data
     */
    public function handle($data): void
    {
        $vs_currency = Config::get('coingecko_vs_currency');

        foreach (json_decode($data, false) as $crypto_currency => $price)
        {
            $this->database->insert('pair_prices', [
                'id' => Uuid::uuid4(),
                'crypto_currency' => $crypto_currency,
                'vs_currency' => $vs_currency,
                'price' => $price->{strtolower($vs_currency)},
                'service' => 'coingecko'
            ]);
        }
    }
}