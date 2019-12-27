<?php

namespace classes\actors;

class User
{
    public $id;
    public $fio;

    function __construct($id, $fio)
	{
		$this->id = $id;
		$this->fio = $fio;
	}
}