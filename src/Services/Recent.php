<?php
namespace PodcastIndex\Services;

class Recent extends Service
{
    protected $endpoint = 'recent';

    public function episodes(array $options = [])
    {
        return $this->get('episodes', $options);
    }

    public function feeds(array $options = [])
    {
        return $this->get('feeds', $options);
    }
}