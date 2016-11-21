<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {
	private $_limit 	=	10;
	public function  __construct() {
        parent::__construct();		
        $this->load->Model('Category_model');
	}
	
	public function index()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Danh sách danh mục sản phẩm";
			$session_data 		= 	$this->session->userdata('logged_store');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$id_store 			=	$session_data['id'];
			$data['id_store']	=	$id_store;
			$key = "";
			if($this->input->get('key'))
			{
				$key 			=	$this->input->get('key');
				$num_rows		=	$this->Store_category_model->getLikeName($id_store,$key);
			}
			else
			{
				$num_rows		=	$this->Store_category_model->getCategory($id_store);
			}
			$data['key'] 		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);

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
			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/category/category_view",$data);
			$this->load->view("stores/footer_view");
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function paggingparent()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$id_store				=	$this->input->post('id_store');
		$data['datestring'] = 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));
			$data['query']	=	$this->Store_category_model->getLikeNameLimit($id_store,$key,$per_page,$this->_limit);
		}
		else
		{
			$data['query']	=	$this->Store_category_model->getCategoryLimit($id_store,$per_page,$this->_limit);
		}
		$this->load->view("stores/category/ajax_category_view",$data);
	}

	public function trash()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Danh sách danh mục sản phẩm đã xóa";
			$session_data 		= 	$this->session->userdata('logged_store');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$id_store 			=	$session_data['id'];
			$data['id_store']	=	$id_store;
			$key = "";
			if($this->input->get('key'))
			{
				$key 			=	$this->input->get('key');
				$num_rows		=	$this->Store_category_model->getLikeName($id_store,$key,0,0);
			}
			else
			{
				$num_rows		=	$this->Store_category_model->getCategory($id_store,0,0);
			}
			$data['key'] 		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);

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
			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/category/trash_view",$data);
			$this->load->view("stores/footer_view");
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function paggingtrashparent()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$id_store				=	$this->input->post('id_store');
		$data['datestring'] = 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));
			$data['query']	=	$this->Store_category_model->getLikeNameLimit($id_store,$key,$per_page,$this->_limit,0,0);
		}
		else
		{
			$data['query']	=	$this->Store_category_model->getCategoryLimit($id_store,$per_page,$this->_limit,0,0);
		}
		$this->load->view("stores/category/ajax_trash_view",$data);
	}

	public function children()
	{
		if($this->session->userdata('logged_store'))
		{
			$session_data 		= 	$this->session->userdata('logged_store');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$id_store 			=	$session_data['id'];
			$data['id_store']	=	$id_store;

			

			if($this->input->get('id'))
			{
				$id_parent		=	$this->input->get('id');
			
				//Get name parent
				$name_parent 		=	"";
				$query 				=	$this->Store_category_model->getCategoryById($id_parent);
				foreach ($query as $row) {
					$name_parent	=	$row->name;
					$id_category 	=	$row->id_category;
				}
				$data['id_parent']	=	$id_parent;
				$data['name_parent']=	$name_parent;
				$data['id_category']=	$id_category;

				$data['titlepage'] 	= 	"Danh mục ".$name_parent;

				$key = "";
				if($this->input->get('key'))
				{
					$key 			=	$this->input->get('key');
					$num_rows	=	$this->Store_category_model->getLikeName($id_store,$key,$id_parent);
				}
				else
				{
					$num_rows 		=	$this->Store_category_model->getCategory($id_store,$id_parent); //Get child category
				}
				$data['key'] 		=	$key;
				$data['num_result']	=	count($num_rows);
				$data['total_page']	=	ceil(count($num_rows)/$this->_limit);

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
				$this->load->view("admincp/head_view",$data);
				$this->load->view("admincp/endhead_view");
				$this->load->view("stores/navigation_view",$datauser);
				$this->load->view("stores/left_view",$dataleft);
				$this->load->view("stores/category/category_children_view",$data);
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

	public function paggingchild()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$id_store				=	$this->input->post('id_store');
		$id_parent 				=	$this->input->post('id_parent');
		$data['datestring'] = 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));
			$data['query']	=	$this->Store_category_model->getLikeNameLimit($id_store,$key,$per_page,$this->_limit,$id_parent);
		}
		else
		{
			$data['query']	=	$this->Store_category_model->getCategoryLimit($id_store,$per_page,$this->_limit,$id_parent);
		}
		$this->load->view("stores/category/ajax_childcategory_view",$data);
	}

	public function trashchild()
	{
		if($this->session->userdata('logged_store'))
		{
			$session_data 		= 	$this->session->userdata('logged_store');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$id_store 			=	$session_data['id'];
			$data['id_store']	=	$id_store;

			

			if($this->input->get('id'))
			{
				$id_parent		=	$this->input->get('id');
			
				//Get name parent
				$name_parent 		=	"";
				$query 				=	$this->Store_category_model->getCategoryById($id_parent);
				foreach ($query as $row) {
					$name_parent	=	$row->name;
					$id_category 	=	$row->id_category;
				}
				$data['id_parent']	=	$id_parent;
				$data['name_parent']=	$name_parent;
				$data['id_category']=	$id_category;

				$data['titlepage'] 	= 	"Danh mục ".$name_parent." đã xóa";

				$key = "";
				if($this->input->get('key'))
				{
					$key 			=	$this->input->get('key');
					$num_rows	=	$this->Store_category_model->getLikeName($id_store,$key,$id_parent,0);
				}
				else
				{
					$num_rows 		=	$this->Store_category_model->getCategory($id_store,$id_parent,0); //Get child category
				}
				$data['key'] 		=	$key;
				$data['num_result']	=	count($num_rows);
				$data['total_page']	=	ceil(count($num_rows)/$this->_limit);

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
				$this->load->view("admincp/head_view",$data);
				$this->load->view("admincp/endhead_view");
				$this->load->view("stores/navigation_view",$datauser);
				$this->load->view("stores/left_view",$dataleft);
				$this->load->view("stores/category/trashchild_view",$data);
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

	public function paggingtrashchild()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$id_store				=	$this->input->post('id_store');
		$id_parent 				=	$this->input->post('id_parent');
		$data['datestring'] = 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));
			$data['query']	=	$this->Store_category_model->getLikeNameLimit($id_store,$key,$per_page,$this->_limit,$id_parent,0);
		}
		else
		{
			$data['query']	=	$this->Store_category_model->getCategoryLimit($id_store,$per_page,$this->_limit,$id_parent,0);
		}
		$this->load->view("stores/category/ajax_trashchild_view",$data);
	}

	public function add()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Thêm mới danh mục sản phẩm";
			$session_data 		= 	$this->session->userdata('logged_store');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];

			$id_store 			=	$session_data['id'];
			$data['id_store']	=	$id_store;
			$id_parent 			=	0;
			$id_category		=	0;
			if($this->input->get('id'))
			{
				$id_parent		=	$this->input->get('id');
			}
			//Get name parent
			$name_parent 		=	"";
			$query 				=	$this->Store_category_model->getCategoryById($id_parent);
			foreach ($query as $row) {
				$name_parent	=	$row->name;
				$id_category 	=	$row->id_category;
			}
			$data['id_parent']	=	$id_parent;
			$data['name_parent']=	$name_parent;
			$data['id_category']=	$id_category;
			$data['query'] 		=	$this->Store_category_model->getParent($id_store);	//Get query parent category of store
			//Get main category
			$query 				=	array();
			$query['parent'] 	= $this->Category_model->getParent();

			$index 				= 0;
			$query['child'] 	= array();
			$data['index'] 		= 0;
			$temp 				= $query['parent'];
			foreach ($temp as $key) {
				$id_parent = $key->id;
				$query['child'][$index] = $this->Category_model->getChildren($id_parent);
				$index++;
			}			
			$data['result'] = $query;

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
			
			$this->load->view("admincp/head_view",$data);					
			$this->load->view("js/elfinder_view");	
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/category/add_view",$data);
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
			$data['titlepage']	=	"Chỉnh sửa danh mục sản phẩm";
			$session_data 		= 	$this->session->userdata('logged_store');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];

			$id_store 			=	$session_data['id'];
			$data['id_store']	=	$id_store;

			if($this->input->get('id'))
			{
				$id 			=	$this->input->get('id');
				$data['id']		=	$id;
				$query 			=	$this->Store_category_model->getCategoryById($id);
				foreach ($query  as $row) {
					$data['name']		=	$row->name;
					$data['title']		=	$row->title;
					$data['id_parent']	=	$row->id_parent;
					$data['id_category']=	$row->id_category;
					$data['keyword']	=	$row->keyword;
					$data['description']=	$row->description;
					$data['status']		=	$row->status;
				}
				
				$data['query'] 		=	$this->Store_category_model->getParent($id_store,1);	
				//Get main category
				$query =	array();
				$query['parent'] = $this->Category_model->getParent();

				$index 			= 0;
				$query['child'] = array();
				$data['index'] 	= 0;
				$temp 			= $query['parent'];
				foreach ($temp as $key) {
					$id_parent = $key->id;
					$query['child'][$index] = $this->Category_model->getChildren($id_parent,1);
					$index++;
				}			
				$data['result'] = $query;

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
				
				$this->load->view("admincp/head_view",$data);					
				$this->load->view("js/elfinder_view");	
				$this->load->view("admincp/endhead_view");			
				$this->load->view("controls/modals_view");
				$this->load->view("stores/navigation_view",$datauser);
				$this->load->view("stores/left_view",$dataleft);
				$this->load->view("stores/category/update_view",$data);
				$this->load->view("stores/footer_view");
			}
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function addCategory()
	{
		$stt 	=	"";
		$msg 	=	"";
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtName', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtNameSub', 'Title', 'trim|required|xss_clean|callback_checkcategorybeforeinsert');
		if($this->form_validation->run() == FALSE) {
			$stt = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else {

			$datestring         =   "%Y/%m/%d %h:%i:%s";
			$data_added			=	mdate($datestring, time() - 60*60);
	        $last_modified      =   mdate($datestring, time() - 60*60);
			$name 				=	$this->input->post('txtName');	
			$title				=	$this->input->post('txtNameSub');
			$id_parent 			=	$this->input->post('slParent');
			$id_category		=	$this->input->post('slMain');
			$keyword 			=	$this->input->post('txtKeyword');
			$description 		=	$this->input->post('txtDescription');
			$status				=	$this->input->post('slStatus');	
			$id_store 			=	$this->input->post('hd_store');

			//Get name parent
			$name_parent 		=	"";
			if($id_parent != 0) {
				$query 				=	$this->Store_category_model->getCategoryById($id_parent);
				foreach ($query as $row) {
					$name_parent	=	$row->name;
				}
			}

			$arrayName = array(
								'id_parent' 	=> 		$id_parent,
								'id_store'		=>		$id_store,
								'id_category'	=>		$id_category,
								'name_parent' 	=>		$name_parent,
								'name'			=>		$name,
								'title'			=>		$title,
								'keyword'		=>		$keyword,
								'description'	=>		$description,
								'status'		=>		$status,
								'date_added'	=>		$data_added,
								'last_modified'	=>		$last_modified
						);
			if($this->Store_category_model->insert($arrayName))
			{
				$stt 			= 	"0";
				$msg 			=	"Các thông tin đã được cập nhật thành công";
			}
			else
			{
				$stt 			= 	"1";
				$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
			}		
		}		
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function updateCategory()
	{
		$stt 	=	"";
		$msg 	=	"";
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtName', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtNameSub', 'Title', 'trim|required|xss_clean|callback_checkcategorybeforeupdate');
		if($this->form_validation->run() == FALSE) {
			$stt = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else {

			$datestring         =   "%Y/%m/%d %h:%i:%s";
	        $last_modified      =   mdate($datestring, time() - 60*60);
	        $id 				=	$this->input->post('hd_id');
			$name 				=	$this->input->post('txtName');	
			$title				=	$this->input->post('txtNameSub');
			$id_parent 			=	$this->input->post('slParent');
			$id_category		=	$this->input->post('slMain');
			$keyword 			=	$this->input->post('txtKeyword');
			$description 		=	$this->input->post('txtDescription');
			$status				=	$this->input->post('slStatus');	

			//Get name parent
			$name_parent 		=	"";
			if($id_parent != 0) {
				$query 				=	$this->Store_category_model->getCategoryById($id_parent);
				foreach ($query as $row) {
					$name_parent	=	$row->name;
				}
			}

			$arrayName = array(
								'id_parent' 	=> 		$id_parent,
								'id_category'	=>		$id_category,
								'name_parent' 	=>		$name_parent,
								'name'			=>		$name,
								'title'			=>		$title,
								'keyword'		=>		$keyword,
								'description'	=>		$description,
								'status'		=>		$status,								
								'last_modified'	=>		$last_modified
						);
			if($this->Store_category_model->update($arrayName,$id))
			{
				$stt 			= 	"0";
				$msg 			=	"Các thông tin đã được cập nhật thành công";
				if($id_parent == 0) {
					$array  	=	array('name_parent' 	=>		$name);
					$this->Category_model->updateParent($array,$id);
				}
			}
			else
			{
				$stt 			= 	"1";
				$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
			}		
		}		
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function checkcategorybeforeinsert()
	{
		$bool 		= FALSE;
		$id_parent	=	$this->input->post('slParent');
		$name 		=	$this->input->post('txtName');
		$title 		=	$this->input->post('txtNameSub');
		if($this->Store_category_model->getByName($name,$id_parent) == FALSE) {
			if($this->Store_category_model->getByTitle($title,$id_parent) == FALSE)
			{
			
				$bool 	=  TRUE;
			}
		}
		return $bool;
	}

	public function checkcategorybeforeupdate()
	{
		$bool 		= FALSE;
		$id 		=	$this->input->post('hd_id');
		$id_parent	=	$this->input->post('slParent');
		$name 		=	$this->input->post('txtName');
		$title 		=	$this->input->post('txtNameSub');
		if($this->Store_category_model->getAnotherByName($id,$name,$id_parent) == FALSE) {
			if($this->Store_category_model->getAnotherByTitle($id,$title,$id_parent) == FALSE)
			{				
				$bool 	=  TRUE;
			}
		}
		return $bool;
	}

	public function checkname()
	{
		$echo 		=	"0";
		$name 		=	$this->input->post('name');
		$id_parent	=	$this->input->post('id_parent');
		if($name != "") 
		{
			if($this->Store_category_model->getByName($name,$id_parent))
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
		$id_parent	=	$this->input->post('id_parent');
		if($title != "") 
		{
			if($this->Store_category_model->getByTitle($title,$id_parent))
			{
				$echo = "1";
			}
		}
		echo $echo;
	}

	public function checkanothername()
	{
		$echo 		=	"0";
		$id 		=	$this->input->post('id');
		$name 		=	$this->input->post('name');
		$id_parent	=	$this->input->post('id_parent');
		if($name != "") 
		{
			if($this->Store_category_model->getAnotherByName($id,$name,$id_parent))
			{
				$echo = "1";
			}			
		}
		echo $echo;
	}

	public function checkanothertitle()
	{
		$echo 	=	"0";
		$id 		=	$this->input->post('id');
		$title	=	$this->input->post('title');		
		$id_parent	=	$this->input->post('id_parent');
		if($title != "") 
		{
			if($this->Store_category_model->getAnotherByTitle($id,$title,$id_parent))
			{
				$echo = "1";
			}
		}
		echo $echo;
	}

	public function status()
	{
		$id 		= 	$this->input->post('id');
		$status 	= 	$this->input->post('status');

		if($this->Store_category_model->updatestatus($id,$status))
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

	public function block()
	{
		$success 	= "0";
		
		$id 		= $this->input->post('id');
		if($this->Store_category_model->movetrash($id)){
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
		if($this->Store_category_model->outtrash($id)){
			$success = "1";			
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

	public function delete()
	{
		$success 	= "0";
		
		$id 		= $this->input->post('id');
		if($this->Store_category_model->delete($id)){
			$success = "1";			
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

}	