<?php
namespace PodcastIndex\Services;

class Search extends Service
{
    protected $endpoint = 'search';

    public function byTerm(string $term)
    {
        return $this->get('byterm', [
            'q' => $term
        ]);
    }
}