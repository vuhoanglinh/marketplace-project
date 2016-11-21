<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function  __construct() {
        parent::__construct();	
        $this->load->Model("Users_model");	
        if($this->session->userdata('logged_in_level'))
		{
			redirect(base_url("adminlevel"), "location");
		}
		else
		{			
			if(isset($_COOKIE['id_level']))
			{ 
				$sess_array 	 = array(
									'id' 	   => 	$_COOKIE['id_level'],
									'name'	   =>	$_COOKIE['name_level'],
									'username' => 	$_COOKIE['username_level'],
									'avatar'   => 	$_COOKIE['avatar_level'],
									'group'	   =>	$_COOKIE['group_level'],
									'status'   =>	$_COOKIE['status_level']
								);
				$_SESSION['base_url']	=	$_COOKIE['base_url_level'];
				$cookie_time	=	3600*24*30;				
				$this->input->set_cookie('id_level',$_COOKIE['id_level'],$cookie_time);
				$this->input->set_cookie('name_level',$_COOKIE['name_level'],$cookie_time);
				$this->input->set_cookie('username_level',$_COOKIE['username_level'],$cookie_time);
				$this->input->set_cookie('avatar_level',$_COOKIE['avatar_level'],$cookie_time);
				$this->input->set_cookie('group_level',$_COOKIE['group_level'],$cookie_time);
				$this->input->set_cookie('status_level' ,$_COOKIE['status_level'],$cookie_time);
				
				$this->session->set_userdata('logged_in_level',$sess_array);
				redirect(base_url("adminlevel"), "location");
			}

			if($this->session->userdata('logged_in'))
			{
				$session_data 	 =	$this->session->userdata('logged_in');
				$sess_array 	 = array(
									'id' 	   => 	$session_data['id'],
									'name'	   =>	$session_data['name'],
									'username' => 	$session_data['username'],
									'avatar'   => 	$session_data['avatar'],
									'group'	   =>	$session_data['group'],
									'status'   =>	$session_data['status']
								);

				$this->session->set_userdata('logged_in_level',$sess_array);
				redirect(base_url("adminlevel"), "location");
			}
		}
	}

	public function index()
	{
		$data['titlepage']	=	"Đăng nhập trang quản lý";		
		$this->load->view("admincp/head_view",$data);
		$this->load->view("admincp/endhead_view");
		$this->load->view("adminlevel/login_view");
	}

	public function signin()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('uuser','Username"','trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('upw','Password"','trim|required|xss_clean');
		$this->form_validation->set_rules('ucode','Code"','trim|required|xss_clean|min_length[3]|callback_check_login');
		if ($this->form_validation->run() == FALSE)
		{
			//Field validation failed.  User redirected to login page
    		$data['titlepage']	=	"Đăng nhập trang quản lý";		
			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view");
			$this->load->view("adminlevel/login_view",$data);
		}
		else
		{			
			redirect(base_url("adminlevel"), "location");
		}
	}

	public function check_login()
	{
		//Field validation succeeded.  Validate against database
		$username = $this->input->post("uuser");
		$password = $this->input->post("upw");
		$code 	  =	$this->input->post("ucode");
		//query the database
		$result	  = $this->Users_model->getUserLoginLevel($username,$password,$code);
		if($result)
		{
			$sess_array = array();
			foreach ($result as $row) 
			{
				
				$sess_array = array(
					'id' 	   => 	$row->id,
					'name'	   =>	$row->name,
					'username' => 	$row->username,
					'avatar'   => 	$row->avatar,
					'group'	   =>	$row->group,
					'status'   =>	$row->status,
				);	
				$path	=	base_url('public/upload/ckfinder').'/';		
				$_SESSION['base_url']	=	$path;			
			}

			if($this->input->post('remember') == "1") {
				
				$cookie_time	=	3600*24*30;				
				$this->input->set_cookie('id_level',$sess_array['id'],$cookie_time);
				$this->input->set_cookie('name_level',$sess_array['name'],$cookie_time);
				$this->input->set_cookie('username_level',$sess_array['username'],$cookie_time);
				$this->input->set_cookie('avatar_level',$sess_array['avatar' ],$cookie_time);
				$this->input->set_cookie('group_level',$sess_array['group'],$cookie_time);
				$this->input->set_cookie('status_level' ,$sess_array['status'],$cookie_time);
				$this->input->set_cookie('base_url_level' ,$_SESSION['base_url'],$cookie_time);
			}

			if($sess_array['status'] == 0)	
			{
				$this->form_validation->set_message('check_login', 'Unable to login. This acount has been banned.');
				return FALSE;
			}
			else
			{
				$this->session->set_userdata('logged_in_level',$sess_array);
			}
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_login', 'Security Password you entered is not correct');
			return FALSE;
		}
	}

}