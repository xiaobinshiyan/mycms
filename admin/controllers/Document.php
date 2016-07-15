<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 文档管理
 * @created 2016/7/14 10:20
 * @author xiaobin <zxbin.1990@gmail.com>
 */

class Document extends MY_Controller {

	//INSTRUCT
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 默认方法  文档列表
	 * @return [type] [description]
	 */
	public function index()
	{
		echo 'Comming soon';
	}

	/**
	 * 文档分类
	 * @return [type] [description]
	 */
	public function category()
	{
		$this->_check_auth();
		$data['cates'] = $this->get_all_cates();
		$this->load->view('document/category',$data);
	}

	/**
	 * 获取所有的文档分类
	 * @return [type] [description]
	 */
	private function get_all_cates()
	{
		$this->load->model('dxdb_model','cat','doc_category');
		$this->load->library('data');
		$allcates = $this->cat->all(array(),array('sort asc'));
		$cates = Data::tree($allcates, "dname", "did", "pid");
		return $cates;
	}

}