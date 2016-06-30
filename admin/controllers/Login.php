<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 后台登录控制器
 */
class Login extends CI_Controller
{
	/**
	 * 默认方法
	 * @return [type] [description]
	 */
	public function index()
	{
		$username = $this->session->userdata('username');
		$uid = $this->session->userdata("uid");
		if($username && $uid)
		{
			redirect('welcome');
		}
		$this->load->view('admin/login');
	}

	/**
	 *  验证码方法
	 * @return [type] [description]
	 */
	public function code()
	{
		$this->load->library('code',array(
			'width'    => 80,
			'height'   => 30,
			'codeLen'  => 4,
			'fontSize' => 16, 
			));
		$this->code->show();
	}

}