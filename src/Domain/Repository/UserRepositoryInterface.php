<?php

namespace Millenium\TestTask\Domain\Repository;

use Millenium\TestTask\Domain\Entity\UserEntity;
use Millenium\TestTask\Domain\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    function find(int $id): ?UserEntity;
}