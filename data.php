<?php

use classes\db\Db;
use classes\db\OrderGateway;
use classes\db\PostmanGateway;
use classes\db\UserGateway;
use classes\actors\Order;
use classes\actors\Postman;
use classes\actors\User;

$db = new Db('127.0.0.1','test','root','','utf8');
$pdo = $db->connect();

$method = $_SERVER['REQUEST_METHOD'];
if(($method == "POST") || ($method == "PUT"))
	$formData = file_get_contents('php://input');

//тут роутер
//https://myrusakov.ru/php-simlple-mvc-router.html
//https://qna.habr.com/q/311605

if($method == "user")
{
	$user = new UserGateway($urls, $_SERVER['REQUEST_METHOD']);
	//!!!!!
	$response = $user->
} else if($method == "order")
{	
	$response = new OrderGateway($urls, $_SERVER['REQUEST_METHOD']);
} else
{
	header('HTTP/1.1 400 Bad Request', true, 400);
	exit('Bad Request');
}
//$user = new UserGateway($pdo);
//$order = new OrderGateway($pdo);


