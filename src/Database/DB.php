<?php
namespace Illuminate\Database;

use Illuminate\Database\Managers\Contracts\DatabaseManager;


class DB
{
    protected DatabaseManager $manager;

    public function __construct(DatabaseManager $manager) {
        $this->manager = $manager;
    }

    public function connect()
    {
        return $this->manager->connect();
    }

    protected function create(array $data){
        return $this->manager->create($data);
    }

    public function query(string $query, $values = []){
        return $this->manager->query($query, $values = []);
    }
}