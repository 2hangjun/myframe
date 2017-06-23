<?php
namespace core\lib;
use core\lib\conf;
// class model extends \PDO
// {
// 	public function __construct(){
// 		$database = conf::all('database');
// 		try{
// 			parent::__construct($database['DSN'],$database['USERNAME'],$database['PASSWROD']);
// 		}catch(\PDOException $e){
// 			dd($e->getMessage());
// 		}
// 	}
// }

class model extends \medoo
{
	public function __construct(){
		$database = conf::all('database');
		parent::__construct($database);
	}
}