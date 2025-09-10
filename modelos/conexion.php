<?php

class Conexion{

	static public function conectar(){

		$host = "localhost";
		$database = "charly";
		$user	= "root";
		$passwd	= "";

		$conexion = new PDO('mysql:host='.$host.';dbname='.$database, $user, $passwd, array(
				PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

		$conexion->exec("set names utf8");

		return $conexion;

	}

}