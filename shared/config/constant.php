<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| 后台  环境常量
|--------------------------------------------------------------------------
|
| 本文件由应用程序入口文件调用
|
*/    
    define('DX_SHARE_PATH', BASEPATH . '../shared/'); //:/wamp/www/DANDX/system/
    define("DX_HISTORY",    isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:null);
    define('NOW',           $_SERVER['REQUEST_TIME']);
    define('REQUEST_METHOD',$_SERVER['REQUEST_METHOD']);
    define('IS_GET',        REQUEST_METHOD == 'GET' ? true : false);
    define('IS_POST',       REQUEST_METHOD == 'POST' ? true : false);
    define('PER_PAGE',      14);

/* End of file constant.php */
/* Location: ./shared/config/constant.php */