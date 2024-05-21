<?php

namespace Millenium\TestTask\Domain\Repository;

use Millenium\TestTask\Domain\RepositoryInterface;

interface UserOrderRepositoryInterface extends RepositoryInterface
{
    function findByUserID(int $user_id): array;
}