<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MY_Controller {

	//构造函数
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dxdb_model','art','article');
	}

	public function art_show()
	{
		$cid = $this->uri->segment(3);
		$data['arts'] = is_numeric($cid) ? $this->db->get_where('article',array('cid'=>$cid))->result_array() : array();
		$data['cid'] = $cid;
		$this->load->view('article/art_show',$data);
	}

	// ajax获取栏目数据
	public function ajaxcategory()
	{
		//获取所有栏目
		$categorys = $this->db->where(array('cattype'=>1))->get('category')->result_array();
		$cates = limitless($categorys);
		if (!empty($cates)) 
		{
		    foreach ($cates as $n => $cat) 
		    {
		        $data = array();
		            if ($cat['cattype'] == 1 && $cat['pid'] != 0) 
		            {
		                $url = site_url('article/art_show/'.$cat['cid']).'/?ace='.rand(100000,999999);
		            } 
		            else 
		            {
		                $url = 'javascript:';
		            }
		            $data['id'] = $cat['cid'];
		            $data['pId'] = $cat['pid'];
		            $data['url'] = $url;
		            $data['target'] = 'content';
		            $data['open'] = true;
		            $data['name'] = $cat['catname'];
		            $sdf[] = $data;	            
		    }
		   $this->ajax($sdf);
		}
	}

	//新闻添加
	public function art_add()
	{
		if(IS_POST)
		{
			$data = $this->get_art_data();
			$cid = $this->input->post('cid');
		    $flag = $this->db->insert('article',$data);
		    if($flag) $this->success('article/art_show/'.$cid);
		}
		else
		{
			$data['cid'] = $this->uri->segment(3);
	  		$categorys = $this->db->select('cid,pid,catname')->where(array('cattype'=>1))->get('category')->result_array();
	  		$data['category'] = limitless($categorys);
	  		$this->load->view('article/art_add',$data);			
		}

	}

	//新闻编辑
	public function art_edit()
	{
		$aid = $this->uri->segment(3);
		if(IS_POST)
		{
			$data = $this->get_art_data();
			$cid = $this->input->post('cid');
			$flag = $this->art->dx_update($data,array('aid'=>$aid));
			if($flag) $this->success('article/art_show/'.$cid.'/?ace='.time());
		}
		else
		{
			$categorys = $this->db->select('cid,pid,catname')->where(array('cattype'=>1))->get('category')->result_array();
			$data['category'] = limitless($categorys);
			$data['art'] = $this->art->one(array('aid'=>$aid));
		    $this->load->view('article/art_edit',$data);		
		}
		
	}
    //删除
	public function art_del()
	{
		$id = intval($this->input->post('id'));
		$flag = $this->art->dx_delete(array('aid'=>$id));
		if($flag)
		{
		  $arr['status']  = 1;
		  $arr['message']  = "删除信息成功 :)";
		}
		else
		{
		   $arr['status']  = 0;
		  $arr['message']  = "操作失败 :(";         
		} 
		$this->ajax($arr);
	}

	//编辑状态
	public function art_status()
	{
		$id = intval($this->input->post('id'));
		$state = intval($this->input->post('state'));
		if($state == 1)
		{
		    $flag = $this->art->dx_update(array('status'=>0),array('aid'=>$id));
		    $msg = '操作成功：信息屏蔽!';
		}
		else
		{
		    $flag = $this->art->dx_update(array('status'=>1),array('aid'=>$id));
		    $msg = '操作成功：信息状态正常 :)';
		}
		if($flag)
		{
		  $arr['status']  = 1;
		  $arr['message']  = $msg;
		}
		else
		{
		   $arr['status']  = 0;
		   $arr['message']  = "操作失败 :(";        
		} 
		$this->ajax($arr);
	}

	//ajax图片上传
	public function art_img_upload()
	{
		$image = $_POST['name'];//"goods_image"
		$image_path = '../uploads/article';//图片路径
		$info = $this->_upload_img($image,$image_path);

		//缩略图设置   start
		// $crop_img = $info['full_path'];
		// $thumb_img = $info['file_path'].$info['raw_name'].'_1000_500'.$info['file_ext'];
		// thumb($crop_img,$thumb_img, 1034, 449, 5);//缩略图
		//缩略图结束  end

		$data = array ();
		$data ['thumb_name'] = "../uploads/article/".$info['file_name'];
		$data ['src_name'] = base_url()."../uploads/article/".$info['file_name'];
		$data ['name']      = $info['file_name'];
		 
		//整理为json格式
		$this->ajax($data);
	}
	//图片删除
	public function art_img_del()
	{
		$img_url = '../uploads/article/'.trim($_POST['name']);//"goods_image"
		@unlink($img_url); 
		echo 1;
		exit();
	}

	//获取post数据
	private function get_art_data()
	{
		$data = array();
		$addtime = strtotime($this->input->post('addtime'));
		$data= array(
           'cid'        => $this->input->post('cid'),
           'title'      => $this->input->post('title'),
           'seo_title'  => $this->input->post('seo_title'),
           'desc'       => $this->input->post('desc'),
           'image'      => $this->input->post('image'),
           'content'    => $this->input->post('content'),
           'new_window' => $this->input->post('new_window'),
           'addtime'    => $addtime,
           'updatetime' => time(),
           'sort'       => $this->input->post('sort')
         );

		return $data;
	}
}