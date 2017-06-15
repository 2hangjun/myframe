
<!DOCTYPE html>
<html>
<head>
	<title>说好的幸福呢</title>
	<meta charset="utf-8">
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
		}
		body{
			min-width:1200px; 
		}
		div{
			/*float: left;*/
		}
		.div1{
			width: 150px;
			height: 40px;
			margin: 0 auto;
			font-size: 20px;
			color: red;
		}
		.submit{
			position: relative;
			left: 0px;
			top: -150px;
		}
		input::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    		color:    #909;
		}
		input:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
		   color:    #909;
		}
		input::-moz-placeholder { /* Mozilla Firefox 19+ */
		   color:    #909;
		}
		input:-ms-input-placeholder { /* Internet Explorer 10-11 */
		   color:    #909;
		}

		textarea::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    		color:    #909;
		}
		textarea:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
		   color:    #909;
		}
		textarea::-moz-placeholder { /* Mozilla Firefox 19+ */
		   color:    #909;
		}
		textarea:-ms-input-placeholder { /* Internet Explorer 10-11 */
		   color:    #909;
		}
		#cc{
			display: none;
			float: left;
			z-index: 11111;
			top:20px;
			left: 10px;
			position:relative;
		}
	</style>
</head>
<body>
<!-- <script type="text/javascript">
	
alert(window.location.pathname);

</script> -->
<?php
$a = '123123';
echo $b = md5($a,true);
echo "<hr>";
echo $c = crypt($a,'12');
echo "<hr>";
echo sha1($c);
$arr = array('0'=>'');
if(isset($arr)){
echo 123123123;
}
die;
class mycrypt {    
    
    public $pubkey;    
    public $privkey;    
    
    function __construct() {    
                $this->pubkey = file_get_contents('./a.txt');  
                $this->privkey = file_get_contents('./b.txt');   
    }    
    
    public function encrypt($data) {    
        if (openssl_public_encrypt($data, $encrypted, $this->pubkey))    
            $data = base64_encode($encrypted);    
        else  
            throw new Exception('Unable to encrypt data. Perhaps it is bigger than the key size?');    
    
        return $data;    
    }  
    public function decrypt($data) {    
        if (openssl_private_decrypt(base64_decode($data), $decrypted, $this->privkey))    
            $data = $decrypted;  
        else  
            $data = '';  
        return $data;  
    }  
}  
$rsa = new mycrypt();    
// echo $a = $rsa -> encrypt('12345678');  
// echo '<hr/>';  
// echo $rsa -> decrypt($a);   
//-------------------------------------------------------------------------
//
class Rsa  
{  
    /** 
     * private key 
     */  
        private $_privKey;  
  
        /** 
         * public key 
         */  
        private $_pubKey;  
  
        /** 
         * the keys saving path 
         */  
        private $_keyPath;  
  
        /** 
         * the construtor,the param $path is the keys saving path 
         */   
        public function __construct($path)  
        {  
                if(empty($path) || !is_dir($path)){  
                        throw new Exception('Must set the keys save path');  
                }  
  
                $this->_keyPath = $path;  
        }  
  
        /** 
         * create the key pair,save the key to $this->_keyPath 
         */  
        public function createKey()  
        {  
                $r = openssl_pkey_new();  
                openssl_pkey_export($r, $privKey);  
                file_put_contents($this->_keyPath . DIRECTORY_SEPARATOR . 'priv.key', $privKey);  
                $this->_privKey = openssl_pkey_get_public($privKey);  
  
                $rp = openssl_pkey_get_details($r);  
                $pubKey = $rp['key'];  
                file_put_contents($this->_keyPath . DIRECTORY_SEPARATOR .  'pub.key', $pubKey);  
                $this->_pubKey = openssl_pkey_get_public($pubKey);  
        }  
  
        /** 
         * setup the private key 
         */  
        public function setupPrivKey()  
        {  
                if(is_resource($this->_privKey)){  
                        return true;  
                }  
                $file = $this->_keyPath . DIRECTORY_SEPARATOR . 'private.key';  
                $prk = file_get_contents($file);  
                $this->_privKey = openssl_pkey_get_private($prk);  
                return true;  
        }  
  
