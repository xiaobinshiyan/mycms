<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 角色控制
 * @created 2016/7/8
 * @author xiaobin <zxbin.1990@gmail.com>
 */
class Role extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dxdb_model','role','role');
	}

	// /默认方法
	public function index()
	{
		$data['roles'] = $this->role->all();
		$this->load->view('role/role',$data);
	}

	//add
	public function add()
	{
		if(IS_POST)
		{
			$info = $this->input->post();
			$this->checked_info($info,false);    
	       	$res = $this->role->dx_insert($info);
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
			$this->load->view('role/add');
		}
	}

	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del()
	{
		$rid = $this->input->post('rid');
		if($uid == 18)
		{
			$arr['status']  = 0;
			$arr['message']  = "超级管理员不允许删除";
			$this->ajax($arr);
		}
		$flag = $this->role->dx_delete(array('rid'=>$rid));
		if($flag !== FALSE)
		{
			$arr['status']  = 1;
			$arr['message']  = "删除成功 :-)";
		}
		else
		{
			$arr['status']  = 0;
			$arr['message']  = "发生未知错误 :-(";	
		}
		$this->ajax($arr);
	}
	
	/**
	 * edit
	 * @return [type] [description]
	 */
	public function edit()
	{
		$rid = $this->uri->segment(3);
		if(IS_POST)
		{
			$info = $this->input->post();
			$this->checked_info($info,$rid);    
	       	$res = $this->role->dx_update($info,array('rid'=>$rid));
	       	if($res == false)
	       	{
		       	$arr['status']  = 0;
		       	$arr['message']  = "发生未知错误 :-(";
	       	}
	       	else
	       	{
	       		$arr['status']  = 1;
	       		$arr['message']  = "编辑成功 :-)";
	       	}
			$this->ajax($arr);
		}
		else
		{
			$data['info'] = $this->role->one(array('rid'=>$rid));
			$this->load->view('role/edit',$data);
		}
	}

	/**
	 * 表单信息判断
	 * @param  array $info 需要验证的数据
	 * @return Boolean      
	 */
	private function checked_info($info,$id)
	{
		if($id == false)
		{
			$data = $this->role->one(array('rname'=>$info['rname']));
			if(! empty($data))
			{
				$arrinfo['status']  = 0;
				$arrinfo['message']  = "角色名称已经存在了";	
				$this->ajax($arrinfo);
			}
		}
	
		if(empty($info['rname']) || empty($info['title']))
		{
			$arrinfo['status']  = 0;
			$arrinfo['message']  = "表单信息不能为空";	
			$this->ajax($arrinfo);
		}
		return true;
	}

}