<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dxdb_model','acc','access');
	}

	public function index()
	{

		$rid = $this->uri->segment(3);
		$sql = "SELECT n.nid,n.title,n.pid,n.type,a.rid as access_rid FROM su_node AS n LEFT JOIN
					(SELECT * FROM su_access WHERE rid={$rid}) AS a
		    		ON n.nid = a.nid ORDER BY n.order ASC";
		$result = $this->db->query($sql)->result_array();


		foreach ($result as $n => $r) {
		    //当前角色已经有权限或不需要验证的节点
		    $checked = $r['access_rid'] || $r['type'] == 2 ? " checked=''" : '';
		    //不需要验证的节点，关闭选择（因为所有管理员都有权限）
		    $disabled = $r['type'] == 2 ? 'disabled=""' : '';
		    //表单
		    $result[$n]['checkbox'] = "<label>
		            <input type='checkbox' name='nid[]' value='{$r['nid']}' $checked $disabled/> {$r['title']}
		            </label>";
		}
		$this->load->library('data');
		$data['access'] = Data::channelLevel($result, 0, '-', 'nid');
		$data['rid'] = $rid;
		$this->load->view('access/index',$data);
	}

	public function edit()
	{
		if(IS_POST)
		{
			$rid = $this->input->post('rid');
			$nids = $this->input->post('nid');
			if(! empty($rid))
			{
				$this->acc->dx_delete(array('rid'=>$rid));
				foreach ($nids as $v) {
				    $data = array("rid" => $rid, "nid" => $v);
				    $this->acc->dx_insert($data);
				}
				$arrinfo['status']  = 1;
				$arrinfo['message']  = "权限设置成功";	
			}
			else
			{
				$arrinfo['status']  = 0;
				$arrinfo['message']  = "发生未知错误！联系相关开发人员";	
			}
			$this->ajax($arrinfo);
		}
	}
}