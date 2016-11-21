<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {
	private $_limit = 10;
	public function  __construct() {
        parent::__construct();		
        $this->load->Model('Product_model');
        $this->load->Model('Product_images_model');
        $this->load->Model('Store_model');
        $this->load->Model('News_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_level'))
		{
			$session_data 		=	$this->session->userdata('logged_in_level');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage']	=	"Trang quản lý sản phẩm";						
			$data['numpro_not_active'] 	=	count($this->Product_model->getNotActive());
			$data['news_category'] 		=	$this->News_model->getList();

			$key 					=	"";
			if($this->input->get('key')) 
			{	
				$key 				=	$this->input->get('key');	
				$num_rows			=	$this->Product_model->getNotActive(0,0,0,$key);
			}				
			else
			{
				$num_rows			=	$this->Product_model->getNotActive();
			}

			$data['key'] 		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);
			$data['index']		=	0;
			$data['datestring'] = 	"%d/%m/%Y %h:%i";

			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view");
			$this->load->view("adminlevel/navigation_view",$datauser);
			$this->load->view("adminlevel/left_view",$data);
			$this->load->view("adminlevel/product/list_not_active_view",$data);
			$this->load->view("adminlevel/footer_view");
		}
		else
		{
			redirect(base_url("adminlevel/login"), "location");
		}
	}

	public function paggingnotative()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$data['datestring'] 	= 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
		$key 			=	"";
		$product 		= 	array();
		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));
			$product['view']=	$this->Product_model->getNotActiveLimit(0,$per_page,$this->_limit,0,0,$key);		
		}
		else
		{
			$product['view']=	$this->Product_model->getNotActiveLimit(0,$per_page,$this->_limit);
		}
				$count 			=	0;
				//Get View Product
					//Get images for Product
					foreach ($product['view']  as $row) {
						$query 							=	$this->Product_images_model->getImage1($row->id);
						$product['image'][$count] 		= 	"";
						foreach ($query as $key) {
							$product['image'][$count] = $key->image;
							if($key->image != "") {								
								break;
							}
						}

						$query 							=	$this->Store_model->getStoreById($row->id_store);
						$product['store'][$count] 		= 	"";
						foreach ($query as $key) {
							$product['store'][$count] = $key->name;
							break;
						}
						$count++;							
					}
		$data['product'] = $product;
		$this->load->view("adminlevel/product/ajax_list_view",$data);
	}

	public function productactive()
	{
		if($this->session->userdata('logged_in_level'))
		{
			$session_data 		=	$this->session->userdata('logged_in_level');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage']	=	"Trang quản lý sản phẩm";						
			$data['numpro_not_active'] 	=	count($this->Product_model->getNotActive());
			$data['news_category'] 		=	$this->News_model->getList();

			$type = 0;

			$home 					=	"";
			if($this->input->get('home')){
				$home				=	$this->input->get('home');
			}

			if($home != ""){
				$type 				=	8; //8 == get by home
			}

			$data['home']			=	$home;
			$key 					=	"";
			if($this->input->get('key')) 
			{	
				$key 				=	$this->input->get('key');	
				$num_rows			=	$this->Product_model->getActive($type,0,0,0,$key);
			}				
			else
			{
				$num_rows			=	$this->Product_model->getActive($type);
			}

			$data['key'] 		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);
			$data['index']		=	0;
			$data['datestring'] = 	"%d/%m/%Y %h:%i";

			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view");
			$this->load->view("adminlevel/navigation_view",$datauser);
			$this->load->view("adminlevel/left_view",$data);
			$this->load->view("adminlevel/product/list_view",$data);
			$this->load->view("adminlevel/footer_view");
		}
		else
		{
			redirect(base_url("adminlevel/login"), "location");
		}
	}

	public function paggingactive()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$data['datestring'] 	= 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
		$key 			=	"";
		$product 		= 	array();

		$type = 0;

			$home 					=	"";
			if($this->input->post('home')){
				$home				=	$this->input->post('home');
			}

			if($home != ""){
				$type 				=	8; //8 == get by home
			}

		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));
			$product['view']=	$this->Product_model->getActiveLimit($type,0,$per_page,$this->_limit,0,0,$key);		
		}
		else
		{
			$product['view']=	$this->Product_model->getActiveLimit($type,0,$per_page,$this->_limit);
		}
				$count 			=	0;
				//Get View Product
					//Get images for Product
					foreach ($product['view']  as $row) {
						$query 							=	$this->Product_images_model->getImage1($row->id);
						$product['image'][$count] 		= 	"";
						foreach ($query as $key) {
							$product['image'][$count] = $key->image;
							if($key->image != "") {								
								break;
							}
						}

						$query 							=	$this->Store_model->getStoreById($row->id_store);
						$product['store'][$count] 		= 	"";
						foreach ($query as $key) {
							$product['store'][$count] = $key->name;
							break;
						}
						$count++;							
					}
		$data['product'] = $product;
		$this->load->view("adminlevel/product/ajax_list_active_view",$data);
	}

	public function active()
	{
		$stt = "";
		$msg = "";

		$id  =	$this->input->post('id');
		$arrayName = array('active' => 1);

		$stt = "1";
		$msg =	"Sản phẩm xác thực thất bại!";

		if($this->Product_model->update($arrayName,$id)) {
			$stt = "0";
			$msg =	"Sản phẩm đã xác thực.";
		}

		echo json_encode(array('status' => $stt, 'msg' => $msg ));
	}

	public function home()
	{
		$stt = "";
		$msg = "";

		$id  		=	$this->input->post('id');		
		$status  	= 	$this->input->post('status');
		$arrayName 	= array('home' => $status);

		$stt = "1";
		$msg =	"Sản phẩm xác thực thất bại!";

		if($this->Product_model->update($arrayName,$id)) {
			$stt = "0";
			$msg =	"Sản phẩm đã xác thực.";
		}

		echo json_encode(array('info' => $stt, 'msg' => $msg,'status' => $status));
	}
	
}