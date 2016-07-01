<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 扩展核心类
 */
class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_check_login();
	}
  /**
   * 判断是否登陆
   * @return [type] [description]
   */
	public  function _check_login()
	{
			$username = $this->session->userdata('username');
			$uid = $this->session->userdata('uid');
			if(! $username || ! $uid)
			{
				redirect('login');
			}
			return true;
	}

	
	   //error函数
	    protected function error($url = '',$msg = ':(  出错了！',$time = 1)
		{
			$url = $url ? "window.location.href='" . site_url($url) . "'" : "window.location.href='".DX_HISTORY."'";
		    $this->load->view('common/error',array('msg' => $msg, 'url' => $url, 'time' => $time));
			echo $this->output->get_output();
			exit();
		}
		//success函数
	    protected function success($url = '',$msg = ':)  操作成功',$time = 1)
		{
			$url = $url ? "window.location.href='" . site_url($url) . "'" : "window.location.href='".DX_HISTORY."'";
		    $this->load->view('common/success',array('msg' => $msg, 'url' => $url, 'time' => $time));
			echo $this->output->get_output();
			exit();
		}

		/**
		 * Ajax输出
		 * @param $data 数据
		 * @param string $type 数据类型 text html xml json
		 */
		protected function ajax($data, $type = "JSON")
		{
		    $type = strtoupper($type);
		    switch ($type) {
		        case "HTML" :
		        case "TEXT" :
		            $_data = $data;
		            break;
		        default :
		            $_data = json_encode($data);
		    }
		    echo $_data;
		    exit;
		}













	

}