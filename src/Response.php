<?php
namespace PodcastIndex;

use Psr\Http\Message\ResponseInterface;

class Response
{   
    protected $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function body()
    {
        return $this->response->getBody()->getContents();
    }

    public function json()
    {
        return json_decode($this->body());
    }

    public function headers()
    {
        return $this->response->getHeaders();
    }

    public function code()
    {
        return $this->response->getStatusCode();
    }

    public function reason()
    {
        return $this->response->getReasonPhrase();
    }

    public function __call($method, $params)
    {
        return \call_user_func_array([$this->response, $method], $params);
    }

    public function __get($key)
    {
        return $this->response->{$key};
    }
}