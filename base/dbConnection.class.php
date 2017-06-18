<?php
	class dbConnection{
		protected $db_conn;
		private $db_host = DB_HOST;
		private $db_username = DB_USERNAME;
		private $db_password = DB_PASSWORD;
		private $db_name = DB_NAME;

		public function connect(){
			try {
				$this->db_conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name","$this->db_username","$this->db_password");
				//$this->db_Conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				return $this->db_conn;
			}catch(PDOException $ex) {
				return $ex->getMessage();
			}
		}
	}
?>