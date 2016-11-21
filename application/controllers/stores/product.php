<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {
	private $_limit 	=	10;
	public function  __construct() {
        parent::__construct();		
        $this->load->Model('Product_model');
        $this->load->Model('Product_images_model');
        $this->load->Model('Product_attribute_model');
        $this->load->Model('Product_meta_model');
        $this->load->Model('Category_model');
        $this->load->Model('Store_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Danh sách sản phẩm";
			$session_data 		= 	$this->session->userdata('logged_store');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$id_store 			=	$session_data['id'];
			$data['id_store']	=	$id_store;
			
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
				$dataleft['num_contact']		=	count($this->Store_contact_model->getList1($id_store));
			$id  = "";
			$key = "";
			if($this->input->get('idct')) {				
				$id 			=	$this->input->get('idct');	
				//Get Store Category
	        	$query 				=	$this->Store_category_model->getCategoryById($id);
	        	foreach($query as $row)
	        	{
	          		$data['namect']   		=   $row->name;
	        	}

				if($this->input->get('key')) {				
					$key 				=	$this->input->get('key');	
					$num_rows			=	$this->Product_model->getListKeyBySTCategory($id,$key);
				}
				else {
					$num_rows			=	$this->Product_model->getListBySTCategory($id);
				}
			}
			else {
				if($this->input->get('key')) {				
					$key 				=	$this->input->get('key');	
					$num_rows			=	$this->Product_model->getListKey($id_store,$key);
				}
				else {
					$num_rows			=	$this->Product_model->getList($id_store);
				}
			}
			$data['id']			=	$id;
			$data['key'] 		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);
			
			
			$data['index']		=	0;
			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			if($dataleft['num_ct'] > 0) {
				$this->load->view("stores/product/list_view",$data);
			}
			else {
				$this->load->view("stores/product/redirect_view");
			}
			$this->load->view("stores/footer_view");
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function pagging_list()
	{
		$start 					=	$this->input->post('page');
		$id_store				=	$this->input->post('id_store');
		$query 					=	$this->Store_model->getStoreById($id_store);
		$name_store 			=	"";
		foreach ($query as $row) {
			$name_store 		=	$row->name;
		}
		$data['name_store']		=	$name_store;
		$data['id_store']		=	$id_store;

		$per_page				=	$start * $this->_limit;
		$data['datestring'] 	= 	"%d/%m/%Y %h:%i";
		$data['index']		=	0;
			if($this->input->post('idct') != "") {				
				$id 			=	$this->input->post('idct');	
				if($this->input->post('key') != "") {				
					$key 				=	$this->input->post('key');	
					$data['query']		=	$this->Product_model->getListKeyLimitBySTCategory($id,$key,$per_page,$this->_limit);
				}
				else {
					$data['query']		=	$this->Product_model->getListLimitBySTCategory($id,$per_page,$this->_limit);
				}
			}
			else {
				if($this->input->post('key') != "") {				
					$key 				=	$this->input->post('key');	
					$data['query']		=	$this->Product_model->getListKeyLimit($id_store,$key,$per_page,$this->_limit);
				}
				else {
					$data['query']		=	$this->Product_model->getListLimit($id_store,$per_page,$this->_limit);
				}
			}
					
		$this->load->view('stores/product/ajax_list_view',$data);
	}

	public function trash()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Danh sách sản phẩm đã xóa";
			$session_data 		= 	$this->session->userdata('logged_store');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$id_store 			=	$session_data['id'];
			$data['id_store']	=	$id_store;
			
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
				$dataleft['num_contact']		=	count($this->Store_contact_model->getList1($id_store));
			$id  = "";
			$key = "";
				if($this->input->get('key')) {				
					$key 				=	$this->input->get('key');	
					$num_rows			=	$this->Product_model->getListKey($id_store,$key,0);
				}
				else {
					$num_rows			=	$this->Product_model->getList($id_store,0);
				}			
			$data['id']			=	$id;
			$data['key'] 		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);
			
			
			$data['index']		=	0;
			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			if($dataleft['num_ct'] > 0) {
				$this->load->view("stores/product/trash_view",$data);
			}
			else {
				$this->load->view("stores/product/redirect_view");
			}
			$this->load->view("stores/footer_view");
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function pagging_trash()
	{
		$start 					=	$this->input->post('page');
		$id_store				=	$this->input->post('id_store');
		$query 					=	$this->Store_model->getStoreById($id_store);
		$name_store 			=	"";
		foreach ($query as $row) {
			$name_store 		=	$row->name;
		}
		$data['name_store']		=	$name_store;
		$data['id_store']		=	$id_store;
		
		$per_page				=	$start * $this->_limit;
		$data['datestring'] 	= 	"%d/%m/%Y %h:%i";
		$data['index']		=	0;
			
				if($this->input->post('key') != "") {				
					$key 				=	$this->input->post('key');	
					$data['query']		=	$this->Product_model->getListKeyLimit($id_store,$key,$per_page,$this->_limit,0);
				}
				else {
					$data['query']		=	$this->Product_model->getListLimit($id_store,$per_page,$this->_limit,0);
				}
			
					
		$this->load->view('stores/product/ajax_trash_view',$data);
	}

	public function add()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Thêm mới sản phẩm";
			$session_data 		= 	$this->session->userdata('logged_store');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$id_store 			=	$session_data['id'];
			$data['id_store']	=	$id_store;

			$idct 	=	"";
			if($this->input->get('idct')) {
				$idct 			=	$this->input->get('idct');
				$result 	=	$this->Store_category_model->getCategoryById($idct);
					foreach ($result as $key) {
						$data['namect']	=	$key->name;
						break;
					}
			}
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
				$dataleft['num_contact']		=	count($this->Store_contact_model->getList1($id_store));
			
			$data['index'] 		= 	0;			
			$data['result'] 	= 	$dataleft['result'];
			$data['idct']		=	$idct;

			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");
			$this->load->view("js/ckeditor_view");
			$this->load->view("admincp/endhead_view");
			$this->load->view("controls/modals_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			if($dataleft['num_ct'] > 0)
				$this->load->view("stores/product/add_view",$data);
			else {
				$this->load->view("stores/product/redirect_view");
			}
			$this->load->view("stores/footer_view");
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function update()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Chỉnh sửa sản phẩm";
			$session_data 		= 	$this->session->userdata('logged_store');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$id_store 			=	$session_data['id'];
			$data['id_store']	=	$id_store;

			$idct 	=	"";
			if($this->input->get('id')) {
				$id 			=	$this->input->get('id');
				$data['id'] 	=	$id;
				//Get ID
				$query 			=	$this->Product_model->getListById($id);
				foreach($query as $row)
        		{
        			$data['name']		=	$row->name;
        			$data['title']		=	$row->title;
        			$data['price']		=	$row->price;
        			$data['s_price']	=	$row->s_price;
        			$data['amount']		=	$row->amount;
        			$data['idct'] 		=	$row->id_store_category;
        			$data['type']		=	$row->type;
        			$data['keyword']	=	$row->keyword;
        			$data['description']=	$row->description;
        			$data['detail']		=	$row->detail;
        			$data['content']	=	$row->content;
        			$data['status']		=	$row->status;
        		}

				$result 	=	$this->Store_category_model->getCategoryById($data['idct']);
					foreach ($result as $key) {
						$data['namect']	=	$key->name;
						break;
					}
				
				

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
					$dataleft['num_contact']		=	count($this->Store_contact_model->getList1($id_store));
				
				$data['index'] 		= 	0;			
				$data['result'] 	= 	$dataleft['result'];

				$this->load->view("admincp/head_view",$data);
				$this->load->view("js/bootbox_view");
				$this->load->view("js/ckeditor_view");
				$this->load->view("admincp/endhead_view");
				$this->load->view("controls/modals_view");
				$this->load->view("stores/navigation_view",$datauser);
				$this->load->view("stores/left_view",$dataleft);
				if($dataleft['num_ct'] > 0)
				$this->load->view("stores/product/update_view",$data);
				else {
					$this->load->view("stores/product/redirect_view");
				}
				$this->load->view("stores/footer_view");
			}
			else
			{
				redirect(base_url("stores/login"), "location");
			}
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function addProduct()
	{
		$stt = "";
		$msg = "";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtName','Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtNameSub','Title', 'trim|required|xss_clean|callback_checkbefore');
		$this->form_validation->set_rules('txtAmount','Amount', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('txtPrice','Price', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('txtNewPrice','Sales', 'trim|required|numeric|xss_clean|');

		if($this->form_validation->run() == FALSE){
			$stt 	=	"1";
			$msg 	= 	"Dữ liệu đầu vào không hợp lệ!";
		}
		else
		{
			//Get ID
			$query 			=	$this->Product_model->getId();
			foreach($query as $row)
        	{
          		$id   =   ($row->id != "") ? $row->id : 1;
        	}

			$datestring         =   "%Y/%m/%d %h:%i:%s";
			$data_added			=	mdate($datestring, time() - 60*60);
	        $last_modified      =   mdate($datestring, time() - 60*60);
			$name 				=	$this->input->post('txtName');	
			$title				=	$this->input->post('txtNameSub');
			$idct 				=	$this->input->post('slMain');
			$code 				=	"C".str_pad($id,11,"0", STR_PAD_LEFT);
			$amount 			=	$this->input->post('txtAmount');
			$price 				=	$this->input->post('txtPrice');
			$s_price 			=	$this->input->post('txtNewPrice');
			$type 				=	$this->input->post('rdType');
			$keyword 			=	$this->input->post('txtKeyword');
			$description 		=	$this->input->post('txtDescription');
			$detail				=	$this->input->post('txtDetail');
			$content			=	$this->input->post('txtContent');
			$status				=	$this->input->post('slStatus');	
			$id_store 			=	$this->input->post('hd_store');	
			
			//$idcate 	=	0;
			//$idctp 		=	0;
        	//Get Store Category
        	$query 				=	$this->Store_category_model->getCategoryById($idct);
        	foreach($query as $row)
        	{
          		$idctp   		=   ($row->id_parent != 0) ? $row->id_parent : $row->id;
          		$idcate 		=	$row->id_category;
        	}
        	//$idcatep 			=	0;
        	$query 				=	$this->Category_model->getCategoryById($idcate);
        	foreach($query as $row)
        	{
          		$idcatep 		=	$row->id_parent;
        	}


			$arrayName 			= 	array(
									'id_category_parent'		=>		$idcatep,
									'id_category'				=>		$idcate,
									'id_store_category_parent'	=>		$idctp,
									'id_store_category'			=>		$idct,
									'id_store'					=>		$id_store,
									'code'						=> 		$code, 
									'name'						=>		$name,
									'title'						=>		$title,
									'amount'					=>		$amount,
									'price'						=>		$price,
									's_price'					=>		$s_price,
									'type'						=>		$type,
									'keyword'					=>		$keyword,
									'description'				=>		$description,
									'detail'					=>		$detail,
									'content'					=>		$content,
									'status'					=>		$status,
									'date_added'				=>		$data_added,
									'last_modified'				=>		$last_modified
								);
			$stt 			= 	"1";
			$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
			if($this->Product_model->insert($arrayName))
			{
				$stt 			= 	"0";
				$msg 			=	"Các thông tin đã được cập nhật thành công";
			}
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function updateProduct()
	{
		$stt = "";
		$msg = "";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtName','Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtNameSub','Title', 'trim|required|xss_clean|callback_checkbefore');
		$this->form_validation->set_rules('txtAmount','Amount', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('txtPrice','Price', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('txtNewPrice','Sales', 'trim|required|numeric|xss_clean|');

		if($this->form_validation->run() == FALSE){
			$stt 	=	"1";
			$msg 	= 	"Dữ liệu đầu vào không hợp lệ!";
		}
		else
		{
			$datestring         =   "%Y/%m/%d %h:%i:%s";
	        $last_modified      =   mdate($datestring, time() - 60*60);
			$name 				=	$this->input->post('txtName');	
			$title				=	$this->input->post('txtNameSub');
			$idct 				=	$this->input->post('slMain');
			$amount 			=	$this->input->post('txtAmount');
			$price 				=	$this->input->post('txtPrice');
			$s_price 			=	$this->input->post('txtNewPrice');
			$type 				=	$this->input->post('rdType');
			$keyword 			=	$this->input->post('txtKeyword');
			$description 		=	$this->input->post('txtDescription');
			$detail				=	$this->input->post('txtDetail');
			$content			=	$this->input->post('txtContent');
			$status				=	$this->input->post('slStatus');	
			$id 				=	$this->input->post('hd_id');
			
			//$idcate 	=	0;
			//$idctp 		=	0;
        	//Get Store Category
        	$query 				=	$this->Store_category_model->getCategoryById($idct);
        	foreach($query as $row)
        	{
          		$idctp   		=   ($row->id_parent != 0) ? $row->id_parent : $row->id;
          		$idcate 		=	$row->id_category;
        	}
        	//$idcatep 			=	0;
        	$query 				=	$this->Category_model->getCategoryById($idcate);
        	foreach($query as $row)
        	{
          		$idcatep 		=	$row->id_parent;
        	}


			$arrayName 			= 	array(
									'id_category_parent'		=>		$idcatep,
									'id_category'				=>		$idcate,
									'id_store_category_parent'	=>		$idctp,
									'id_store_category'			=>		$idct,
									'name'						=>		$name,
									'title'						=>		$title,
									'amount'					=>		$amount,
									'price'						=>		$price,
									's_price'					=>		$s_price,
									'type'						=>		$type,
									'keyword'					=>		$keyword,
									'description'				=>		$description,
									'detail'					=>		$detail,
									'content'					=>		$content,
									'status'					=>		$status,
									'last_modified'				=>		$last_modified
								);
			$stt 			= 	"1";
			$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
			if($this->Product_model->update($arrayName,$id))
			{
				$stt 			= 	"0";
				$msg 			=	"Các thông tin đã được cập nhật thành công";
			}
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function images()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Hình ảnh sản phẩm";
			$session_data 		= 	$this->session->userdata('logged_store');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$id_store 			=	$session_data['id'];
			$data['id_store']	=	$id_store;
			
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
				$dataleft['num_contact']		=	count($this->Store_contact_model->getList1($id_store));
			if($this->input->get('id')) {
				$id 			=	$this->input->get('id');
				$data['id']		=	$id;
				$query 			=	$this->Product_model->getListById($id);
				foreach ($query as $row) {
					$data['idct'] 	=	$row->id_store_category;
					$data['name']	=	$row->name;

					$result 	=	$this->Store_category_model->getCategoryById($data['idct']);
					foreach ($result as $key) {
						$data['namect']	=	$key->name;
						break;
					}
					break;
				}
				$data['query']		=	$this->Product_images_model->getImage($id);
				$data['num_result'] =	count($data['query']);
				$data['datestring'] = 	"%d/%m/%Y %h:%i";
				$data['index']		=	0;
				$this->load->view("admincp/head_view",$data);
				$this->load->view("controls/colorbox_view");
				$this->load->view("admincp/endhead_view");
				$this->load->view("stores/navigation_view",$datauser);
				$this->load->view("stores/left_view",$dataleft);
				if($dataleft['num_ct'] > 0)
					$this->load->view("stores/product/images_view",$data);
				else {
					$this->load->view("stores/product/redirect_view");
				}
				$this->load->view("stores/footer_view");
			}
			else {
				redirect(base_url("stores/login"), "location");
			}
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function addimage()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Thêm mới hình ảnh";
			$session_data 		= 	$this->session->userdata('logged_store');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$id_store 			=	$session_data['id'];
			$data['id_store']	=	$id_store;
			
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
				$dataleft['num_contact']		=	count($this->Store_contact_model->getList1($id_store));
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['index']		=	0;

			if($this->input->get('id')) {
				$id 			=	$this->input->get('id');
				$data['id']		=	$id;
				$query 			=	$this->Product_model->getListById($id);
				foreach ($query as $row) {
					$data['idct'] 	=	$row->id_store_category;
					$data['name']	=	$row->name;

					$result 	=	$this->Store_category_model->getCategoryById($data['idct']);
					foreach ($result as $key) {
						$data['namect']	=	$key->name;
						break;
					}
					break;
				}

				$this->load->view("admincp/head_view",$data);
				$this->load->view("controls/colorbox_view");
				$this->load->view("js/bootbox_view");
				$this->load->view("js/ckfinder_view");
				$this->load->view("admincp/endhead_view");					
				$this->load->view("controls/modals_view");
				$this->load->view("stores/navigation_view",$datauser);
				$this->load->view("stores/left_view",$dataleft);
				if($dataleft['num_ct'] > 0)
					$this->load->view("stores/product/addimages_view",$data);
				else {
					$this->load->view("stores/product/redirect_view");
				}
				$this->load->view("stores/footer_view");
			}
			else
			{
				redirect(base_url("stores/login"), "location");
			}
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function updateimage()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Chỉnh sửa hình ảnh";
			$session_data 		= 	$this->session->userdata('logged_store');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$id_store 			=	$session_data['id'];
			$data['id_store']	=	$id_store;
			
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
				$dataleft['num_contact']		=	count($this->Store_contact_model->getList1($id_store));
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['index']		=	0;

			if($this->input->get('id')) {
				$id 			=	$this->input->get('id');
				$query1 		=	$this->Product_images_model->getId($id);
				$data['id']		=	$id;

				foreach ($query1  as $value) {
					$data['image'] 		=	$value->image;
					$data['link'] 		=	$value->link;
					$data['status'] 	=	$value->status;
					$data['id_parent'] 	=	$value->id_parent;
					$query 			=	$this->Product_model->getListById($data['id_parent']);
					foreach ($query as $row) {
						$data['idct'] 	=	$row->id_store_category;
						$data['name']	=	$row->name;

						$result 	=	$this->Store_category_model->getCategoryById($data['idct']);
						foreach ($result as $key) {
							$data['namect']	=	$key->name;
							break;
						}
						break;
					}
					break;
				}

				$this->load->view("admincp/head_view",$data);
				$this->load->view("controls/colorbox_view");
				$this->load->view("js/bootbox_view");
				$this->load->view("js/ckfinder_view");
				$this->load->view("admincp/endhead_view");					
				$this->load->view("controls/modals_view");
				$this->load->view("stores/navigation_view",$datauser);
				$this->load->view("stores/left_view",$dataleft);
				if($dataleft['num_ct'] > 0)
				$this->load->view("stores/product/updateimages_view",$data);
				else {
					$this->load->view("stores/product/redirect_view");
				}
				$this->load->view("stores/footer_view");
			}
			else
			{
				redirect(base_url("stores/login"), "location");
			}
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function addimages()
	{
		$stt 			=		"";
		$msg 			=		"";
		$id 			=		$this->input->post('hd_id');
		$image 			=		$this->input->post('txtImages');
		$link 			=		$this->input->post('txtLink');
		$status 		=		$this->input->post('slStatus');	


		$arrayName 		= array(
								'id_parent' 	=> 		$id, 
								'image'	   		=>		$image,
								'link'	   		=>		$link,
								'status'   		=>		$status	
						);

		$stt 			=		"1";
		$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
		if($this->Product_images_model->insert($arrayName))
		{
			$stt 		=	"0";
			$msg 		=	"Hình ảnh đã được cập nhật";
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function updateimages()
	{
		$stt 			=		"";
		$msg 			=		"";
		$id 			=		$this->input->post('hd_id');
		$image 			=		$this->input->post('txtImages');
		$link 			=		$this->input->post('txtLink');
		$status 		=		$this->input->post('slStatus');	


		$arrayName 		= array(
								'image'	   		=>		$image,
								'link'	   		=>		$link,
								'status'   		=>		$status	
						);

		$stt 			=		"1";
		$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
		if($this->Product_images_model->update($arrayName,$id))
		{
			$stt 		=	"0";
			$msg 		=	"Hình ảnh đã được cập nhật";
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function attribute()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Thêm mới thuộc tính cho sản phẩm";
			$data['titleattr']	=	"Thêm thuộc tính";
			$data['titleattr1']	=	"Chỉnh sửa size";
			$data['titleattr2']	=	"Chỉnh sửa màu sắc";
			$session_data 		= 	$this->session->userdata('logged_store');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$id_store 			=	$session_data['id'];
			$data['id_store']	=	$id_store;
			
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
				$dataleft['num_contact']		=	count($this->Store_contact_model->getList1($id_store));
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['index']		=	0;

			if($this->input->get('id')) {
				$id 			=	$this->input->get('id');
				$data['id']		=	$id;
				$query 			=	$this->Product_model->getListById($id);
				foreach ($query as $row) {
					$data['idct'] 	=	$row->id_store_category;
					$data['name']	=	$row->name;

					$result 	=	$this->Store_category_model->getCategoryById($data['idct']);
					foreach ($result as $key) {
						$data['namect']	=	$key->name;
						break;
					}
					break;
				}

				$this->load->view("admincp/head_view",$data);
				$this->load->view("controls/colorbox_view");
				$this->load->view("js/bootbox_view");
				$this->load->view("js/ckfinder_view");
				$this->load->view("admincp/endhead_view");					
				$this->load->view("controls/modals_view");
				$this->load->view("stores/navigation_view",$datauser);
				$this->load->view("stores/left_view",$dataleft);
				if($dataleft['num_ct'] > 0) {
					$data['titlesize'] 	=	"Thuộc tính size";
					$data['titlecolor'] =	"Thuộc tính màu sắc";
					$data['size'] 	=	$this->Product_attribute_model->getAttr($id,0);
					$data['color'] 	=	$this->Product_attribute_model->getAttr($id);
					$this->load->view("stores/product/attribute_view",$data);
				}
				else {
					$this->load->view("stores/product/redirect_view");
				}
				$this->load->view("stores/footer_view");
			}
			else
			{
				redirect(base_url("stores/login"), "location");
			}
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function addattr()
	{
		$stt 			=		"";
		$msg 			=		"";
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtName','Name attribute','trim|required');
		if($this->form_validation->run() == FALSE) {
			$stt 			=		"1";
			$msg 			=		"Dữ liệu đầu vào không hợp lệ!";
		}
		else {

			$datestring         =   "%Y/%m/%d %h:%i:%s";
			$data_added			=	mdate($datestring, time() - 60*60);
	        $last_modified      =   mdate($datestring, time() - 60*60);

	        $id_parent 		=		$this->input->post('hd_id_product');
			$id 			=		$this->input->post('hd_id');
			$image 			=		$this->input->post('txtImages');
			$name 			=		$this->input->post('txtName');
			$type 	 		=		$this->input->post('slType');	


			$arrayName 		= array(
									'id_parent'		=>		$id_parent,									
									'name'   		=>		$name,
									'image'	   		=>		$image,
									'type'	   		=>		$type,
									'last_modified'	=>		$last_modified
							);

			$stt 			=		"1";
			$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
			if($id == 0) {
				$arrayName['date_added']	=	$data_added;
				if($this->Product_attribute_model->insert($arrayName)) {
					$stt 			= 	"0";
					$msg 			=	"Thuộc tính đã được cập nhật";
				}
			}
			else {
				if($this->Product_attribute_model->update($arrayName, $id)) {
					$stt 			= 	"0";
					$msg 			=	"Thuộc tính đã được cập nhật";
				}
			}
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function statusattr()
	{
		$id 		= 	$this->input->post('id');
		$status 	= 	$this->input->post('status');

		if($this->Product_attribute_model->updatestatus($id,$status))
		{
			$messages = "Dữ liệu cập nhật thành công";
			$success  = "1";
		}
		else
		{
			$messages = "Dữ liệu cập nhật thất bại";
			$success  = "0";
		}
		$arrayName = array('msg' => $messages, 'info' => $success, 'status' => $status);
		echo json_encode($arrayName);
	}

	public function deleteattr()
	{
		$success 	= "0";
		
		$id 		= $this->input->post('id');
		if($this->Product_attribute_model->delete($id)){
			$success = "1";			
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

	public function deleteim()
	{
		$id 		= 	$this->input->post('id');

		if($this->Product_images_model->delete($id))
		{
			$messages = "Dữ liệu cập nhật thành công";
			$success  = "1";
		}
		else
		{
			$messages = "Dữ liệu cập nhật thất bại";
			$success  = "0";
		}
		$arrayName = array('msg' => $messages, 'info' => $success);
		echo json_encode($arrayName);
	}

	public function checkbefore()
	{
		$bool 		=	FALSE;
		$name 		=	$this->input->post('txtName');
		$title 		=	$this->input->post('txtNameSub');
		$id 		=	$this->input->post('hd_id');
		if($this->Product_model->getName($name,$id) == FALSE) {
			if($this->Product_model->getTitle($title,$id) == FALSE){
				$bool = TRUE;
			}
		}
		return $bool;
	}

	public function checkname()
	{
		$echo 		=	"0";
		$name 		=	$this->input->post('name');
		$id 	=	$this->input->post('id');
		if($name != "") 
		{
			if($this->Product_model->getName($name,$id))
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
		$id 	=	$this->input->post('id');		
		if($title != "") 
		{
			if($this->Product_model->getTitle($title,$id))
			{
				$echo = "1";
			}
		}
		echo $echo;
	}

	public function statusim()
	{
		$id 		= 	$this->input->post('id');
		$status 	= 	$this->input->post('status');

		if($this->Product_images_model->updatestatus($id,$status))
		{
			$messages = "Dữ liệu cập nhật thành công";
			$success  = "1";
		}
		else
		{
			$messages = "Dữ liệu cập nhật thất bại";
			$success  = "0";
		}
		$arrayName = array('msg' => $messages, 'info' => $success, 'status' => $status);
		echo json_encode($arrayName);
	}

	public function status()
	{
		$id 		= 	$this->input->post('id');
		$status 	= 	$this->input->post('status');

		if($this->Product_model->updatestatus($id,$status))
		{
			$messages = "Dữ liệu cập nhật thành công";
			$success  = "1";
		}
		else
		{
			$messages = "Dữ liệu cập nhật thất bại";
			$success  = "0";
		}
		$arrayName = array('msg' => $messages, 'info' => $success, 'status' => $status);
		echo json_encode($arrayName);
	}

	public function delete()
	{
		$success 	= "0";
		
		$id 		= $this->input->post('id');
		if($this->Product_model->delete($id)){
			$this->Product_images_model->deleteparent($id);
			$this->Product_attribute_model->deleteparent($id);
			$success = "1";			
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

	public function block()
	{
		$success 	= "0";
		
		$id 		= $this->input->post('id');
		if($this->Product_model->movetrash($id)){
			$success = "1";			
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

	public function outtrash()
	{
		$success 	= "0";
		
		$id 		= $this->input->post('id');
		if($this->Product_model->outtrash($id)){
			$success = "1";			
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

}