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
		$this->load->library('data');
		$allcates = $this->node->all(array(),array('order asc'));
		$data['nodes'] = Data::tree($allcates, "title", "nid", "pid");
		$this->load->view("node/index",$data);
	}

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
}