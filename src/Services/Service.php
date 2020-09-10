<?php
namespace PodcastIndex\Services;

use PodcastIndex\Client;

abstract class Service
{
    protected $client;

    protected $endpoint = '';

    protected $parameters = [];

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get(string $endpoint, array $query = [])
    {
        return $this->client->get(
            $this->getFullEndpoint($endpoint),
            $this->getFullQuery($query)
        );
    }

    public function post(string $endpoint, array $data = [])
    {
        return $this->client->post(
            $this->getFullEndpoint($endpoint),
            $data
        );
    }

    public function withParameters(array $parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

    protected function getFullEndpoint(string $endpoint)
    {
        return $this->endpoint . '/' . ltrim($endpoint,'/');
    }

    protected function getFullQuery(array $query = [])
    {
        return array_merge($this->parameters, $query);
    }
}