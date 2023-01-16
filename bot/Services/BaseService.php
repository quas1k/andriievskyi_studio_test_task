<?php

namespace Bot\Services;

use Bot\Database\Database;
use GuzzleHttp\Client;

abstract class BaseService
{
    /**
     * @var Client $client GuzzleHttp client for making requests
     */
    protected Client $client;
    /**
     * @var Database $database
     */
    protected Database $database;

    public function __construct()
    {
        $this->client = new Client();
        $this->database = new Database();
    }
}