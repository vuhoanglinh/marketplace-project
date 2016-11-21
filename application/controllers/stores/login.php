<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function  __construct() {
        parent::__construct();	
        $this->load->Model('Store_model');
        if($this->session->userdata('logged_store'))
		{
			redirect(base_url("stores"), "location");
		}
		else
		{			
			if(isset($_COOKIE['id_store']))
			{ 
				$sess_array = array(
					'id' 	   => 	$_COOKIE['id_store'],
					'code' 	   => 	$_COOKIE['code_store'],
					'name'	   =>	$_COOKIE['name_store'],
					'title'	   =>	$_COOKIE['title_store'],
					'username' => 	$_COOKIE['username_store'],
					'avatar'   => 	$_COOKIE['avatar_store'],
					'status'   =>	$_COOKIE['status_store'],
				);
				$_SESSION['base_url']  =  $_COOKIE['base_url_store'];

				$cookie_time	=	3600*24*30;				
				$this->input->set_cookie('id_store',$sess_array['id'],$cookie_time);
				$this->input->set_cookie('code_store',$sess_array['code'],$cookie_time);
				$this->input->set_cookie('name_store',$sess_array['name'],$cookie_time);
				$this->input->set_cookie('title_store',$sess_array['title'],$cookie_time);
				$this->input->set_cookie('username_store',$sess_array['username'],$cookie_time);
				$this->input->set_cookie('avatar_store',$sess_array['avatar' ],$cookie_time);				
				$this->input->set_cookie('status_store' ,$sess_array['status'],$cookie_time);
				$this->session->set_userdata('logged_store',$sess_array);
				redirect(base_url("stores"), "location");
			}
		}
	}

	public function index()
	{
		$data['titlepage']	=	"Đăng nhập cửa hàng";
		$this->load->view("admincp/head_view",$data);
		$this->load->view("js/validation_view");
		$this->load->view("admincp/endhead_view");	
		$this->load->view("stores/login_view",$data);
	}

	public function signin()
	{		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('uuser','Username"','trim|required|xss_clean');
		$this->form_validation->set_rules('upw','Password"','trim|required|xss_clean');
		$this->form_validation->set_rules('ucode','Code"','trim|required|xss_clean|min_length[3]|callback_check_login');
		if ($this->form_validation->run() == FALSE)
		{
			$data['titlepage']	=	"Đăng nhập cửa hàng";
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/validation_view");
			$this->load->view("admincp/endhead_view");	
			$this->load->view("stores/login_view",$data);
		}
		else
		{			
			redirect(base_url("stores"), "location");
		}
	}
	
	public function check_login()
	{
		//Field validation succeeded.  Validate against database
		$username = $this->input->post("uuser");
		$password = $this->input->post("upw");
		$code 	  =	$this->input->post("ucode");
		//query the database
		$result	  = $this->Store_model->getUserLogin($username,$password,$code);
		if($result)
		{
			$sess_array = array();
			foreach ($result as $row) 
			{
				# code...
				
				$sess_array = array(
					'id' 	   => 	$row->id,
					'code' 	   => 	$row->code,
					'name'	   =>	$row->name_contact,
					'title'	   =>	$row->title,
					'username' => 	$row->username,
					'avatar'   => 	$row->logohome,
					'status'   =>	$row->status,
				);	
				$path	=	base_url('public/upload/store').'/'.$row->title.'/';		
				$_SESSION['base_url']	=	$path;			
			}

			if($this->input->post('remember') == "1") {
				
				$cookie_time	=	3600*24*30;				
				$this->input->set_cookie('id_store',$sess_array['id'],$cookie_time);
				$this->input->set_cookie('code_store',$sess_array['code'],$cookie_time);
				$this->input->set_cookie('name_store',$sess_array['name'],$cookie_time);
				$this->input->set_cookie('title_store',$sess_array['title'],$cookie_time);
				$this->input->set_cookie('username_store',$sess_array['username'],$cookie_time);
				$this->input->set_cookie('avatar_store',$sess_array['avatar' ],$cookie_time);				
				$this->input->set_cookie('status_store' ,$sess_array['status'],$cookie_time);
				$this->input->set_cookie('base_url_store' ,$_SESSION['base_url'],$cookie_time);
			}
			if($sess_array['status'] == 0)	
			{
				$this->form_validation->set_message('check_login', 'Không thể đăng nhập. Cửa hàng của bạn đã bị cấm!');
				return FALSE;
			}
			else
			{
				$this->session->set_userdata('logged_store',$sess_array);
			}
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_login', 'Đăng nhập thất bại. Vui lòng kiểm tra lại.');
			return FALSE;
		}
	}
}
