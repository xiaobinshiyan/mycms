<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * qiniu controller.
	 * @created 2016/7/7
	 * @author xiaobin <zxbin.1990@gmail.com>
	 */
class Test extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->config->load('qiniu');
	}

	public function index()
	{
		$data['name'] = $this->input->get('name');
		$data['uptoken'] = $this->get_qiniu_token();
		$data['url'] = $this->config->item('bucket_url');
		$this->load->view('common/uploadfile',$data);
	}
	//获取七牛上传配置
	private function get_qiniu_token()
	{
	   	include  DX_SHARE_PATH.'libraries/qiniu/rs.php';
	   	$accessKey  = $this->config->item('accessKey');
	   	$secretKey = $this->config->item('secretKey');
	   	$bucket = $this->config->item('bucket');

	   	
	   	Qiniu_SetKeys($accessKey, $secretKey);
	   	$putPolicy = new Qiniu_RS_PutPolicy($bucket);
	   	$upToken = $putPolicy->Token(null);
	   	return $upToken;
	}
}