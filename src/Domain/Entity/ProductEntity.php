<?php

namespace Millenium\TestTask\Domain\Entity;

use Millenium\TestTask\Domain\EntityInterface;

class ProductEntity implements EntityInterface
{
    private ?int $id = null;
    private ?string $title = null;
    private float $price;   

    function __construct(?int $id)
    {
        $this->id = $id;
    }

    function getID(): ?int
    {
        return $this->id;
    }

    function getTitle(): ?string
    {
        return $this->title;
    }

    function setTilte(?string $title): void
    {
        if ( ! is_null($title) && 255 < mb_strlen($title))
        {
            throw new \InvalidArgumentException("");
        }
        
        $this->title = $title;
    }

    function getPrice(): float
    {
        return $this->price;
    }

    function setPrice(float $price): void
    {
        $this->price = $price;
    }

    function toArray(): array
    {
        return [
            "id" => $this->getID(),
            "title" => $this->getTitle(),
            "price" => $this->getPrice()
        ];
    }

    static function santize(array $data): array
    {
        $keys = array_keys($data);
        $args = array_fill_keys(
            $keys,
            [
                "filter" => FILTER_CALLBACK,
                "options" => fn ($value) => trim(strip_tags($value))
            ]
        );

        return filter_var_array($data, $args);
    }

    static function fromArray(array $data): static
    {
        $data = static::santize($data);
        $product = new static($data["id"] ?? null);

        $product->setTilte($data["title"] ?? "");
        $product->setPrice($data["price"] ?? 0);

        return $product;
    }
}