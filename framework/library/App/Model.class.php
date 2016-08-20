<?php

	namespace App;
	use Illuminate\Database\Capsule\Manager as Capsule;
	class Model{

		private static $connection;

		private $lastSql;
		private $data;
		private $capsule;

		public function __construct($tableName){
				$this->capsule = new Capsule;
				$this->capsule->addConnection(getConfig("database"));
				$this->capsule->setAsGlobal();
				$this->tableName = $tableName;
		}
		public function getDb(){
			return $this->$capsule;
		}
		public function getAll()
		{
			return Capsule::select('select * from '.$this->tableName);
		}

		public function findByOpenid($openid)
		{
		

		}

		public function data($data)
		{
			$this->data = $data;
			return $this;
		}

		public function add()
		{

		}

	}