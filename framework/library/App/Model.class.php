<?php

	namespace App;
	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Database\Eloquent\Model as Eloquent;
	class Model extends Eloquent{

		protected $table;
		protected $connection;
		protected $capsule;

		public function __construct($tableName){

			$this->capsule = new Capsule;
			$this->capsule->addConnection(getConfig("database"));
			$this->capsule->setAsGlobal();
			$this->capsule->setAsGlobal();

			// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
			$this->capsule->bootEloquent();

			$this->table = $tableName;
			//dd(getConfig("mysql"));
			parent::__construct(getConfig("mysql"));
		}
		

	}