<?php

namespace Millenium\TestTask\Data\Storage;

class MySqlStorage implements StorageInterface
{
    private \PDO $db;
    public readonly array $scheme;
    protected string $table = "";
    private $sql = "";

    function __construct(string $dsn, string $user, string $password, ?array $options = null)
    {
        $this->db = new \PDO($dsn, $user, $password, $options);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    function withScheme(array $scheme): static
    {
        $this->scheme = $scheme;

        return $this;
    }

    function withTable(string $table): static
    {
        $this->table = $table;

        return $this;
    }

    function insert(array $data): bool
    {
        $columns = array_keys($this->scheme[$this->table]);

        $values = trim(str_repeat("?,", count($columns)), ",");
        $columns = implode(",", $columns);

        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";

        $statement = $this->db->prepare($query);
        
        return $statement->execute(array_values($data));
    }

    function update(array $data): bool
    {
        $columns = array_keys($this->scheme[$this->table]);

        $set = array_map(
            fn ($column) => "SET {$column} = :{$column}",
            array_slice($columns, 1)
        );
        $where = "id = :id";
        $set = implode(",", $set);

        $query = "UPDATE {$this->table} {$set} {$where}";

        $statement = $this->db->prepare($query);
        
        return $statement->execute($data);
    }

    function select(array $columns = []) : static
    {
        $columns = (count($columns) > 0)
            ? implode (",", $columns)
            : "*";

        $this->sql = "SELECT $columns FROM $this->table";

        return $this;
    }

    function leftJoin(string $table, $a, $o, $b): static
    {
        $this->sql .= " LEFT JOIN {$table} ON ({$a} {$o} {$b})";

        return $this;
    }

    function where(string $column, string $operator, $value): static
    {
        if (is_string($value))
        {
            $value = "'$value'";
        }

        $this->sql .= " WHERE {$column} {$operator} {$value}";

        return $this;
    }

    function orderBy(string $column, string $order = null): static
    {
        $order = $order ?? 'DESC';

        $this->sql .= " ORDER BY {$column} {$order}";

        return $this;
    }

    function limit (string $limit): static
    {
        $this->sql .= " LIMIT {$limit}";

        return $this;
    }

    function all(): array
    {
        $results =  $this->db
            ->query($this->sql)
            ->fetchAll(\PDO::FETCH_ASSOC);
        
        return $results ?: [];
    }

    function one(): array
    {
        $result = $this->db
            ->query($this->sql)
            ->fetch(\PDO::FETCH_ASSOC);

        return $result ?: [];
    }

    function exec ($sql) {

        $this->db->exec ($sql);
    }
}