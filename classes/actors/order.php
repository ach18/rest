<?php

namespace classes\actors;

class Order
{
    public $id;
    public $summ;
    public $userId;

    function __construct($id, $summ, $userId)
	{
		$this->id = $id;
		$this->summ = $summ;
		$this->userId = $userId;
	}
}