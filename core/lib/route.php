<?php
namespace core\lib;
use core\lib\conf;
class route
{
	public $ctrl;
	public $action;
	public function __construct()
	{
		/**
		 * xxx.com/index.php/index/index
		 * xxx.com/index/index
		 *
		 * 1.隐藏index.php  	//.ht
		 * 2.获取url参数部分
		 * 3.返回对应控制器和方法
		 */
		// dd($_SERVER);
		if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI']!='/'){
			$path 		= $_SERVER['REQUEST_URI'];
			//去除左右‘/’并且，以‘/’来分隔成数组
			$pathArr 	= explode('/',trim($path,'/'));
			//控制器名称
			if(isset($pathArr[0])){
				$this->ctrl = $pathArr[0];
			}
			unset($pathArr[0]);
			//方法名称
			if(isset($pathArr[1])){
				$this->action = $pathArr[1];
				unset($pathArr[1]);
			}else{
				$this->action = conf::get('ACTION','route');
			}

			//URl多余部分转换成GET
			//例：id/1/pid/2
			
			//重新索引key
			$pathArr = array_values($pathArr);
			$count = count($pathArr);
			$i = 0;
			while ( $i < $count) {
				//防止出现单数
				//例：id/1/pid/
				if(isset($pathArr[$i+1])){
					$GET[$pathArr[$i]] = $pathArr[$i+1];
				}
				$i += 2;
			}
		}else{
			//当域名后面没有任何值和URL，的时候默认为index控制器和index方法
			$this->ctrl = conf::get('CTRL','route');
			$this->action = conf::get('ACTION','route');
		}
	}
}