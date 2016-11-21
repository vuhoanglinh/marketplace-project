<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function  __construct() {
        parent::__construct();		
	}
	
	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		= 	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Trang quản trị";

			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/main_view");
			$this->load->view("admincp/footer_view");
		}		
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}
	
	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		delete_cookie('id');
		delete_cookie('name');
		delete_cookie('username');
		delete_cookie('avatar');
		delete_cookie('group');	
		delete_cookie('status');	
		delete_cookie('base_url');	
		unset($_SESSION['base_url']);
		redirect(base_url("admincp/login"), "location");
	}
	
}

/* End of file index.php */
/* Location: ./application/controllers/admincp/index.php */