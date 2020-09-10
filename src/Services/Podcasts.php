<?php
namespace PodcastIndex\Services;

class Podcasts extends Service
{
    protected $endpoint = 'podcasts';

    public function byFeedUrl(string $feedUrl)
    {
        return $this->get('byfeedurl', [
            'url' => $feedUrl
        ]);
    }

    public function byFeedId($id)
    {
        return $this->get('byfeedid', [
            'id' => $id
        ]);
    }

    public function byITunesId($id)
    {
        return $this->get('byitunesid', [
            'id' => $id
        ]);
    }

    public function add(string $feedUrl)
    {
        return $this->client->add->byFeedUrl($feedUrl);
    }
}