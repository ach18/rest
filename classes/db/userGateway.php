<?php

namespace classes\db;

use classes\actors\User;
use \PDO as PDO;

class UserGateway
{

    private $pdo;
    public $tableName = '`user`';

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    
    public function insert($obj) : bool
	{
        $stmt = $this->pdo->prepare("INSERT INTO `user` (fio) VALUES (:fio)");
        $params = [
            'fio' => $obj['fio'],
        ];
		return $stmt->execute($params);
    }
    
    public function getById($id)
	{
        $stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE id = :id");
        $params = [
            'id' => $id
        ];
        $stmt->execute($params);
        $data = $stmt->fetch();
        return isset($data['id']) ? $data : false;
    }

    public function getFioById($id)
	{
        $stmt = $this->pdo->prepare("SELECT fio FROM `user` WHERE id = :id");
        $params = [
            'id' => $id
        ];
        $stmt->execute($params);
        $data = $stmt->fetch();
        return isset($data['fio']) ? $data : false;
    }

    public function getAll()
	{
        $stmt = $this->pdo->prepare("SELECT * FROM `user`");
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }

    public function update($obj)
    {
        $stmt = $this->pdo->prepare("UPDATE `user` SET fio = :fio WHERE id = :id");
        $params = [
            'fio' => $obj['fio'],
            'id' => $obj['id']
        ];
        $stmt->execute($params);
        return $stmt;
    }

    public function deleteById($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM `user` WHERE id = :id");
        $params = [
            'id' => $id
        ];
        $stmt->execute($params);
        return $stmt;
    }

    public function getIdByFio($fio)
    {
        $stmt = $this->pdo->prepare("SELECT id FROM `user` WHERE fio = :fio");
        $params = [
            'fio' => $fio
        ];
        $stmt->execute($params);
        $data = $stmt->fetchAll();
        return array_pop($data);
    }
}