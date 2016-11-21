<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function  __construct() {
        parent::__construct();
		$this->load->Model("Users_model");
		if($this->session->userdata('logged_in'))
		{
			redirect(base_url("admincp"), "location");
		}
		else
		{			
			if(isset($_COOKIE['id']))
			{ 
				$sess_array 	 = array(
									'id' 	   => 	$_COOKIE['id'],
									'name'	   =>	$_COOKIE['name'],
									'username' => 	$_COOKIE['username'],
									'avatar'   => 	$_COOKIE['avatar'],
									'group'	   =>	$_COOKIE['group'],
									'status'   =>	$_COOKIE['status']
								);
				$_SESSION['base_url']	=	$_COOKIE['base_url'];
				$cookie_time	=	3600*24*30;				
				$this->input->set_cookie('id',$_COOKIE['id'],$cookie_time);
				$this->input->set_cookie('name',$_COOKIE['name'],$cookie_time);
				$this->input->set_cookie('username',$_COOKIE['username'],$cookie_time);
				$this->input->set_cookie('avatar',$_COOKIE['avatar'],$cookie_time);
				$this->input->set_cookie('group',$_COOKIE['group'],$cookie_time);
				$this->input->set_cookie('status' ,$_COOKIE['status'],$cookie_time);
				
				$this->session->set_userdata('logged_in',$sess_array);
				redirect(base_url("admincp"), "location");
			}
		}
	}
	
	public function index()
	{
		$data['titlepage'] = "Đăng nhập";
		$this->load->view("admincp/login_view",$data);		
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
    		$data['titlepage'] = "Đăng nhập";
			$this->load->view("admincp/login_view",$data);
		}
		else
		{			
			redirect(base_url("admincp"), "location");
		}
	}

	public function check_login()
	{
		//Field validation succeeded.  Validate against database
		$username = $this->input->post("uuser");
		$password = $this->input->post("upw");
		$code 	  =	$this->input->post("ucode");
		//query the database
		$result	  = $this->Users_model->getUserLogin($username,$password,$code);
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
				$this->input->set_cookie('id',$sess_array['id'],$cookie_time);
				$this->input->set_cookie('name',$sess_array['name'],$cookie_time);
				$this->input->set_cookie('username',$sess_array['username'],$cookie_time);
				$this->input->set_cookie('avatar',$sess_array['avatar' ],$cookie_time);
				$this->input->set_cookie('group',$sess_array['group'],$cookie_time);
				$this->input->set_cookie('status' ,$sess_array['status'],$cookie_time);
				$this->input->set_cookie('base_url' ,$_SESSION['base_url'],$cookie_time);
			}
			if($sess_array['status'] == 0)	
			{
				$this->form_validation->set_message('check_login', 'Unable to login. This acount has been banned.');
				return FALSE;
			}
			else
			{
				$this->session->set_userdata('logged_in',$sess_array);
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

/* End of file index.php */
/* Location: ./application/controllers/admincp/index.php */