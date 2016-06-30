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

	














	

}