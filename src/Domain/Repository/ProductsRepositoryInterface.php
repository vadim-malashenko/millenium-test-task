<?php

namespace Millenium\TestTask\Domain\Repository;

use Millenium\TestTask\Domain\Entity\ProductEntity;
use Millenium\TestTask\Domain\RepositoryInterface;

interface ProductsRepositoryInterface extends RepositoryInterface
{
    function find(int $id): ?ProductEntity;
    function add(ProductEntity $product): void;
}