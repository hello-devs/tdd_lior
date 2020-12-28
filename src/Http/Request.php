<?php


namespace Tweeter\Http;


class Request
{
    private array $data;

    /**
     * Request constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function get(String $key){
        return $this->data[$key] ?? null;
    }

}