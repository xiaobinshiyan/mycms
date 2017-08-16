<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 后台登录控制器
 * @date 2016/7/4
 * @author xiaobin <zxbin.1990@gmail.com>
 */
class Login extends CI_Controller
{
	/**
	 * 默认方法
	 * @return [type] [description]
	 */
	public function index()
	{
		$username = $this->session->userdata('username');
		$uid = $this->session->userdata("uid");
		if($username && $uid)
		{
			redirect('welcome');
		}
		$this->load->view('admin/login');
	}

	/**
	 *  验证码方法
	 * @return [type] [description]
	 */
	public function code()
	{
		$this->load->library('code',array(
			'width'    => 80,
			'height'   => 30,
			'codeLen'  => 4,
			'fontSize' => 16, 
			));
		$this->code->show();
	}

    /**
	 * 登陆方法
	 */
	public function login_in()
	{
		//测试环境 取消验证验证码
		if(ENVIRONMENT !== 'development')
		{
			$code = $this->input->post('captcha');
			if(!isset($_SESSION))
			{
				session_start();
			}
			if(strtoupper($code) != $_SESSION['code']) error('验证码错误');
		}
		$this->load->model('dxdb_model','admin','admin');
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('passwd', TRUE);

		if($username && $password)
		{
			$admin = $this->admin->one(array('username'=>$username),false);
			if($admin)
			{
			    $throttle = $this->db->where('created_at >', date('Y-m-d H:i:s', time() - 600))
                    ->where('user_id', $admin->uid)
                    ->limit(1)
                    ->get('throttles')
                    ->row();
                if($throttle)
                {
                	//敢暴力破解就让你睡10分钟
                	$this->session->set_flashdata('error','密码输入次数过多，请10分钟后重新输入');
                    redirect('login');
                }
                if ($admin->password == md5($password))
				{
					if (intval($admin->status) !== 1)
					{
						$this->session->set_flashdata('error', "用户状态异常,请联系管理员!");
					}
					else
					{
						if ($admin->status == 1)
						{
						    $sessionData = array(
							'username'	=> $admin->username,
							'uid'		=> $admin->uid,
							'rid'		=> $admin->role,
							'logintime' => time()
							);
							$ip = getClientIp();
							$time = time();
							$this->admin->dx_update(array('lastip'=>$ip,'logintime'=>$time),array('uid'=>$admin->uid));
                            $this->session->set_userdata($sessionData);
							redirect('welcome/index');
						}
						else
						{
							$this->session->set_flashdata('error', "此帐号已被冻结,请联系统管理员!");
						}
						
					}
				}
				else
				{
					if(! $throttles = $this->session->userdata('throttles_'.$username))
					{
						$this->session->set_userdata('throttles_'.$username,1);
					}
					else
					{
						$throttles++;
						$this->session->set_userdata('throttles_'.$username,$throttles);
						if($throttles > 10)
						{
						    $throttle_data['user_id'] = $admin->uid;
                            $throttle_data['type'] = 'attempt_login';
                            $throttle_data['ip'] = $this->input->ip_address();
                            $throttle_data['created_at'] =  $throttle_data['updated_at'] = date('Y-m-d H:i:s');
                            $this->db->insert('throttles', $throttle_data);
                            $this->session->set_userdata('throttles_'.$username, 0);	
						}
					}
					$this->session->set_flashdata('error', '登陆密码错误!');
				}
			}
			else
			{
				$this->session->set_flashdata('error','不存在的用户');
			}
		}
		else
		{
			$this->session->set_flashdata('error', '用户名和密码不能为空!');
		}
		redirect('login');
	}

	/**
	 * 退出登陆
	 */
	public function login_out(){
		$this->session->sess_destroy();
		success('login/index','退出成功');
	}

}