<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		// p(DX_SHARE_PATH) ;
		// $ss = $this->db->select('*')->from('su_admin')->get()->result_array();
		$this->load->model('dxdb_model','ad','admin');
		$ss = $this->ad->one(array('uid'=>1),false);
		var_dump($ss->uid);exit;
		$this->load->view('welcome_message');
	}
}
