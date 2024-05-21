<?php

namespace Millenium\TestTask\Domain\Controller;

use Millenium\TestTask\Http\Response;

interface ControllerInterface
{
    function withAction(string $action): static;
    function getResponse(array $params = []): Response;
}