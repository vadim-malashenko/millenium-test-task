<?php

namespace Millenium\TestTask\Domain\Controller;

use Millenium\TestTask\Data\Repository\UserRepository;
use Millenium\TestTask\Http\JsonResponse;

class UsersController extends AbstractController
{
    function index(): JsonResponse
    {
        $userRepository = new UserRepository($this->config["storage"]["mysql"]);
        $users = $userRepository->findAll();
        
        return new JsonResponse($users);
    }
}