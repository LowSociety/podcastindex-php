<?php
namespace PodcastIndex;

use DateTime;
use DateTimeZone;
use GuzzleHttp\RequestOptions;
use Exceptions\InvalidKeyException;

class Client
{   
    const VERSION = 'b1.0';

    const DEFAULT_API_VERSION = '1.0';

    const DEFAULT_API_URL = 'https://api.podcastindex.org/api';

    public function __construct(array $config = []) {
        $this->config = array_merge(
            [
                'app' => null,
                'key' => null,
                'secret' => null,
                'version' => static::DEFAULT_API_VERSION,
                'url' => static::DEFAULT_API_URL
            ],
            $config
        );

        if(!$this->config['app']) {
            throw new Exceptions\InvalidAppException('App cannot be empty.');
        }
        if(!$this->config['key']) {
            throw new Exceptions\InvalidKeyException('Key cannot be empty.');
        }
        if(!$this->config['secret']) {
            throw new Exceptions\InvalidSecretException('Secret cannot be empty.');
        }

        $this->httpClient = new HttpClient($this->config);
        $this->serviceFactory = new ServiceFactory($this);
    }

    public static function config(array $config = []) {
        return new self($config);
    }

    public function get(string $endpoint, array $query = []): Response
    {
        return $this->httpClient->get($endpoint, $query);
    }

    public function post(string $endpoint, $data = []): Response
    {
        return $this->httpClient->post($endpoint, $data);
    }

    public function put(string $endpoint, $data = []): Response
    {
        return $this->httpClient->put($endpoint, $data);
    }

    public function patch(string $endpoint, $data = []): Response
    {
        return $this->httpClient->patch($endpoint, $data);
    }

    public function withParameters(array $parameters)
    {
        $this->httpClient->withParameters($parameters);
        return $this;
    }

    public function __get($name)
    {
        return $this->serviceFactory->get($name);
    }

}