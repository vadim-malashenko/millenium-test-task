<?php

namespace Millenium\TestTask\Http;

class Request
{
    public readonly array $server;
    public readonly array $request;
    public readonly array $get;
    public readonly array $post;
    public readonly array $session;

    protected Uri $uri;
    protected string $method;
    protected array $query = [];
    protected array $attributes = [];
    protected string $target = "/";
    protected array $headers = [];
    protected string $body = "";

    function __construct
    (
        ?array $server = null,
        ?array $request = null,
        ?array $get = null,
        ?array $post = null,
        ?array $session = null
    )
    {
        $this->server = $server ?? $_SERVER;
        $this->request = $request ?? $_REQUEST;
        $this->get = $get ?? $_GET;
        $this->post = $post ?? $_POST;
        //$this->session = $session ?? $_SESSION;

        $this->uri = new Uri($this->server['REQUEST_URI']);
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        parse_str($this->uri->getQuery(), $this->query);

        foreach($this->server as $key => $value)
        {
            $keys = explode('_' ,$key);

            if ("HTTP" === array_shift($keys))
            { 
                array_walk($keys, fn (&$key) => ucfirst(strtolower($key)));
                $this->headers[implode("-", $keys)] = $value;
            } 
        }
        
        if ("post" === $this->method)
        {
            $this->body = file_get_contents("php://input");
        }
    }

    function getMethod(): string
    {
        return $this->method;
    }
    
    function getQueryParams(): array
    {
        return $this->query;
    }
    
    function withQueryParams(array $query): static
    {
        $this->query = $query;

        return $this;
    }
    
    function getAttributes(): mixed
    {
        return $this->attributes;
    }
    
    function getAttribute($name, $default = null)
    {
        return $this->attributes[$name] ?? $default;
    }
    
    function withAttribute($name, $value): static
    {
        $this->attributes[$name] = $value;

        return $this;
    }
    
    function withoutAttribute($name): static
    {
        unset($this->attributes[$name]);

        return $this;
    }
    
    function getUri(): Uri
    {
        return $this->uri;
    }
    
    function getHeaders(): array
    {
        return $this->headers;
    }
    
    function hasHeader($name): bool
    {
        return isset($this->headers[$name]);
    }
    
    function withHeader($name, $value): static
    {
        $this->headers[$name] = $value;

        return $this;
    }
    
    function getBody(): string
    {
        return $this->body;
    }
    
    function withBody($body): static
    {
        $this->body = $body;

        return $this;
    }
}