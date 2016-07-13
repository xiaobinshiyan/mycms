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
		$uid = $this->session->userdata('uid');
		$username = $this->session->userdata('username');
		if(! $username || ! $uid)
		{
			redirect('login');
		}
		return true;
	}

	/**
	 * 判断权限
	 * @return [type] [description]
	 */
	protected function _check_auth()
	{
		$urlArr = $this->uri->segment_array();
		$control = $urlArr[1];
		$method  = $urlArr[2];
		//如果是超级管理员,那么直接返回
		if($_SESSION['username'] == 'admin')
		{
			return true;
		}
		//判断节点是否存在  如果不存在  那么说明不需要验证，直接返回
		$where = array('control'=>$control,'method'=>$method);
		$isexist = $this->db->select("nid")->from('node')->where($where)->get()->row_array();
		if(empty($isexist))
		{
			return true;
		}
		else
		{
			$arr = array(
				'nid' => $isexist['nid'],
				'rid' => $_SESSION['rid']
				);
			$falg = $this->db->select("*")->from('access')->where($arr)->get()->row_array();
			$isauth = empty($falg) ? false : true;
			if($isauth == false)
			{
				$this->error("welcome/defaultPage","没有操作权限");
			}
			return $isauth;
		}
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


	// 	//上传图片
	protected function _upload_img($image,$path = "./uploads",$width = '1000',$height = '1000',$allowed_types = 'gif|jpg|png|jpeg')
    {
		 $config['upload_path'] = $path;
		 $config['allowed_types'] = $allowed_types;
		 $config['max_size'] = '10000';
		 $config['file_name'] = time().mt_rand(1000,9999);
		 $config['max_width'] = $width;
         $config['max_height'] = $height;
	     // 载入上传类
	     $this->load->library('upload',$config);
	     $this->upload->do_upload($image);
	     $wrong = $this->upload->display_errors();
		 if($wrong)
		 {
		    show_error($wrong);
		    return FALSE;
		 }
		//返回信息
		return $this->upload->data();
   }


}