<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 官网首页banner管理
 * @created 2016/7/25 10:00
 * @author xiaobin <zxbin.1990@gmail.com>
 */

class Banner extends MY_Controller {

	//INSTRUCT
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dxdb_model','ban','banner');
	}

	/**
	 * banner默认页面
	 * @return [type] [description]
	 */
	public function index()
	{
		$fal = $this->_check_auth();
		$data['info'] = $this->ban->all();
		$this->load->view('official/banner',$data);
	}

	/**
	 * banner添加
	 */
	public function add()
	{
		$fal = $this->_check_auth();
		if(IS_POST)
		{
			$info = $this->input->post();
			$this->checked_info($info);    
	       	$res = $this->ban->dx_insert($info);
	       	if($res == false)
	       	{
		       	$arr['status']  = 0;
		       	$arr['message']  = "发生未知错误 :-(";
	       	}
	       	else
	       	{
	       		$arr['status']  = 1;
	       		$arr['message']  = "添加成功:-)";
	       	}
			$this->ajax($arr);
		}
		else
		{
			$this->load->view('official/banner_add');
		}
	}

	/**
	 * 修改banner的排序
	 * @return json
	 */
	public function chagesort()
	{
		if ($this->input->is_ajax_request()) 
		{
			$sort = intval($this->input->post('sort'));
			$bid = intval($this->input->post('bid'));
			$flag = $this->ban->dx_update(array('sort'=>$sort),array('bid'=>$bid));
			if($flag)
			{
			  $arr['status']  = 1;
			  $arr['message']  = "更改排序成功 :)";
			}
			$this->ajax($arr);
		}
	   	$arr['status']  = 0;
	  	$arr['message']  = "操作失败 :(";    
	  	$this->ajax($arr);     
	}

	/**
	 * 删除操作
	 * @return json  status 状态  message 消息
	 */
	public function del()
	{
		$fal = $this->_check_auth();
		if($fal == false)
		{
			$arr['status']  = 0;
			$arr['message']  = "你没有删除权限";
			$this->ajax($arr);
		}
		if($this->input->is_ajax_request())
		{
			$bid = $this->input->post('bid');
			$flag = $this->ban->dx_delete(array('bid'=>$bid));
			if($flag !== FALSE)
			{
				$arr['status']  = 1;
				$arr['message']  = "删除成功 :-)";
				$this->ajax($arr);
			}
		}
		$arr['status']  = 0;
		$arr['message']  = "发生未知错误 :-(";	
		$this->ajax($arr);
	}

	public function checked_info($info)
	{
		$arrinfo = array();
		if(empty($info['btitle']))
		{
			$arrinfo['status']  = 0;
			$arrinfo['message']  = "名称title不能为空 :-(";	
			$this->ajax($arrinfo);
		}
       if(empty($info['burl']))
       {
       		$arrinfo['status']  = 0;
       		$arrinfo['message']  = "url 链接不能为空 :-(";	
       		$this->ajax($arrinfo);
       }
       if(empty($info['bimg']))
       {
       		$arrinfo['status']  = 0;
       		$arrinfo['message']  = "图片不能为空 :-(";
       		$this->ajax($arrinfo);		
       }
       return true;
	}
}