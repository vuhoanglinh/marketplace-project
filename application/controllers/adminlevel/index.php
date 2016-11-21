<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function  __construct() {
        parent::__construct();		
        $this->load->Model('Product_model');
        $this->load->Model('News_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_level'))
		{
			$session_data 		=	$this->session->userdata('logged_in_level');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage']	=	"Trang chủ quản lý nội dung";			
			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view");
			$this->load->view("adminlevel/navigation_view",$datauser);
			$data['numpro_not_active'] 	=	count($this->Product_model->getNotActive());
			$data['news_category'] 		=	$this->News_model->getList();
			$this->load->view("adminlevel/left_view",$data);
			$this->load->view("adminlevel/main_view",$data);
			$this->load->view("adminlevel/footer_view");
		}
		else
		{
			redirect(base_url("adminlevel/login"), "location");
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in_level');
		delete_cookie('id_level');
		delete_cookie('name_level');
		delete_cookie('username_level');
		delete_cookie('avatar_level');
		delete_cookie('group_level');	
		delete_cookie('status_level');	
		delete_cookie('base_url_level');	
		unset($_SESSION['base_url']);
		redirect(base_url("adminlevel/login"), "location");
	}

}