<?php

namespace Bot\Services;

interface ServiceInterface
{
    public function __construct();

    public function getPairsPrices(string $pairs, string $vs_currency);

    public function handle($data);
}