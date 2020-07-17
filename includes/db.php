<?php

class db extends PDO {

	public function __construct()
	{
		try{

			parent::__construct('mysql:host=localhost;dbname=dbzemog','root','');
			parent::exec("set names utf8");

		}catch(PDOException $e){
			echo "Conection fail" . $e->getMessage();
			exit();
		}
	}

}