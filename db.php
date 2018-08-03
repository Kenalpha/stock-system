<?php

class Database
{
	public $con;
	public function __construct(){
		$this->con = mysqli_connect("localhost", "root", "", "alpha_computers");
	}
}

$obj = new Database;

?>