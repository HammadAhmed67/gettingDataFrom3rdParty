<?php

use Symfony\Contracts\HttpClient\HttpClientInterface;

class createHelper {

    private HttpClientInterface $client;
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getUsers() : array
    {
        $url = 'https://gorest.co.in/public/v2/users';

        $response = $this->client->request('GET',$url);
        $parsedResponse = $response->toArray();

        return $parsedResponse['value'];
    }
}
