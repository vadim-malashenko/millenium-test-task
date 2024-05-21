<?php

namespace Millenium\TestTask\Domain\Controller;

use Millenium\TestTask\Data\Repository\ProductsRepository;
use Millenium\TestTask\Domain\Entity\ProductEntity;
use Millenium\TestTask\Http\JsonResponse;

class ProductsController extends AbstractController
{
    function index(): JsonResponse
    {
        $productsRepository = new ProductsRepository($this->config["storage"]["mysql"]);
        $products = $productsRepository->findAll();
        
        return new JsonResponse($products);
    }

    function add(): JsonResponse
    {
        $productsRepository = new ProductsRepository($this->config["storage"]["mysql"]);
        $product = $this->request->post;
        $productsRepository->add(ProductEntity::fromArray($product));
        
        return new JsonResponse(true);
    }
}