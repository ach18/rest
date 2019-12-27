<?php

namespace classes\db;

use \PDO as PDO;
use classes\actors\Order;

class OrderGateway
{

    private $pdo;
    public $tableName = '`order`';

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    
    public function insert($obj) : bool
	{
        $stmt = $this->pdo->prepare("INSERT INTO `order` (summ, userId) VALUES(:summ, :userId)");
        $params = [
            'summ' => $obj['summ'],
            'userId' => $obj['userId']
        ];
		return $stmt->execute($params);
    }
    
    public function getById($id)
	{
        $stmt = $this->pdo->prepare("SELECT * FROM `order` WHERE id = :id");
        $params = [
            'id' => $id
        ];
        $stmt->execute($params);
        $data = $stmt->fetch();
        return isset($data['id']) ? $data : false;
    }

    public function getByUserId($userId)
	{
        $stmt = $this->pdo->prepare("SELECT * FROM `order` WHERE userId = :userId");
        $params = [
            'userId' => $userId
        ];
        $stmt->execute($params);
        $data = $stmt->fetchAll();
        return $data;
    }

    public function getAll()
	{
        $stmt = $this->pdo->prepare("SELECT * FROM `order`");
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }

    public function update($obj)
    {
        $stmt = $this->pdo->prepare("UPDATE `order` SET summ = :summ, userId = :userId WHERE id = :id");
        $params = [
            'summ' => $obj['summ'],
            'userId' => $obj['userId'],
            'id' => $obj['id']
        ];
        $stmt->execute($params);
        return $stmt;
    }

    public function deleteById($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM `order` WHERE id = :id");
        $params = [
            'id' => $id
        ];
        $stmt->execute($params);
        return $stmt;
    }
}