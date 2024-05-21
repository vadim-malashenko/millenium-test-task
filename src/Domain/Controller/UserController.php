<?php

namespace Millenium\TestTask\Domain\Controller;

use Millenium\TestTask\Data\Repository\UserOrderRepository;
use Millenium\TestTask\Http\JsonResponse;

class UserController extends AbstractController
{
    function orders(): JsonResponse
    {
        $userOrderRepository = new UserOrderRepository($this->config["storage"]["mysql"]);
        $userOrders = $userOrderRepository->findByUserID((int)$this->route->matches[1]);

        return new JsonResponse(
            array_map(
                fn ($userOrder) => $userOrder->toArray(),
                $userOrders
            )
        );
    }
}