<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
	private $_limit 	=	10;
	public function __construct() {
		parent::__construct();	
		$this->load->Model('News_model');
	}

	public function index()
	{

	}

	public function add()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Thêm danh mục tin tức";
			
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();	
					
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");			
			$this->load->view("js/elfinder_view");	
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/news/add_view");
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function addNews()
	{
		$this->load->library('form_validation');
	}

	public function checkcode()
	{
		$echo 		=	"0";
		$code 		=	$this->input->post('code');
		$id			=	$this->input->post('id');
		if($name != "") 
		{
			if($this->News_model->getCodeName($code,$id))
			{
				$echo = "1";
			}			
		}
		echo $echo;
	}

	public function checkname()
	{
		$echo 		=	"0";
		$name 		=	$this->input->post('name');
		$id			=	$this->input->post('id');
		if($name != "") 
		{
			if($this->News_model->getName($name,$id))
			{
				$echo = "1";
			}			
		}
		echo $echo;
	}

	public function checktitle()
	{
		$echo 	=	"0";
		$title	=	$this->input->post('title');	
		$id		=	$this->input->post('id');	
		if($title != "") 
		{
			if($this->News_model->getTitle($title,$id))
			{
				$echo = "1";
			}
		}
		echo $echo;
	}
}