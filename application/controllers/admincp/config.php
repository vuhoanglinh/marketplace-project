<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->Model("Config_model");		
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		= 	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar']	= 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Trang cấu hình website";	
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view",$data);	
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);			
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function systems()
	{
		if($this->session->userdata('logged_in'))
		{
			//GET SESSION
			$session_data 		= 	$this->session->userdata('logged_in'); 
			$datauser['name'] 	= 	$session_data['name']; //Set name For User
			$datauser['avatar']	= 	$session_data['avatar']; //Set Avartar For User

			//Title Page Administrator
			$data['titlepage'] 	= 	"Trang cấu hình hệ thống website";	

			//Result Website Systems 		
			$result			 	= 	$this->Config_model->getSystem();	
			foreach ($result as $row) 
			{
				$data['charset']  			= 	$row->name; 
				$data['favicon']  			= 	$row->favicon; 
				$data['logo']  				= 	$row->images; 
				$data['item']  				= 	$row->title; 
				$data['email']  			= 	$row->email; 
				$data['hotline']  			= 	$row->hotline; 
				$data['slogan']  			= 	$row->description; 
				$data['footer']  			= 	$row->extention; 
			}	
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			//Load View HTML	
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/ckeditor_view");
			$this->load->view("js/elfinder_view");	
			$this->load->view("js/bootbox_view");	
			$this->load->view("admincp/endhead_view");	
			$this->load->view("controls/modals_view");	
			$this->load->view("admincp/navigation_view",$datauser);						
			$this->load->view("admincp/left_view",$data);	
			$this->load->view("admincp/config/systems_view",$data);					
			$this->load->view("admincp/footer_view");			
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}	

	public function file()
	{
		if($this->session->userdata('logged_in'))
		{
			
    
			//GET SESSION
			$session_data 		= 	$this->session->userdata('logged_in'); 
			$datauser['name']	= 	$session_data['name']; //Set name For User
			$datauser['avatar']	= 	$session_data['avatar']; //Set Avartar For User

			//Title Page Administrator
			$data['titlepage'] 	= 	"Trang quản lý file";				
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			//Load View HTML	
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/elfinder_view",$data);
			$this->load->view("admincp/endhead_view",$data);	
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);					
			$this->load->view("admincp/config/filemanager_view",$data);					
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}
	public function seo()
	{
		if($this->session->userdata('logged_in'))
		{
			//GET SESSION
			$session_data 		= 	$this->session->userdata('logged_in'); 
			$datauser['name'] 	= 	$session_data['name']; //Set name For User
			$datauser['avatar']	= 	$session_data['avatar']; //Set Avartar For User

			//Title Page Administrator
			$data['titlepage'] 	= 	"Trang cấu hình SEO";	

			//Result SEO Home		
			$result			 	= 	$this->Config_model->getSeo('home');	
			foreach ($result as $row) 
			{
				$data['titlehome']  		= 	$row->name; //Query Title Page
				$data['keywordhome']  		= 	$row->keyword; //Query Tab Meta Keyword
				$data['descriptionhome']  	= 	$row->description; //Query Tab Meta Description
				$data['extentionhome']  	= 	$row->extention; //Query Tab Meta Extention
			}	

			//Result SEO Products
			$result			 	= 	$this->Config_model->getSeo('product');	
			foreach ($result as $row) 
			{
				$data['titleproduct']  			= 	$row->name; //Query Title Page
				$data['keywordproduct']  		= 	$row->keyword; //Query Tab Meta Keyword
				$data['descriptionproduct']  	= 	$row->description; //Query Tab Meta Description
				$data['extentionproduct']  		= 	$row->extention; //Query Tab Meta Extention
			}	

			//Result SEO News
			$result			 	= 	$this->Config_model->getSeo('news');	
			foreach ($result as $row) 
			{
				$data['titlenews']  		= 	$row->name; //Query Title Page
				$data['keywordnews']  		= 	$row->keyword; //Query Tab Meta Keyword
				$data['descriptionnews']  	= 	$row->description; //Query Tab Meta Description
				$data['extentionnews']  	= 	$row->extention; //Query Tab Meta Extention
			}	

			//Result SEO Partner
			$result			 	= 	$this->Config_model->getSeo('partner');	
			foreach ($result as $row) 
			{
				$data['titlepartner']  			= 	$row->name; //Query Title Page
				$data['keywordpartner']  		= 	$row->keyword; //Query Tab Meta Keyword
				$data['descriptionpartner']  	= 	$row->description; //Query Tab Meta Description
				$data['extentionpartner']  		= 	$row->extention; //Query Tab Meta Extention
			}	

			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			//Load View HTML		
			$this->load->view("admincp/head_view",$data);	
			$this->load->view("js/bootbox_view");		
			$this->load->view("admincp/endhead_view",$data);	
			$this->load->view("controls/modals_view");	
			$this->load->view("admincp/navigation_view",$datauser);			
			$this->load->view("admincp/left_view",$data);	
			$this->load->view("admincp/config/seo_view",$data);					
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}
	public function editseohome()
	{
		//Load Library form_validation of Codeigniter
		$this->load->library('form_validation');

		//Set rules for input
		$this->form_validation->set_rules('txtTitlePageHome','TitlePageHome','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtKeywordHome','KeywordHome','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtDescriptionHome','DescriptionHome','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtExtentionHome','ExtentionHome','trim'); //Call Function updateSeoConfig
		if($this->form_validation->run() == FALSE) {
			echo "Dữ liệu đầu vào không hợp lệ!";
		}
		else {
			$name			= 	$this->input->post('txtTitlePageHome');
			$keyword		= 	$this->input->post('txtKeywordHome');
			$description	= 	$this->input->post('txtDescriptionHome');
			$extention		= 	$this->input->post('txtExtentionHome');
			if($this->Config_model->uploadSeo('home',$name,$keyword,$description,$extention)) {
				echo "Các thông tin đã được cập nhật thành công";				
			}
			else {
				echo "Lỗi không thể cập nhật dữ liệu";
			}			
				
		}		
	}


	public function editseoproduct()
	{
		//Load Library form_validation of Codeigniter
		$this->load->library('form_validation');

		//Set rules for input
		$this->form_validation->set_rules('txtTitlePageProduct','TitlePageProduct','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtKeywordProduct','KeywordProduct','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtDescriptionProduct','DescriptionProduct','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtExtentionProduct','ExtentionProduct','trim'); 
		if($this->form_validation->run() == FALSE) {
			echo "Dữ liệu đầu vào không hợp lệ!";
		}
		else {	
			$name			= 	$this->input->post('txtTitlePageProduct');
			$keyword		= 	$this->input->post('txtKeywordProduct');
			$description	= 	$this->input->post('txtDescriptionProduct');
			$extention		= 	$this->input->post('txtExtentionProduct');
			if($this->Config_model->uploadSeo('product',$name,$keyword,$description,$extention)) {
				echo "Các thông tin đã được cập nhật thành công";			
			}
			else {
				echo "Lỗi không thể cập nhật dữ liệu";
			}		
			
		}		
	}	

	public function editseonews()
	{
		//Load Library form_validation of Codeigniter
		$this->load->library('form_validation');

		//Set rules for input
		$this->form_validation->set_rules('txtTitlePageNews','TitlePageNews','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtKeywordNews','KeywordNews','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtDescriptionNews','DescriptionNews','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtExtentionNews','ExtentionNews','trim'); 
		if($this->form_validation->run() == FALSE) {
			echo "Dữ liệu đầu vào không hợp lệ!";
		}
		else {
			$name			= 	$this->input->post('txtTitlePageNews');
			$keyword		= 	$this->input->post('txtKeywordNews');
			$description	= 	$this->input->post('txtDescriptionNews');
			$extention		= 	$this->input->post('txtExtentionNews');
			if($this->Config_model->uploadSeo('news',$name,$keyword,$description,$extention)) {
				echo "Các thông tin đã được cập nhật thành công";				
			}
			else {
				echo "Lỗi không thể cập nhật dữ liệu";
			}			
			
		}		
	}

	public function editseopartner()
	{
		//Load Library form_validation of Codeigniter
		$this->load->library('form_validation');

		//Set rules for input
		$this->form_validation->set_rules('txtTitlePagePartner','TitlePagePartner','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtKeywordPartner','KeywordPartner','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtDescriptionPartner','DescriptionPartner','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtExtentionPartner','ExtentionPartner','trim'); 
		if($this->form_validation->run() == FALSE) {
			echo "Dữ liệu đầu vào không hợp lệ!";
		}
		else {	
			$name			= 	$this->input->post('txtTitlePagePartner');
			$keyword		= 	$this->input->post('txtKeywordPartner');
			$description	= 	$this->input->post('txtDescriptionPartner');
			$extention		= 	$this->input->post('txtExtentionPartner');
			if($this->Config_model->uploadSeo('partner',$name,$keyword,$description,$extention)) {
				echo "Các thông tin đã được cập nhật thành công";				
			}
			else {
				echo "Lỗi không thể cập nhật dữ liệu";
			}		
			
		}		
	}

	public function editweb()
	{
		//Load Library form_validation of Codeigniter
		$this->load->library('form_validation');

		//Set rules for input
		$this->form_validation->set_rules('txtCharset','Charset','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtFavicon','Favicon','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtLogo','Logo','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtItem','Item','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtHotline','Hotline','trim|max_leng[45]|xss_clean');
		$this->form_validation->set_rules('txtEmail','Email','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtSlogan','Slogan','trim|max_leng[255]|xss_clean');
		$this->form_validation->set_rules('txtFooter','Footer','trim');
		if($this->form_validation->run() == FALSE) {
			echo "Dữ liệu đầu vào không hợp lệ!";
		}
		else {		
			$datestring         =   "%Y/%m/%d %h:%i:%s";
	        $last_modified      =   mdate($datestring, time());
	        $arrayName 			= array(
	        						'name' 			=> $this->input->post('txtCharset'), 
	        						'title' 		=> $this->input->post('txtItem'),
	        						'images' 		=> $this->input->post('txtLogo'), 
	        						'favicon' 		=> $this->input->post('txtFavicon'),
	        						'hotline' 		=> $this->input->post('txtHotline'),
	        						'email' 		=> $this->input->post('txtEmail'), 
	        						'description' 	=> $this->input->post('txtSlogan'),
	        						'extention' 	=> $this->input->post('txtFooter'),
	        						'last_modified'	=> $last_modified 
	        					);

			if($this->Config_model->uploadSystem($arrayName)) {
				echo "Các thông tin đã được cập nhật thành công";				
			}
			else {
				echo "Lỗi không thể cập nhật dữ liệu";
			}	
			
		}		
	}

}