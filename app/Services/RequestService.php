<?php

namespace App\Services;

use GuzzleHttp\Client;

class RequestService
{
    private $client;

    public function __construct(Client $client=null)
    {
        $this->client = $client;
    }

    public function get($url, $headers=[])
    {
        return $this->client->get($url, [
            'headers' => $headers,
            'timeout' => 8
        ])->getBody()->getContents();
    }
}
