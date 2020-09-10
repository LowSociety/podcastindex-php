<?php
namespace PodcastIndex\Services;

class Episodes extends Service
{
    protected $endpoint = 'episodes';

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
}