        /** 
         * setup the public key 
         */  
        public function setupPubKey()  
        {  
                if(is_resource($this->_pubKey)){  
                        return true;  
                }  
                $file = $this->_keyPath . DIRECTORY_SEPARATOR .  'public.key';  
                $puk = file_get_contents($file);  
                $this->_pubKey = openssl_pkey_get_public($puk);  
                return true;  
        }  
  
        /** 
         * encrypt with the private key 
         */  
        public function privEncrypt($data)  
        {  
                if(!is_string($data)){  
                        return null;  
                }  
  
                $this->setupPrivKey();  
  
                $r = openssl_private_encrypt($data, $encrypted, $this->_privKey);  
                if($r){  
                        return base64_encode($encrypted);  
                }  
                return null;  
        }  
  
        /** 
         * decrypt with the private key 
         */  
        public function privDecrypt($encrypted)  
        {  
                if(!is_string($encrypted)){  
                        return null;  
                }  
  
                $this->setupPrivKey();  
  
                $encrypted = base64_decode($encrypted);  
  
                $r = openssl_private_decrypt($encrypted, $decrypted, $this->_privKey);  
                if($r){  
                        return $decrypted;  
                }  
                return null;  
        }  
  
        /** 
         * encrypt with public key 
         */  
        public function pubEncrypt($data)  
        {  
                if(!is_string($data)){  
                        return null;  
                }  
  
                $this->setupPubKey();  
  
                $r = openssl_public_encrypt($data, $encrypted, $this->_pubKey);  
                if($r){  
                        return base64_encode($encrypted);  
                }  
                return null;  
        }  
  
        /** 
         * decrypt with the public key 
         */  
        public function pubDecrypt($crypted)  
        {  
                if(!is_string($crypted)){  
                        return null;  
                }  
  
                $this->setupPubKey();  
  
                $crypted = base64_decode($crypted);  
  
                $r = openssl_public_decrypt($crypted, $decrypted, $this->_pubKey);  
                if($r){  
                        return $decrypted;  
                }  
                return null;  
        }  
  
        public function __destruct()  
        {  
                @ fclose($this->_privKey);  
                @ fclose($this->_pubKey);  
        }  
  
}  
  
//以下是一个简单的测试demo，如果不需要请删除  
$rsa = new Rsa('./');  
  
//私钥加密，公钥解密  
echo '中华人民共和国<br />';  
$pre = $rsa->privEncrypt('中华人民共和国');  
echo 'private encrypted:<br />' . $pre . '<br />';  
  
$pud = $rsa->pubDecrypt($pre);  
echo 'public decrypted:' . $pud . '<br />';  
  
//公钥加密，私钥解密  
echo 'source:我是写PHP代码的<br />';  
$pue = $rsa->pubEncrypt('我是写PHP代码的');  
echo 'public encrypt:<br />' . $pue . '<br />';  
  
$prd = $rsa->privDecrypt($pue);  
echo 'private decrypt:' . $prd; 

die;
?>
<div style="width:800px;height:auto;margin:0 auto;">
	<div style="float: left;">
	<form method="get" action="tttt.php?xx=eeee">
		<textarea placeholder=">z>****<j<" rows="20" cols="50" name='data'></textarea>
		<input class="submit" type="submit" value="exec">
		<!-- <input type="text" placeholder="222222222"> -->
	</form>
	</div>
	<div style="padding:2px;float: left;"></div>
	<div style="float: left;"> 
	<textarea rows="20" cols="50" readOnly>
<?php
if($_POST && !empty($_POST['data'])){
	if(strpos($_POST['data'], ">z>") === 0 && $eval = substr($_POST['data'], 5, -strlen("<j<"))){
		echo eval($eval);
	}else{
		$res = explode("\n",$_POST['data']);
		foreach ($res as $row) {
			rtrim(';',$row);
			echo eval($row.';')."\n";
		}
	}
var_dump($_GET);
}
?>
	</textarea>
	</div>
<div>
</body>
</html>

<?php
// $aa = array(
// 	array(1),
// 	array(2),
// 	array(3),
// 	array(4),
// 	);
// echo count($aa);die;
/*$a=array(
	array('a'=>1),
	array('a'=>2),
	array('a'=>3),
	);
$b = array();
foreach ($a as $key => $value) {
	$b[] = $value['a'];
}


$d=4;
$c = 2;
// if(($d=4 && $c!=2) || ($d=4 && $c!=4)){
if($c!=2 && $c!=3){
echo 123;
}else{
echo 234;
}

$a = './a.txt';
$b = './b.txt';
if(copy($a, $b)){
echo 'b';
}else{
echo 'a';
}

function dd(){
	echo "<pre>";
	array_map(function($x){print_r($x);}, func_get_args());
	die;
}

dd($a=array(
	array('a'=>1),
	array('a'=>2),
	array('a'=>3),
	));
*/

