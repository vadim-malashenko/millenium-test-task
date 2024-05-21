<?php

namespace Millenium\TestTask\Http;

class Route
{
    public readonly string $method;
    public readonly string $pattern;
    public readonly array $matches;

    function __construct(string $method, string $pattern)
    {
        $this->method = strtolower($method);
        $this->pattern = "#$pattern#";
    }

    function match(string $method, string $path): bool
    {
        $matches = [];
        $match = $this->method === $method
            && @preg_match($this->pattern, $path, $matches);
        
        $this->matches = $matches;

        return $match;
    }
}