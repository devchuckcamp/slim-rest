<?php

namespace Config\Database;

class Connection
{
	protected $host;
	protected $user;
	protected $pass;
	protected $dbname;
	protected $mysqli;

	public function __construct()
	{
		$this->host = "localhost";
		$this->user = "root";
		$this->pass = "";
		$this->dbname = "slim_demo";
		$this->mysqli = new mysqli($host, $user, $pass, $dbname);
	}
}
	
?>