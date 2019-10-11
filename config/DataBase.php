<?php

class Database{
	
	public static function connect() {
		$db = new mysqli("localhost","root","","sistema_bar");
		$db ->query("SET NAMES 'utf-8'");
		return $db;
	}
}