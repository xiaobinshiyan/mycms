<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author xiaobin zxbin.1990@gmail.com
 */
// ------------------------------------------------------------------------

/**
 * 读取配置数据
 *
 * @access	public
 * @param	string	
 * @return	mixed
 */
if ( ! function_exists('setting'))
{
	function setting($key)
	{
		$ci = &get_instance();
		return 	$ci->settings->item($key);
	}
}

// ------------------------------------------------------------------------

/**
 * 更新缓存
 *
 * @access	public
 * @param	array
 * @param	string
 * @return	void
 */
if ( ! function_exists('update_cache'))
{
	function update_cache($array, $fix = '')
	{
		$ci = &get_instance();
		$ci->load->model('cache_model');
		$array = is_array($array) ? $array : array($array);
		foreach ($array as $v)
		{
			$method = 'update_' . $v . '_cache';
			$ci->cache_model->$method($fix);
		}
	}
}

// ------------------------------------------------------------------------

/**
 * 将array转换成缓存字符
 *
 * @access	public
 * @param	string
 * @param	array
 * @return	void
 */
if ( ! function_exists('array_to_cache'))
{
	function array_to_cache($name, $array)
	{
		return '<?php if ( ! defined(\'BASEPATH\')) exit(\'No direct script access allowed\');' . PHP_EOL . 
			   '$' . $name . '[\''.$name.'\']=' . var_export($array, TRUE) . ';'; 
	}
}

// ------------------------------------------------------------------------

// ------------------------------------------------------------------------
/**
 * 打印函数
 *@param void $data
 *@return void
 */
if ( ! function_exists('p'))
{
	function p($data)
	{
		echo "<pre>";
		print_r($data);
		echo "</pre>";exit();
	}
}
/**
 * 字符串转换为数组，主要用于把分隔符调整到第二个参数
 *
 * @param string $str
 *        	要分割的字符串
 * @param string $glue
 *        	分割符
 * @return array
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
if ( ! function_exists('str2arr'))
{
	function str2arr($str, $glue = ',') {
		return explode ( $glue, $str );
	}
}
/**
 * 数组转换为字符串，主要用于把分隔符调整到第二个参数
 *
 * @param array $arr
 *        	要连接的数组
 * @param string $glue
 *        	分割符
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
if ( ! function_exists('arr2str'))
{
	function arr2str($arr, $glue = ',') {
		return implode ( $glue, $arr );
	}
}
/**
 * 字符串截取，支持中文和其他编码
 *
 * @static
 *
 *
 * @access public
 * @param string $str
 *        	需要转换的字符串
 * @param string $start
 *        	开始位置
 * @param string $length
 *        	截取长度
 * @param string $charset
 *        	编码格式
 * @param string $suffix
 *        	截断显示字符
 * @return string
 */
