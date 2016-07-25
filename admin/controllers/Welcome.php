<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 * @created 2016/7/2
	 * @author xiaobin <zxbin.1990@gmail.com>
	 */
	public function index()
	{
		$table = $this->db->dbprefix('node');
		$uid = $this->session->userdata('uid');	
		$sql = "SELECT n.nid,n.title FROM {$table} AS n WHERE n.state=1 AND n.pid=0 ORDER BY n.order ASC, n.nid ASC";
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
	    		$showMenuData = $this->db->query("SELECT * FROM {$table} AS n WHERE n.state=1 ORDER BY n.order ASC, n.nid ASC")->result_array();
	    	}
	        else
	        {
	        		// SELECT * 
	        		// FROM {$table} AS n 
	        		// RIGHT JOIN (SELECT * FROM su_access WHERE rid={$_SESSION['rid']} ORDER BY nid ASC) AS a 
	        		// ON n.nid = a.nid 
	        		// WHERE n.state=1 AND (n.type= 2 OR n.type=1)
	        		// ORDER BY n.order ASC
	        	$showMenuData = $this->db->query("
	        		SELECT * 
	        		FROM su_access AS a 
	        		RIGHT JOIN su_node AS n
	        		ON a.nid = n.nid 
	        		WHERE n.state=1 AND (n.type= 2 OR rid={$_SESSION['rid']})
	        		ORDER BY n.order ASC, a.nid ASC
	        		")->result_array();
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

}
