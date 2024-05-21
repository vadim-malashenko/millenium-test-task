<?php

namespace Millenium\TestTask\Data\Storage;

interface StorageInterface
{
    function withScheme(array $scheme): static;
    function withTable(string $table): static;
    function insert(array $data): bool;
    function update(array $data): bool;
    function select(array $columns = []): static;
    function where(string $column, string $operator, $value): static;
    function all(): array;
    function one(): array;
}