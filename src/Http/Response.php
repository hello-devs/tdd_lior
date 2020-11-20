<?php
namespace Tdd\Http;

class Response{
    protected string $content = '';
    protected array $headers = [];
    protected int $statusCode = 200;

    public function __construct(string $content = '',int $statusCode = 200, array $headers = ['Content-Type' => 'text/html']){
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    /**
     * Get the value of statusCode
     */ 
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set the value of statusCode
     *
     * @return  self
     */ 
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Get the value of headers
     */ 
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set the value of headers
     *
     * @return  self
     */ 
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function send(){
        //Headers
        /**
         * [
         *  'Content-Type' => 'text/html',
         *  'lang' => 'fr_FR' ...    
         * ]
         */
        foreach($this->headers as $key => $value){
            header("$key: $value");
        }

        //statusCode
        http_response_code($this->statusCode);

        //content
        echo $this->content;
    }
}