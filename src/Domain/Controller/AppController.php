<?php

namespace Millenium\TestTask\Domain\Controller;

use Millenium\TestTask\Http\Response;

class AppController extends AbstractController
{
    function index(): Response
    {
        return new Response(
            file_get_contents(
                $this->config["root_dir"]
                . "/assets/templates/app.html"
            )
        );
    }
}