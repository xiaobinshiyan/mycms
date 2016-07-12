<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dxdb_model','admin','admin');
	}

	// /默认方法
	public function index()
	{
		$data['users'] = $this->admin->all();
		$this->load->view('admin/admin',$data);
	}

	//增加管理员
	public function add()
	{
		if(IS_POST)
		{
			$info = $this->input->post();
			$this->checked_admin_info($info,false); 
			$rname = $this->db->select('rname')->from('role')->where('rid',$info['role'])->get()->row();
			$ins_info = array(
				'username'  => $info['username'],
				'password'  => md5($info['password']),
				'logintime' => time(),
				'role'      => $info['role'],
				'rname'     => $rname->rname,
				'status'    => $info['status'],
				'lastip'    => '0.0.0.0'
				);
		       	$res = $this->admin->dx_insert($ins_info);
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
			$this->load->model('dxdb_model','role','role');
			$data['roles'] = $this->role->all();
			$this->load->view('admin/add',$data);
		}
	}

	//编辑管理员信息
	public function edit()
	{
		$uid = $this->uri->segment(3);
		if(IS_POST)
		{
			$info = $this->input->post();
			$this->checked_admin_info($info,$uid);    
			$rname = $this->db->select('rname')->from('role')->where('rid',$info['role'])->get()->row();
			$ins_info = array(
				'username'  => $info['username'],
				'password'  => md5($info['password']),
				'logintime' => time(),
				'role'      => $info['role'],
				'rname'     => $rname->rname,
				'status'    => $info['status'],
				'lastip'    => '0.0.0.0'
				);
	       	$res = $this->admin->dx_update($ins_info,array('uid'=>$uid));
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
			$this->load->model('dxdb_model','role','role');
			$data['roles'] = $this->role->all();
			$data['info'] = $this->admin->one(array('uid'=>$uid));
			$this->load->view('admin/edit',$data);
		}
	}

	//删除菜单信息
	public function del()
	{
		$uid = $this->input->post('uid');
		if($uid == 1)
		{
			$arr['status']  = 0;
			$arr['message']  = "超级管理员不允许删除";
			$this->ajax($arr);
		}
		$flag = $this->admin->dx_delete(array('uid'=>$uid));
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

	//检查信息
	private function checked_admin_info($info,$uid)
	{
		$username = $info['username'];
		if($uid == false)
		{
			$data = $this->admin->one(array('username'=>$username));
			if(! empty($data))
			{
				$arrinfo['status']  = 0;
				$arrinfo['message']  = "用户名称已经存在了";	
				$this->ajax($arrinfo);
			}	
		}

		if($info['password'] !== $info['c_password'])
		{
			$arrinfo['status']  = 0;
			$arrinfo['message']  = "两次密码不一致";	
			$this->ajax($arrinfo);
		}
		if(empty($info['username']) || empty($info['password']) || empty($info['c_password']))
		{
			$arrinfo['status']  = 0;
			$arrinfo['message']  = "用户名和密码不能为空";	
			$this->ajax($arrinfo);
		}
		return true;
	}
}