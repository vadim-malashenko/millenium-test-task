<?php

namespace Millenium\TestTask\Domain\Controller;

use Millenium\TestTask\App;
use Millenium\TestTask\Domain\Controller\ControllerInterface;
use Millenium\TestTask\Http\Request;
use Millenium\TestTask\Http\Response;
use Millenium\TestTask\Http\Route;

abstract class AbstractController implements ControllerInterface
{
    protected array $config;
    protected string $action = "index";

    function __construct(
        protected Request $request,
        protected Route $route
    )
    {
        $this->config = App::getInstance()->config;
    }

    function withAction(string $action): static
    {
        $this->action = $action;

        return $this;
    }

    function getResponse(array $params = []): Response
    {
        return $this->{$this->action}();
    }
}