if ( ! function_exists('msubstr'))
{
	function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {
		if (function_exists ( "mb_substr" ))
			$slice = mb_substr ( $str, $start, $length, $charset );
		elseif (function_exists ( 'iconv_substr' )) {
			$slice = iconv_substr ( $str, $start, $length, $charset );
			if (false === $slice) {
				$slice = '';
			}
		} else {
			$re ['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
			$re ['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
			$re ['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
			$re ['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
			preg_match_all ( $re [$charset], $str, $match );
			$slice = join ( "", array_slice ( $match [0], $start, $length ) );
		}
		return $suffix ? $slice . '...' : $slice;
	}
}
/**
 * 后台URI生成函数
 *
 * @access	public
 * @param	string
 * @param	string
 * @return	string
 */

if ( ! function_exists('backend_url'))
{
	function backend_url($uri = '', $qs = '')
	{
		return site_url($uri) . ($qs == '' ? '' : '?' . $qs);
	}
}
 

    /**
     * 返回多层栏目
     * @param $data 操作的数组
     * @param int $pid 一级PID的值
     * @param string $html 栏目名称前缀
     * @param string $fieldPri 唯一键名，如果是表则是表的主键
     * @param string $fieldPid 父ID键名
     * @param int $level 不需要传参数（执行时调用）
     * @return array
     */
if ( ! function_exists('channelLevel'))
{
    function channelLevel($data, $pid = 0, $html = "&nbsp;", $fieldPri = 'cid', $fieldPid = 'pid', $level = 1)
    {
        if (!$data) {
            return array();
        }
        $arr = array();
        foreach ($data as $v) {
            if ($v[$fieldPid] == $pid) {
                $arr[$v[$fieldPri]] = $v;
                $arr[$v[$fieldPri]]['html'] = str_repeat($html, $level - 1);
                $arr[$v[$fieldPri]]["data"] = channelLevel($data, $v[$fieldPri], $html, $fieldPri, $fieldPid, $level + 1);
            }
        }
        return $arr;
    }
}
if ( ! function_exists('limitless'))
{
	function limitless($data,$pid=0,$level = 1)
	{
	  $arr = array();
	  foreach ($data as $v) 
	  { 
	    if($v['pid'] == $pid)
	    {
	      if($v['pid'] != 0)
	      {
	        $v['catname']= $v['catname'];
	        $v['html'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level - 1);
	        $arr[] = $v;
	      }
	      else
	      {
	      	$v['html'] = '';
	        $arr[] = $v;
	      }
	      $arr = array_merge($arr,limitless($data, $v['cid'],$level + 1));
	    }

	  }
	  return $arr;
	}
}

/**
 * 获得浏览器版本
 */
if ( ! function_exists('browser_info'))
{
	function browser_info()
	{
	    $agent = strtolower($_SERVER["HTTP_USER_AGENT"]);
	    $browser = null;
	    if (strstr($agent, 'msie 9.0')) {
	        $browser = 'msie9';
	    } else if (strstr($agent, 'msie 8.0')) {
	        $browser = 'msie8';
	    } else if (strstr($agent, 'msie 7.0')) {
	        $browser = 'msie7';
	    } else if (strstr($agent, 'msie 6.0')) {
	        $browser = 'msie6';
	    } else if (strstr($agent, 'firefox')) {
	        $browser = 'firefox';
	    } else if (strstr($agent, 'chrome')) {
	        $browser = 'chrome';
	    } else if (strstr($agent, 'safari')) {
	        $browser = 'safari';
	    } else if (strstr($agent, 'opera')) {
	        $browser = 'opera';
	    }
	    return $browser;
	}
}

/**
 * 跳转网址
 * @param string $url 跳转urlg
 * @param int $time 跳转时间
 * @param string $msg
 */
if ( ! function_exists('go'))
{
	function go($url, $time = 0, $msg = '')
	{
	    $url = site_url($url);
	    //检查标头是否已经发送    有一间隔
	    if (!headers_sent()) {
	        $time == 0 ? header("Location:" . $url) : header("refresh:{$time};url={$url}");
	        exit($msg);
	    } else {
	        echo "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
	        if ($time)
	            exit($msg);
	    }
	}
}

/**
 * 根据类型获得图像扩展名
 */
if (!function_exists('image_type_to_extension')) {

    function image_type_to_extension($type, $dot = true)
    {
        $e = array(1 => 'gif', 'jpeg', 'png', 'swf', 'psd', 'bmp', 'tiff', 'tiff', 'jpc', 'jp2', 'jpf', 'jb2', 'swc', 'aiff', 'wbmp', 'xbm');
        $type = (int)$type;
        return ($dot ? '.' : '') . $e[$type];
    }

}
/**
 * 获得随机字符串
 * @param int $len 长度
 * @return string
 */
if (!function_exists('rand_str')) {
	function rand_str($len = 6)
	{
	    $data = 'abcdefghijklmnopqrstuvwxyz0123456789';
	    $str = '';
	    while (strlen($str) < $len)
	        $str .= substr($data, mt_rand(0, strlen($data) - 1), 1);
	    return $str;
	}
}
/**
 * 多个PHP文件合并
 * @param array $files 文件列表
 * @param bool $space 是否去除空白
 * @param bool $tag 是否加<?php标签头尾
 * @return string 合并后的字符串
 */
if (!function_exists('file_merge')) {
	function file_merge($files, $space = false, $tag = false)
	{
	    $str = ''; //格式化后的内容
	    foreach ($files as $file) {
	        $con = trim(file_get_contents($file));
	        if ($space)
	            $con = compress($con);
	        $str .= substr($con, -2) == '?>' ? trim(substr($con, 5, -2)) : trim($con, 5);
	    }
	    return $tag ? '<?php if(!defined("BASEPATH")){exit("No direct script access allowed");}' . PHP_EOL  . $str . "\t?>" : $str;
	}
}
/* End of file common_helper.php */
/* Location: ./shared/heleprs/common_helper.php */
 /**
  * 视图输出
  * @access	public
  */
function template( $view,$data = '', $header = 'common/header',$footer='common/footer' )
{
	$CI =& get_instance();
	$data['url_static_image'] = $CI->config->item('url_static_image');
	$CI->load->view($header, $data, FALSE);
	
	if (is_array($view)) {
		foreach ($view as $key => $value) {
			$CI->load->view($value, $data, FALSE);
		}
	}else{
		$CI->load->view($view, $data, FALSE);
	}

	$CI->load->view($footer, $data, FALSE);
	// exit();
}
/**
 * 获取图片的缩略图
 * @param string $path 文件目录
 * @param string $node 后缀
 * @return string 
 */
if (!function_exists('get_thumb')) {
	function get_thumb($path,$node = '')
	{
		if (FALSE === strpos($path, '.'))
		{
		    return $path;
		}
        if(empty($node))
        {
   		    return $path;     
        }
        else
        {
        	$arr = explode('.', $path);
        	$file_name = current($arr);
        	$extension = end($arr);
            $str =  $file_name.$node.'.'.$extension;
            return $str; 	
        }
       
	}
}
/**
 * 成功提示函数
 * @param  [type] $url [跳转地址]
 * @param  [type] $msg [提示信息]
 * @return [type]      [description]
 */
if ( ! function_exists('success'))
{
function success($url, $msg){
	header('Content-Type:text/html;charset=utf-8');
	$url = site_url($url);
	echo "<script type='text/javascript'>alert('$msg');location.href='$url'</script>";
	exit();
}
}
/**
 * 错误提示函数
 * @param  [type] $msg [提示信息]
 * @return [type]      [description]
 */
if ( ! function_exists('error'))
{
	function error($msg){
		header('Content-Type:text/html;charset=utf-8');
		echo "<script type='text/javascript'>alert('$msg');window.history.back();</script>";
		exit();
	}
 } 


