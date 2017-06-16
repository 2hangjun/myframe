<?php
namespace core;

class kernel
{
	public static $classMap = array();

	static public function run()
	{
		$route 		= new \core\lib\route();
		$ctrlClass 	= $route->ctrl;
		$action 	= $route->action;
		$ctrlfile = APP.'/ctrl/'.$ctrlClass.'Ctrl.php';			//todo,这个地方要优化
		$ctrlClass = '\\'.MODULE.'\ctrl\\'.$ctrlClass.'Ctrl';	//todo,这个地方要优化
		if(is_file($ctrlfile)){
			include $ctrlfile;
			$ctrl = new $ctrlClass();
			$ctrl->$action();
		}else{
			throw new \Exception("找不到控制器".$ctrlClass);
		}
	}
	
	/**
	 * [load 自动加载]
	 * @param  [string] $class  例："core\lib\route"
	 * @return [bool]        
	 */
	static public function load($class)
	{
		//new \core\route()
		//$class = '\core\route';
		//APP_DIR.'/core/route.php'需要转换的结果
		if(isset(self::$classMap[$class]) && !empty(self::$classMap[$class])){
			return true;
		}else{
			$class = str_replace('\\','/',$class);
			$file = APP_DIR.'/'.$class.'.php';
			if(is_file($file)){
				include $file;
				self::$classMap[$class] = $class;
			}else{
				return false;
			}
		}
	}

}