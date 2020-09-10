# podcastindex-php
A PHP wrapper for the PodcastIndex API.

## Installation

Install the library using Composer. Please read the [Composer Documentation](https://getcomposer.org/doc/01-basic-usage.md) if you are unfamiliar with Composer or dependency managers in general.

```json
"require": {
    "podcastindex/podcastindex-php": "~1.0"
}
```

## Example usage

See the [PodcastIndex Documention](https://api.podcastindex.org/developer_docs) for all available methods.

```php
$client = new PodcastIndex\Client([
    'app' => 'AppName',
    'key' => $key,
    'secret' => $secret
]);
$searchResult = $client->search->byTerm('batman university')->json();

$podcasts = $client->podcasts->byFeedUrl('https://feeds.theincomparable.com/batmanuniversity')->json();
```

If an endpoint is not (yet) available in this library, you can always manually call `$client->get('/full/endpoint/url/', $query)` for a manual interface.