// $a = array('0'=>array('a'=>1));
// if(!$a) return false;
// print_r($a);
// echo "<pre>";
// one();
// function one(){
// 	two();
// }

// function two(){
// 	three();
// }

// function three(){
// 	// var_dump(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS ),1);
// 	var_export(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
// 	// var_dump(debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS ),1);
// }
// 
// 





//php7.0测试
//
//-----------1.0-----------
// list($a[],$a[],$a[]) = array(1,2,3);

// foreach ($a as $key => $value) {
// 	echo $value;		//php5.6以前：输出321；//php7.0输出123
// }
// 
//-----------2.0-----------
//
// function xrange($start,$limit,$step = 1){
// 	    if ($start < $limit) {
//         if ($step <= 0) {
//             throw new LogicException('Step must be +ve');
//         }

//         for ($i = $start; $i <= $limit; $i += $step) {
//             yield $i;
//         }
//     } else {
//         if ($step >= 0) {
//             throw new LogicException('Step must be -ve');
//         }

//         for ($i = $start; $i >= $limit; $i += $step) {
//             yield $i;
//         }
//     }
// }
// echo 'Single digit odd numbers from range():  ';
// foreach (range(1, 9, 1) as $number) {
//     echo "$number ";
// }
// echo "\n";

// echo 'Single digit odd numbers from xrange(): ';
// foreach (xrange(1, 9, 1) as $number) {
//     echo "$number ";
// }


/*

Abstract test.
<?php

$start_time=microtime(true);
$array = array();
$result = '';
for($count=1000000; $count--;)
{
  $array[]=$count/2;
}
foreach($array as $val)
{
  $val += 145.56;
  $result .= $val;
}
$end_time=microtime(true);

echo "time: ", bcsub($end_time, $start_time, 4), "\n";
echo "memory (byte): ", memory_get_peak_usage(true), "\n";

?>

<?php

$start_time=microtime(true);
$result = '';
function it()
{
  for($count=1000000; $count--;)
  {
    yield $count/2;
  }
}
foreach(it() as $val)
{
  $val += 145.56;
  $result .= $val;
}
$end_time=microtime(true);

echo "time: ", bcsub($end_time, $start_time, 4), "\n";	//高精度 lifet-Right保留4位
echo "memory (byte): ", memory_get_peak_usage(true), "\n";	//返回分配给你的 PHP 脚本的内存峰值字节数

?>
Result:
----------------------------------
           |  time  | memory, mb |
----------------------------------
| not gen  | 2.1216 | 89.25      |
|---------------------------------
| with gen | 6.1963 | 8.75       |
|---------------------------------
| diff     | < 192% | > 90%      |
----------------------------------


 */

// trait Hello{
// 	public function say(){
// 		echo "say";
// 	}

// 	public function baybay(){
// 		echo "baybay";
// 	}
// }

// class test{
// 	use Hello;
// 	public function testa(){
// 		$this->say();
// 	}
// 	// use Hello;

// }

// $test = new test();
// $test->testa();
// $test->baybay();
// error_log(print_r($orders,1).date('Y-m-d H:i:s').PHP_EOL,3,'/tmp/autotakedelivery.log');
//闭包
//
// class Foo{
// 	private $a = 'aaa';
// 	public function foo(){
// 		echo "foo";
// 	}
// }

// $col = function (){
// 	$this->a = 'xxx';
// 	echo $this->a;
// }
// $col = $col->bindTo($foo,'foo');

$func = function( $param ) {
    echo $param;
};
$func( 'some string' );

//-----------------------------
class Article{
    private $title = "This is an article";
}

class Post{
    private $title = "This is a post";
}

class Template{

    function render($context, $tpl){

        $closure = function($tpl){
            ob_start();
            include $tpl;
            return ob_end_flush();
        };

        $closure = $closure->bindTo($context, $context);
        $closure($tpl);

    }

}

$art = new Article();
$post = new Post();
$template = new Template();

$template->render($art, 'tpl.php');
$template->render($post, 'tpl.php');


