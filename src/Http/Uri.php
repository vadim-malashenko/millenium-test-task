<?php

namespace Millenium\TestTask\Http;

class Uri
{
    protected string $scheme = '';
    protected string $host = 'localhost';
    protected ?int $port = null;
    protected string $path = '';
    protected string $query = '';
    protected string $fragment = '';
    protected string $user = '';
    protected ?string $pass = null;

    function __construct(string $url)
    {
        $components = parse_url($url);

        if (false === $components)
        {
            throw new \InvalidArgumentException("Invalid URL: {$url}");
        }

        foreach ($components as $key => $value)
        {
            $this->$key = $value;
        }
    }

    function getScheme(): string
    {
        return $this->scheme;
    }

    function getHost(): string
    {
        return $this->host;
    }

    function getPath(): string
    {
        return $this->path;
    }

    function getQuery(): string
    {
        return $this->query;
    }

    function withPath($path): static
    {
        $this->path = $path;

        return $this;
    }

    function withQuery($query): static
    {
        $this->query = $query;

        return $this;
    }

    function __toString(): string
    {
        return sprintf(
            "%s://%s%s%s",
            $this->getScheme(),
            $this->getHost(),
            $this->getPath(),
            $this->getQuery()
        );
    }
}