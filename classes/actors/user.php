<?php

namespace classes\actors;

class User
{
    public $id;
    public $fio;
    public $order;

    function __construct($id, $fio, $order)
	{
		$this->id = $id;
		$this->fio = $fio;
		$this->order = $order;
	}
}