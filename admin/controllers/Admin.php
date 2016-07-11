<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	// /默认方法
	public function index()
	{
		echo 12222;exit();
	}

	public function role()
	{
		echo "role";exit();
	}
}