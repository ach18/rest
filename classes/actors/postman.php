<?php

namespace classes\actors;

class Postman
{
    public $id;
    public $fio;
    public $orderId;

    function __construct($id, $fio, $orderId)
	{
		$this->id = $id;
		$this->fio = $fio;
		$this->orderId = $orderId;
	}
}