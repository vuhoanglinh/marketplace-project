<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function  __construct() {
        parent::__construct();	        
        $this->load->Model('Store_contact_model');	
        $this->load->Model('Store_model');	
	}

	public function index()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Trang chủ";
			$session_data 		= 	$this->session->userdata('logged_store');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$id_store 			=	$session_data['id'];
			//Get category by store
				$stcatgory				=	array();			
				$stcatgory['parent']	=	$this->Store_category_model->getParent($id_store);
				$count 					=	0;
				$dataleft['count']		=	0;
				$stcatgory['child']		=	array();
				$temp 					=	$stcatgory['parent'];
				foreach ($temp as $row) {
					$id_parent 			=	$row->id;
					$stcatgory['child'][$count] 	=	$this->Store_category_model->getChild($id_parent);
					$count++;
				}
				$dataleft['result']		=	$stcatgory;
				$dataleft['num_ct']		=	count($this->Store_category_model->getParent($id_store));

			$data['id_store']			=	$id_store;
			$namestore 					=	"";
			$query 						=	$this->Store_model->getStoreById($id_store);
			foreach ($query  as $row) {
					$namestore	= 	$row->name;
			}
			$data['name_store']	= 	$namestore;
			$data['num_contact']		=	count($this->Store_contact_model->getList1($id_store));
			$dataleft['num_contact']	=	$data['num_contact'];
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/ckfinder_view");
			$this->load->view("admincp/endhead_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/main_view",$data);
			$this->load->view("stores/footer_view");
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_store');
		delete_cookie('id');
		delete_cookie('code');
		delete_cookie('name');
		delete_cookie('title');
		delete_cookie('username');
		delete_cookie('avatar');	
		delete_cookie('status');	
		delete_cookie('base_url');	
		unset($_SESSION['base_url']);
		redirect(base_url("stores/login"), "location");
	}
}