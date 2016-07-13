<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$table = $this->db->dbprefix('node');
		$uid = $this->session->userdata('uid');	
		$sql = "SELECT n.nid,n.title FROM {$table} AS n WHERE n.state=1 AND n.pid=0";
		$data['node'] = $this->db->query($sql)->result_array();
		$this->load->view('admin/index',$data);
	}

	    /**
	     * 获取菜单
	     */
	    public function get_child_menu()
	    {
	    	$pid = $this->input->get('pid');
	    	$table = $this->db->dbprefix('node');
	    	//当超级管理员的时候所有节点
	    	if($_SESSION['username'] == 'admin')
	    	{
	    		$showMenuData = $this->db->query("SELECT * FROM {$table} AS n WHERE n.state=1 ORDER BY n.order ASC")->result_array();
	    	}
	        else
	        {
	        	$showMenuData = $this->db->query("SELECT * 
	        		FROM {$table} AS n 
	        		RIGHT JOIN (SELECT * FROM su_access WHERE rid={$_SESSION['rid']} ORDER BY nid ASC) AS a 
	        		ON n.nid = a.nid 
	        		WHERE n.state=1 AND n.type= 1
	        		ORDER BY n.order ASC")->result_array();
	        }

	        $childMenuData = channelLevel($showMenuData, $pid, '', 'nid');
	        $html = "<div class='nid_$pid'>";
	        foreach ($childMenuData as $menu) {
	            $html .= "<dl><dt>" . $menu['title'] . "</dt>";
	            foreach ($menu['data'] as $linkMenu) {
	                $param = $linkMenu['param'] ? '/' . $linkMenu['param'] : '';
	                    $url = base_url()."index.php/".$linkMenu['control']."/".$linkMenu['method'].$param;
	                $html .= "<dd><a nid='" . $linkMenu["nid"] . "'
	                    onclick='get_content(this," . $linkMenu["nid"] . ")' url='" . $url . "'>" . $linkMenu['title'] . "</a></dd>";
	            }
	            $html .= "</dl>";
	        }
	        $html .= "</div>";
	       echo $html;

	    	exit();
	    }
	    /**
	     * 欢迎页面
	     */
	    public function defaultPage()
		{
			$this->load->view('admin/welcome');
		}
		public function sideTree()
		{
			$this->load->view('admin/welcome1');
		}
		/**
		 * 密码修改
		 */

		public function change_pass()
		{
			if(IS_POST)
			{
				$new_pwd = $this->input->post('newPwd');
				$data = array(
					'password' => md5($new_pwd)
				);
				$uid = $this->session->userdata('uid');
				$flag = $this->db->update('admin', $data, array('uid'=>$uid));
				if($flag)
				{
					$this->session->sess_destroy();
					echo "<script>alert('修改密码成功');top.location.reload();</script>";				
				}
				else
				{
					$this->error('修改密码不成功');
				}
			}
			else
			{
				$this->load->view('admin/change_pwd');
			}

		}

		/**
		 * check this password
		 */
		public function check_password()
		{
			if ($this->input->is_ajax_request()) 
			{
				$old = trim($this->input->post('oldPwd'));
				$uid = $this->session->userdata('uid');
				$info = $this->db->select('password')->from('admin')->where(array('uid'=>$uid))->get()->row();
				if(md5($old) == $info->password)
				    echo 1;
				 else
				    echo 0;
				 exit();
			}
			else
			{
				echo 0;
				exit();
			}
		}

		/**
		 * 栏目管理
		 */
		public function category()
		{
			$data['category'] = limitless($this->categorys);
			$this->load->view('admin/category',$data);
		}

		/**
		 * 添加栏目
		 */
		public function category_add()
		{

			if(IS_POST)
			{
			    $data = array();//表单内容
			    $data = $this->get_cat_data();
			    $this->db->insert('category',$data);
			    $this->success('welcome/category','添加成功');
			}
			else
			{
			    $tmp_id = $this->uri->segment(3);
			    $data['pid'] = is_numeric($tmp_id) ? $tmp_id : false;
				$data['category'] = limitless($this->categorys);
			    $this->load->view('admin/category_add',$data);
			}
		}

		//栏目编辑
		public function category_edit()
		{
			$cid = $this->uri->segment(3);
			if(IS_POST)
			{
			    $data = array();//表单内容
			    $data = $this->get_cat_data();
			    $this->db->update('category',$data,array('cid'=>$cid));
			    $this->success('welcome/category','编辑成功');
			}
			else
			{
				$data['category'] = limitless($this->categorys);
				$data['cates'] = $this->db->get_where('category',array('cid'=>$cid))->row_array();
				$this->load->view('admin/category_edit',$data);
			}
		}
	    //栏目删除
	    public function category_del()
	    {
	      $this->load->model('dxdb_model','cat','dx_category');
	      $id = intval($this->input->post('id'));
	      $flag = $this->cat->dx_delete(array('cid'=>$id));
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
	      echo json_encode($arr);
	      exit();
	    }
		//图片上传
		public function cate_img_upload()
		{
			$image = $_POST['name'];//"goods_image"
			$image_path = '../uploads/category';//图片路径



			$info = $this->_upload_img($image,$image_path);

			//缩略图设置   start
			// $crop_img = $info['full_path'];
			// $thumb_img = $info['file_path'].$info['raw_name'].'_1000_500'.$info['file_ext'];
			// thumb($crop_img,$thumb_img, 1034, 449, 5);//缩略图
			//缩略图结束  end

			$data = array ();
			$data ['thumb_name'] = "../uploads/category/".$info['file_name'];
			$data ['src_name'] = base_url()."../uploads/category/".$info['file_name'];
			$data ['name']      = $info['file_name'];
			 
			//整理为json格式
			echo json_encode($info);
			exit();
		}

		//图片删除
		public function cate_img_del()
		{
			$img_url = '../uploads/category/'.trim($_POST['name']);//"goods_image"
		    // $img_url = '../uploads/course/'.$image;
		    // $img = pathinfo($img_url);
		    // $thumb_url = '../uploads/course/'.$img['filename'].'_1000_500.'.$img['extension'];
			@unlink($img_url); 
			// @unlink($thumb_url); 
			// 整理为json格式
			echo 1;
			exit();
		}

		//==================================================================================================
	    public function site()
	    {
	    	$this->_check_auth();
	    	$this->load->model('dxdb_model','site','site');
	    	if(IS_POST)
	    	{
	    		$id = $this->input->post('id');
	    		$data = $this->get_site_data();
	    		$flag = $this->site->dx_update($data,array('id'=>$id));
	    		update_cache('site');
	    		$this->success('welcome/site','操作成功 :)');
	    	}
	    	else
	    	{
	    		$dd = $this->settings->load('site');
	    		$data['site'][] = $this->settings->item('setting');
	            if(empty($data['site']) && ! is_array($data['site']))
	            {
	            	$data['site'] = $this->site->all();
	            }
	    		$this->load->view('admin/site',$data);
	    	}
	    }

		/**
		 * 获取表单网站基本信息
		 * @return array [baseinfo]
		 */
		private function get_site_data()
		{
		   return  array(
	           'site_name'      		=> $this->input->post('site_name'),
	           'site_domain'  			=> $this->input->post('site_domain'),
	           'site_logo'  			=> $this->input->post('image'),
	           'seo_description'		=> $this->input->post('seo_description'),
	           'seo_keyword' 			=> $this->input->post('seo_keyword'),
	           'status'                 => $this->input->post('status'),
	           'close_reason'           => $this->input->post('close_reason')
		    );
		}

		/**
		 * 获取表单category目录数据
		 * @return array category info
		 */
		private function get_cat_data()
		{
		   return  array(
	           'pid'      			=> $this->input->post('pid'),
	           'cattype'  			=> $this->input->post('cattype'),
	           'catname'  			=> $this->input->post('catname'),
	           'catimage'			=> $this->input->post('image'),
	           'seo_title' 			=> $this->input->post('seo_title'),
	           'seo_description'    => $this->input->post('seo_description'),
	           'sort'               => $this->input->post('sort')
		    );
		}
}
