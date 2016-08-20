<?php

	namespace App;
	use PDO;

	class Model{
		private $tableName;
		private $dbName;
		private static $connection;
		private $dbHost;
		private $dbPass;
		private $dbUser;
		private $lastSql;
		private $data;

		public function __construct($tableName){
			$this->tableName = $tableName;
			if(!isset($this->dbHost))
				$this->dbHost = '127.0.0.1';
			if(!isset($this->dbName))
				$this->dbName = "test";
			if(!isset($this->dbUser))
				$this->dbUser = "root";
			if(!isset($this->dbPass))
				$this->dbPass = "root";
			if(is_resource(self::$connection))
			{
				return self::$connection;
			}
			else{
				$dsn = 'mysql:dbname='.$this->dbName.';host='.$this->dbHost;
				echo $dsn;
				try{
				    self::$connection = new PDO($dsn, $this->dbUser, $this->dbPass);
				    return self::$connection;
				} catch (PDOException $e) {
				    dd('Connection failed: ' . $e->getMessage());
				}
			}
				
		}

		public function getAll()
		{
			$sth = self::$connection->prepare("SELECT * FROM ".$this->tableName);
			$sth->execute();

			$this->lastSql = "SELECT * FROM ".$this->tableName;
			return($sth->fetchAll());
		}

		public function findByOpenid($openid)
		{
			

			$sql = 'SELECT * FROM '.$this->tableName.' WHERE openid = :openid';
			$sth = self::$connection->prepare($sql);
			$where = array("openid" => $openid );
			$sth->execute($where);
			$this->lastSql = "SELECT * FROM ".$this->tableName;
			return($sth->fetchAll());
		}

		public function data($data)
		{
			$this->data = $data;
			return $this;
		}

		public function add()
		{
			$fields = "" ;
			$values = "" ;
			foreach ($this->data as $key => $value)
			{
				$fields .= '`'.$key . '`' . ",";	
				$values .= "'".$value . "',";
			}
			$fields = rtrim($fields , ",");
			$values = rtrim($values , ",");
			$sql = "INSERT INTO `".$this->tableName."`(".$fields.") VALUES (".$values.")";
			
			// dd($sql);
			$count = self::$connection->exec($sql);
			
			$this->lastSql = $sql;
			return $count;
		}

	}