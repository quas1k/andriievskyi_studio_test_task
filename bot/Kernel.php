<?php

namespace Bot;

use Bot\Config\Config;
use Bot\Services\CoingeckoService;
use Bot\Services\CryptorankService;

/**
 * Class Kernel
 */
class Kernel
{

    /**
     * Kernel constructor
     */
    public function __construct()
    {
        Config::init('config.ini');
    }

    /**
     * Starting services from configuration
     */
    public function handle(): void
    {
        // Get available services from config file
        $services = explode(',', Config::get('services'));

        // Check and start if coingecko service is enabled
        if (in_array('coingecko', $services))
        {
            $pairs = Config::get('coingecko_pairs');
            $vs_currency = Config::get('coingecko_vs_currency');

            $service = new CoingeckoService();
            $service->handle(
                $service->getPairsPrices($pairs, $vs_currency)->getBody()->getContents()
            );
        }

        // Check and start if cryptorank service is enabled
        if (in_array('cryptorank', $services))
        {
            $pairs = Config::get('cryptorank_pairs');
            $vs_currency = Config::get('cryptorank_vs_currency');

            $service = new CryptorankService();
            $service->handle(
                $service->getPairsPrices($pairs, $vs_currency)->getBody()->getContents()
            );
        }
    }

}