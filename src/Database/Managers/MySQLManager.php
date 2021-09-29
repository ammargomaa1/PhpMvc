<?php
namespace Illuminate\Database\Managers;

use App\Models\User;
use Illuminate\Database\Managers\Contracts\DatabaseManager;

class MySQLManager implements DatabaseManager
{
    protected static $instance;
    public function connect(): \PDO
    {
        
        if (!self::$instance) {
            
                self::$instance = new \PDO(env('DB_DRIVER').':host='.env('DATABASE_HOST').';dbname='.env('DATABASE_NAME'),env('DATABASE_USERNAME'),env('DB_PASSWORD'));
            
            
        }

        return self::$instance;
    }

    public function query(string $query, $values = [])
    {
        
        

        $stmt = self::$instance->prepare($query);

        for ($i=1; $i <= count($values); $i++) { 
            $stmt->bindValue($i,$values[$i-1]);
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, User::class)[0];
    }

    public function read($columns = '*',$filter = null)
    {
        # code...
    }

    public function delete($id)
    {
        # code...
    }

    public function update($id,$attributes)
    {
        # code...
    }

    public function create($data)
    {
        # code...
    }
}