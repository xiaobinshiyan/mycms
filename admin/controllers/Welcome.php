<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// p(DX_SHARE_PATH) ;
		// $ss = $this->db->select('*')->from('su_admin')->get()->result_array();
		$this->load->model('dxdb_model','ad','admin');
		$ss = $this->ad->one(array('id'=>1));
		var_dump($ss);exit;
		$this->load->view('welcome_message');
	}
}
