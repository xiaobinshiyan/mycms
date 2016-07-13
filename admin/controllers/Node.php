<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Node extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dxdb_model','node','node');
	}

	//默认方法
	public function index()
	{
		$this->_check_auth();
		$data['nodes'] = $this->get_nodes();
		$this->load->view("node/index",$data);
	}

	/**
	 * 添加新的后台菜单
	 */
	public function add()
	{
		$this->_check_auth('node/index');
		if(IS_POST)
		{
			$info = $this->input->post();
			$this->checked_info($info);    
	       	$res = $this->node->dx_insert($info);
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
			$data['nodes'] = $this->get_nodes();
			$data['nid'] = $this->uri->segment(3);
			$this->load->view('node/add',$data);
		}
	}

	/**
	 * 修改node
	 * @return [type] [description]
	 */
	public function edit()
	{
		$this->_check_auth('node/index');
		$nid = $this->uri->segment(3);
		if(IS_POST)
		{
			$info = $this->input->post();
			$this->checked_info($info);    
	       	$res = $this->node->dx_update($info,array('nid'=>$nid));
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
			$data['nodes'] = $this->get_nodes();
			$data['info'] = $this->node->one(array('nid'=>$nid));
			$this->load->view('node/edit',$data);
		}

	}

	public function del()
	{
		$fal = $this->_check_auth();
		if($fal == false)
		{
			$arr['status']  = 0;
			$arr['message']  = "你没有删除权限";
			$this->ajax($arr);
		}
		$nid = $this->input->post('nid');
		//判断是否有子元素
		$haschild = $this->node->all(array('pid'=>$nid));
		if(! empty($haschild))
		{
			$arr['status']  = 0;
			$arr['message']  = "请先删除子元素 :-(";
			$this->ajax($arr);
		}
		$flag = $this->node->dx_delete(array('nid'=>$nid));
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
	 * 修改后台菜单排序
	 * @return array 结果信息
	 */
	public function chagesort()
	{
		$sort = intval($this->input->post('sort'));
		$nid = intval($this->input->post('nid'));
		$flag = $this->node->dx_update(array('order'=>$sort),array('nid'=>$nid));
		if($flag)
		{
		  $arr['status']  = 1;
		  $arr['message']  = "更改排序成功 :)";
		}
		else
		{
		   	$arr['status']  = 0;
		  	$arr['message']  = "操作失败 :(";         
		} 
		$this->ajax($arr);
	}

	//获取后台菜单数据
	public function get_nodes()
	{
		$this->load->library('data');
		$allcates = $this->node->all(array(),array('order asc'));
		$nodes = Data::tree($allcates, "title", "nid", "pid");
		return $nodes;
	}

	//检查post 数据
	private function checked_info($info)
	{
		$arrinfo = array();
		if(empty($info['title']))
		{
			$arrinfo['status']  = 0;
			$arrinfo['message']  = "节点名称不能为空 :-(";	
			$this->ajax($arrinfo);
		}
       if(empty($info['control']))
       {
       		$arrinfo['status']  = 0;
       		$arrinfo['message']  = "控制器名不能为空 :-(";	
       		$this->ajax($arrinfo);
       }
       if(empty($info['method']))
       {
       		$arrinfo['status']  = 0;
       		$arrinfo['message']  = "方法名不能为空 :-(";
       		$this->ajax($arrinfo);		
       }
       return true;
	}
}