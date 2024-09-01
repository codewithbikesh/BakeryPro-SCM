<?php

class sca_connect {
	private $_host = 'localhost';
	private $_username = 'root';
	private $_password = '';
	private $_database = 'fyp';

	protected $db;

	public function __construct()
	{
		if (!isset($this->db)) {
			$this->db = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
			mysqli_set_charset($this->db,"utf8");
			
			if (!$this->db) {
				echo 'Cannot connect to database server';
				exit;
			}
		}
		return $this->db;
	}

}
?>