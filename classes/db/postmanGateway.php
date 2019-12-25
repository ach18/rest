<?php

namespace classes\db;

use \PDO as PDO;
use classes\actors\Postman;

class PostmanGateway
{

    private $pdo;
    public $tableName = 'postman';

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    
    public function insert(Postman $obj) : bool
	{
        $stmt = $this->pdo->prepare("INSERT INTO $tableName (fio, order_id) VALUES(:fio, :order_id)");
        $params = [
            'fio' => $obj->fio,
            'order_id' => $obj->orderId
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

    public function update($obj)
    {
        $stmt = $this->pdo->prepare("UPDATE $tableName SET fio = :fio, order_id = :order_id WHERE id = :id");
        $params = [
            'fio' => $obj->fio,
            'order_id' => $obj->order_id,
            'id' => $obj->id
        ];
        $stmt->execute($params);
        $result = $stmt->fetch();
        return $result;
    }

    public function deleteById($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM $tableName WHERE id = :id");
        $params = [
            'id' => $obj->id
        ];
        $stmt->execute($params);
        $result = $stmt->fetch();
        return $result;
    }
}