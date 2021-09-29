<?php
namespace Illuminate\Database\Managers\Contracts;

interface DatabaseManager
{
    public function connect(): \PDO;

    public function query(string $query, $values = []);

    public function create(array $data);

    public function read($columns='*', $filter = null);

    public function update($id, $data);

    public function delete($id);
}
