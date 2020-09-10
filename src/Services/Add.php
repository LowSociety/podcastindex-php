<?php
namespace PodcastIndex\Services;

class Add extends Service
{
    protected $endpoint = 'add';

    public function byFeedUrl(string $feedUrl)
    {
        return $this->get('byfeedurl', [
            'url' => $feedUrl
        ]);
    }
}