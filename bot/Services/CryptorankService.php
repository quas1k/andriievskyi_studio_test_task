<?php

namespace Bot\Services;

use Bot\Config\Config;
use Ramsey\Uuid\Uuid;

class CryptorankService extends BaseService implements ServiceInterface
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
            return $this->client->request('GET', 'https://api.cryptorank.io/v1/currencies', [
                'query' => [
                    'api_key' => Config::get('cryptorank_api_key'),
                    'symbols' => $pairs,
                    'convert' => $vs_currency
                ]
            ]);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            die("Error with Cryprorank request: " . $e->getMessage());
        }
    }

    /**
     * Add data to database
     * @param $data
     */
    public function handle($data): void
    {
        $vs_currency = Config::get('cryptorank_vs_currency');

        foreach (json_decode($data, false)->data as $crypto_currency)
        {
            $this->database->insert('pair_prices', [
                'id' => Uuid::uuid4(),
                'crypto_currency' => $crypto_currency->slug,
                'vs_currency' => $vs_currency,
                'price' => $crypto_currency->values->{$vs_currency}->price,
                'service' => 'cryptorank'
            ]);
        }
    }
}