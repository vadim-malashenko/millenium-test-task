<?php

namespace Millenium\TestTask\Http;

use Millenium\TestTask\Http\Exception\{
    NotFoundException,
    NotImplementedException
};

final class Router
{
    private array $routes = [];

    function setRoutes(array $routes): void
    {
        foreach ($routes as $route)
        {
            $this->routes[] = new Route(...$route);
        }
    }

    function getRoute(string $method, string $path): Route
    {
        try
        {
            $method = Method::from($method);
        }
        catch (\ValueError $ex)
        {
            throw new NotImplementedException("method: {$method->name}");
        }

        foreach ($this->routes as $route)
        {
            if ($route->match($method->value, $path))
            {
                return $route;
            }
        }

        throw new NotFoundException("uri: {$method->name} {$path}");
    }

    function getRoutes(): array
    {
        return $this->routes;
    }
}