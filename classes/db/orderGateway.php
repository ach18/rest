<?php

namespace classes\db;

use classes\actors\Order;
use \PDO as PDO;

class OrderGateway
{

    private $pdo;
    public $tableName = 'order';

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    
    public function insert(Order $obj) : bool
	{
        $stmt = $this->pdo->prepare("INSERT INTO $tableName (summ, user_id) VALUES(:summ, :user_id)");
        $params = [
            'summ' => $obj->summ,
            'user_id' => $obj->userId
        ];
		return $stmt->execute($params);
	}
	
	public function getById($id)
	{
        $stmt = $this->pdo->prepare("SELECT * FROM $tableName WHERE id = :id");
        $params = [
            'id' => $id
        ];
        $stmt->execute($params);
        $data = $stmt->fetch();
        return isset($data['id']) ? $data : false;
    }

    public function getAll()
	{
        $stmt = $this->pdo->prepare("SELECT * FROM $tableName");
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }
}