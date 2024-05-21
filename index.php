<?php

namespace Millenium\TestTask;

require __DIR__ . "/vendor/autoload.php";

use Millenium\TestTask\App;

echo App::create([
    "root_dir" => __DIR__,
    "storage" => [
        "mysql" => [
            "authority" => [
                "database" => "test",
                "user" => "root",
                "password" => "31415",
                "host" => "localhost"
            ],
            "scheme" => [
                "products" => [
                    "id" => "int",
                    "title" => "string",
                    "price" => "float"
                ],
                "user" => [
                    "id" => "int",
                    "firts_name" => "string",
                    "second_name" => "string",
                    "birthday" => "\\DateTime",
                    "created_at" => "\\DateTime"
                ],
                "user_order" => [
                    "user_id" => "int",
                    "product_id" => "int",
                    "created_at" => "\\DateTime"
                ]
            ]
        ]
    ]
])
->withRoutes([
    ['get', '^\/*$'],
    ['get', '^\/users\/*$'],
    ['get', '^\/user\/(\d+)\/orders\/*$'],
    ['get', '^\/products\/*$'],
    ['post', '^\/products\/add\/*$'],
])
->createController()
->getResponse()
->getBody();

//exit(0);
