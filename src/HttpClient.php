<?php
namespace PodcastIndex;

use DateTime;
use DateTimeZone;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class HttpClient
{
    protected $config;

    public $parameters = [];

    public function __construct(array $config = [])
    {
        $this->config = $config;

        $clientConfig = array_merge(
            [
                'base_uri' => $this->getBaseUri()
            ],
            $config['http']?? []
        );

        $clientConfig[RequestOptions::HEADERS] = array_merge(
            [
                'User-Agent' => $this->config['app']?? 'podcastindex/podcastindex-php/' . $this->config['version'],
                'Content-Type' => 'application/json',
                'X-Auth-Key' => $this->config['key']
            ],
            $clientConfig[RequestOptions::HEADERS]?? []
        );

        $this->client = new Client(
            array_merge(
                [
                    'base_uri' => $this->getBaseUri(),
                ],
                $clientConfig
            )
        );
    }
    
    public function get(string $path, array $query = [], array $options = [])
    {
        return $this->request(
            'GET',
            $path,
            $options + [
                RequestOptions::QUERY => $query
            ]
        );
    }

    public function post(string $path, $data = [], array $options = [])
    {
        return $this->request(
            'POST',
            $path,
            $options + [
                RequestOptions::JSON => $data
            ]
        );
    }

    public function put(string $path, $data = [], array $options = [])
    {
        return $this->request(
            'PUT',
            $path,
            $options + [
                RequestOptions::JSON => $data
            ]
        );
    }

    public function patch(string $path, $data = [], array $options = [])
    {
        return $this->request(
            'PATCH',
            $path,
            $options + [
                RequestOptions::JSON => $data
            ]
        );
    }

    public function head(string $path, $data = [], array $options = [])
    {
        return $this->request(
            'HEAD',
            $path,
            $options + [
                RequestOptions::JSON => $data
            ]
        );
    }

    public function options(string $path, $data = [], array $options = [])
    {
        return $this->request(
            'OPTIONS',
            $path,
            $options + [
                RequestOptions::JSON => $data
            ]
        );
    }

    public function request(string $method, string $path, array $options = [])
    {
        return new Response($this->client->request(
            $method,
            ltrim($path,'/'),
            array_merge_recursive(
                $this->getRequestOptions(),
                $options
            )
        ));
    }

    public function withParameters(array $parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

    protected function getRequestOptions(): array
    {
        $timestamp = $this->getRequestTimestamp();

        return [
            RequestOptions::HEADERS => [
                'X-Auth-Date' => $timestamp,
                'Authorization' => sha1(implode('',[$this->config['key'],$this->config['secret'],$timestamp]))
            ],
            RequestOptions::QUERY => $this->parameters
        ];
    }

    protected function getRequestTimestamp()
    {
        return (new DateTime('now', new DateTimeZone('UTC')))->getTimestamp();
    }

    protected function getBaseUri($config = [])
    {
        return rtrim($this->config['url'],'/') . '/' . trim($this->config['version'],'/') . '/';
    }

}