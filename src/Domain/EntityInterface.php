<?php

namespace Millenium\TestTask\Domain;

interface EntityInterface
{
    function getID(): ?int;
    function toArray(): array;
    static function fromArray(array $data): static;
}