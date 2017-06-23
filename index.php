<?php
/**
 * 入口文件
 * 1.定义常量
 * 2.加载常量
 * 3.启动框架
 */

define('APP_DIR',realpath('./'));   //IMOOC
define('CORE',APP_DIR.'/core');
define('APP',APP_DIR.'/app');
define('MODULE','app');
define('DEBUG',true);

//引出composer类
include '/vendor/autoload.php';
if(DEBUG){
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
    ini_set('display_error','On');
}else{
    ini_set('display_error','Off');
}
//公用方法如dd,或者TP里面的D,U方法
include CORE.'/common/function.php';
//入口文件
include CORE.'/kernel.php';

//自动加载
//例子：会自动加载run()中的new指向的类
spl_autoload_register('\core\kernel::load');

\core\kernel::run();
