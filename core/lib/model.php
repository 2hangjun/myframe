<?php
namespace core\lib;
class model extends \PDO
{
	public function __construct(){
		$dsn = 'mysql:host:loaclhost;dbname=test';
		$username = 'root';
		$passwrod = 'root';
		try{
			parent::__construct($dsn,$username,$passwrod);
		}catch(\PDOException $e){
			dd($e->getMessage());
		}
	}
}