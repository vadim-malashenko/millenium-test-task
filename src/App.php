<?php

namespace Millenium\TestTask;

use Millenium\TestTask\Domain\Controller\ControllerInterface;
use Millenium\TestTask\Http\Exception\NotFoundException;
use Millenium\TestTask\Http\Request;
use Millenium\TestTask\Http\Response;
use Millenium\TestTask\Http\Router;

final class App
{
    private static ?self $instance = null;

    public readonly array $config;
    private Router $router;

    private function __construct()
    {
        $this->router = new Router();
    }

    static function getInstance(): self
    {
        return self::$instance ?? (self::$instance = new self());
    }

    static function create(array $config): self
    {
        $app = self::getInstance();
        $app->config = $config;

        return $app;
    }

    function withRoutes (array $routes): self
    {
        $this->router->setRoutes($routes);

        return $this;
    }

    function createController(): ControllerInterface
    {
        $request = new Request();

        try
        {
            $route = $this->router->getRoute(
                $request->getMethod(), $request->getUri()->getPath()
            );

            $path = explode("/", trim($route->matches[0] ?? "", "/"));

            $controllerClassName = array_shift($path) ?? "";
            $controllerClassName =  ! empty($controllerClassName)
                ? $controllerClassName
                : "app";
            $controllerClassName = str_replace(
                "ControllerInterface",
                ucfirst(strtolower($controllerClassName)) . "Controller",
                ControllerInterface::class
            );

            if ( ! class_exists($controllerClassName))
            {
                throw new NotFoundException("controller: " . $controllerClassName);
            }

            $controller = new $controllerClassName($request, $route);

            while ( ! is_null($action = array_shift($path)))
            {
                if (method_exists($controller, $action))
                {
                    break;
                }

                $action = null;
            }

            $action ??= "index";

            return $controller->withAction($action);
        }
        catch (NotFoundException $ex)
        {
            $response = new Response($ex->getMessage(), 404);
            echo $response->getBody();
        }
    }
}
