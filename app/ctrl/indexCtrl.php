<?php
namespace app\ctrl;

class indexCtrl
{
	
	function __construct()
	{
		echo 123;
	}

	function index(){
		echo 44444444;
		$model = new \core\lib\model();
	}
}