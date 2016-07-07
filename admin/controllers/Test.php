<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		include  DX_SHARE_PATH.'libraries/qiniu/rs.php';
		$accessKey = '-rkOSEPcwEhivJXxJ0PZSP7cbkMQ6OMkkhPDXzC7';
		$secretKey = 'hvw_oTlvAn43zX9EFlemLotq7r9IqJJpp6K3yX-T';

		// $auth = new Auth($accessKey, $secretKey);

		// 要上传的空间
		$bucket = 'tearsea';
		Qiniu_SetKeys($accessKey, $secretKey);
		$putPolicy = new Qiniu_RS_PutPolicy($bucket);
		$upToken = $putPolicy->Token(null);
		$data['uptoken'] = $upToken;
		echo $data['uptoken'];
	}
}