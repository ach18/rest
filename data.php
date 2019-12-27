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
$userGate = new UserGateway($pdo);
$orderGate = new OrderGateway($pdo);

$method = $_SERVER['REQUEST_METHOD'];
if(($method == "POST") || ($method == "PUT"))
	$formData = file_get_contents('php://input');
//$request = $_SERVER['PATH_INFO'];
$request = (isset($_GET['q'])) ? $_GET['q'] : '';

if($method == "GET" && preg_match("/user\/\d+\/order/i", $request))
{
	$tokens = explode("/", $request);
	$id = $tokens[1];
	$fio = $userGate->getFioById($id);
	if($fio == '')
	{
		header('HTTP/1.1 400 Bad Request', true, 400);
		exit('Bad Request');
	} else
	{
		$orders = $orderGate->getByUserId($id);
		$orders;
		echo json_encode($orders, JSON_UNESCAPED_UNICODE);
	}
} else if(preg_match("/user\/\d+/i", $request))
{
	$tokens = explode("/", $request);
	$id = $tokens[1];
	if($method == "GET") 
	{
		$json = $userGate->getById($id);
		echo json_encode($json, JSON_UNESCAPED_UNICODE);
	} else if($method == "PUT") 
	{
		$a = explode('&', $formData);
		$dat = [];
		foreach($a as $item)
		{
			$t = explode('=',$item);
			$dat[$t[0]] = urldecode($t[1]);
		}
		$result = $userGate->update($dat);
		if($result)
		{
			header('HTTP/1.1 200 OK', true, 200);
			exit('Success');
		} else
		{
			header('HTTP/1.1 400 Bad Request', true, 400);
			exit('Bad Request');
		}
	} else if($method == "DELETE")
	{
		$result = $userGate->deleteById($id);
		if($result)
		{
			header('HTTP/1.1 200 OK', true, 200);
			exit('Success');
		} else
		{
			header('HTTP/1.1 400 Bad Request', true, 400);
			exit('Bad Request');
		}
	} else 
	{
		header('HTTP/1.1 400 Bad Request', true, 400);
		exit('Bad Request');
	}
} else if($method == "POST" && preg_match("/user/i", $request))
{
	$a = explode('&', $formData);
		$dat = [];
		foreach($a as $item)
		{
			$t = explode('=',$item);
			$dat[$t[0]] = urldecode($t[1]);
		}
		
		$result = $userGate->insert($dat);
		if($result)
		{
			$id = $userGate->getIdByFio($dat['fio']);
			echo $id['id'];
		} else
		{
			header('HTTP/1.1 400 Bad Request', true, 400);
			exit('Bad Request');
		}
} else if(preg_match("/order\/\d+/i", $request))
{
	$tokens = explode("/", $request);
	$id = $tokens[1];
	if($method == "GET") 
	{
		$json = $orderGate->getById($id);
		echo json_encode($json, JSON_UNESCAPED_UNICODE);
	} else if($method == "PUT") 
	{
		$a = explode('&', $formData);
		$dat = [];
		foreach($a as $item)
		{
			$t = explode('=',$item);
			$dat[$t[0]] = urldecode($t[1]);
		}
		$result = $orderGate->update($dat);
		if($result)
		{
			header('HTTP/1.1 200 OK', true, 200);
			exit('Success');
		} else
		{
			header('HTTP/1.1 400 Bad Request', true, 400);
			exit('Bad Request');
		}
	} else if($method == "DELETE")
	{
		$result = $orderGate->deleteById($id);
		if($result)
		{
			header('HTTP/1.1 200 OK', true, 200);
			exit('Success');
		} else
		{
			header('HTTP/1.1 400 Bad Request', true, 400);
			exit('Bad Request');
		}
	} else 
	{
		header('HTTP/1.1 400 Bad Request', true, 400);
		exit('Bad Request');
	}
} else if($method == "POST" && preg_match("/order/i", $request))
{
	$a = explode('&', $formData);
		$dat = [];
		foreach($a as $item)
		{
			$t = explode('=',$item);
			$dat[$t[0]] = urldecode($t[1]);
		}
		$result = $orderGate->insert($dat);
		if($result)
		{
			header('HTTP/1.1 200 OK', true, 200);
			exit('Success');
		} else
		{
			header('HTTP/1.1 400 Bad Request', true, 400);
			exit('Bad Request');
		}
} else
{
	header('HTTP/1.1 400 Bad Request', true, 400);
	exit('Bad Request');
}