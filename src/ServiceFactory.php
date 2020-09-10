<?php
namespace PodcastIndex;

use PodcastIndex\Services\Service;

class ServiceFactory
{
    private static $classMap = [
        'search' => Services\Search::class,
        'podcasts' => Services\Podcasts::class,
        'episodes' => Services\Episodes::class,
        'recent' => Services\Recent::class,
        'add' => Services\Add::class
    ];

    protected $client;

    protected $services = [];

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get(string $key): ?Service
    {
        if(!array_key_exists($key, $this->services)) {
            $this->services[$key] = array_key_exists($key, self::$classMap)? new self::$classMap[$key]($this->client) : null;
        }
        return $this->services[$key];
    }

    public function __get($name)
    {
        return $this->get($name);
    }
}