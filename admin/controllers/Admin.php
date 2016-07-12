<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dxdb_model','admin','admin');
	}

	// /默认方法
	public function index()
	{
		$data['userinfo'] = $this->admin->all();
		$this->load->view('')
	}

	public function role()
	{
		echo "role";exit();
	}
}