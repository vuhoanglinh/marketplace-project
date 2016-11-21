<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

	private $_limit 	=	10;
	public function __construct() {
		parent::__construct();	
		$this->load->Model('Category_model');
		$this->load->Model('Filter_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Danh mục sản phẩm";

			$key = "";
			if($this->input->get('key'))
			{
				$key 			=	$this->input->get('key');
				$num_rows		=	$this->Category_model->getParentLikeName($key,1);
			}
			else
			{
				$num_rows		=	$this->Category_model->getParent1(1);
			}
			$data['key']		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$data['index']		=	0;
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");			
			$this->load->view("js/elfinder_view");	
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/category/category_view",$data);
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function pagging_category()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$data['datestring'] = 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));
			$data['query']	=	$this->Category_model->getParentLikeNameCT($key,$per_page,$this->_limit);
		}
		else
		{
			$data['query']		=	$this->Category_model->getParentCT($per_page,$this->_limit);
		}
		$this->load->view("admincp/category/ajax_category_view",$data);
	}

	public function trash()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Danh mục sản phẩm đã xóa";

			$key = "";
			if($this->input->get('key'))
			{
				$key 			=	$this->input->get('key');
				$num_rows		=	$this->Category_model->getParentLikeName($key,0);
			}
			else
			{
				$num_rows		=	$this->Category_model->getParent1(0);
			}
			$data['key']		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$data['index']		=	0;
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");			
			$this->load->view("js/elfinder_view");	
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/category/trash_view",$data);
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function paggingtrash_category()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$data['datestring'] = 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));
			$data['query']	=	$this->Category_model->getParentLikeNameCT($key,$per_page,$this->_limit,0);
		}
		else
		{
			$data['query']		=	$this->Category_model->getParentCT($per_page,$this->_limit,0);
		}
		$this->load->view("admincp/category/ajax_trash_view",$data);
	}

	public function children()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Danh mục sản phẩm";

			if($this->input->get('id'))
			{
				$id_parent		=	$this->input->get('id');
			}
			else
			{
				redirect(base_url("admincp"), "location");
			}
			//Get name parent
			$name_parent 		=	"";
			$query 				=	$this->Category_model->getCategoryById($id_parent);
			foreach ($query as $row) {
				$name_parent	=	$row->name;
			}
			$data['id_parent']	=	$id_parent;
			$data['name_parent']=	$name_parent;

			$key = "";
			if($this->input->get('key'))
			{
				$key 			=	$this->input->get('key');
				$num_rows		=	$this->Category_model->getChildrenLikeName($id_parent,$key);
			}
			else
			{
				$num_rows		=	$this->Category_model->getChildren1($id_parent);
			}

			$data['key']		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);

			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$data['index']		=	0;
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");			
			$this->load->view("js/elfinder_view");	
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/category/category_children_view",$data);
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function pagging_childcategory()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$data['datestring'] 	= 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
		$id_parent				=	$this->input->post('id');
		$data['id_parent']		=	$id_parent;
		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));
			$data['query']	=	$this->Category_model->getChildrenLikeNameCT($id_parent,$key,$per_page,$this->_limit);
		}
		else
		{
			$data['query']		=	$this->Category_model->getChildrenCT($id_parent,$per_page,$this->_limit);
		}
		$this->load->view("admincp/category/ajax_childcategory_view",$data);
	}

	public function trashchildren()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Danh mục sản phẩm đã xóa";

			if($this->input->get('id'))
			{
				$id_parent		=	$this->input->get('id');
			}
			else
			{
				redirect(base_url("admincp"), "location");
			}
			//Get name parent
			$name_parent 		=	"";
			$query 				=	$this->Category_model->getCategoryById($id_parent);
			foreach ($query as $row) {
				$name_parent	=	$row->name;
			}
			$data['id_parent']	=	$id_parent;
			$data['name_parent']=	$name_parent;

			$key = "";
			if($this->input->get('key'))
			{
				$key 			=	$this->input->get('key');
				$num_rows		=	$this->Category_model->getChildrenLikeName($id_parent,$key,0);
			}
			else
			{
				$num_rows		=	$this->Category_model->getChildren1($id_parent,0);
			}

			$data['key']		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);

			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$data['index']		=	0;
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");			
			$this->load->view("js/elfinder_view");	
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/category/category_childrentrash_view",$data);
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function paggingtrash_childcategory()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$data['datestring'] 	= 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
		$id_parent				=	$this->input->post('id');
		$data['id_parent']		=	$id_parent;
		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));
			$data['query']	=	$this->Category_model->getChildrenLikeNameCT($id_parent,$key,$per_page,$this->_limit,0);
		}
		else
		{
			$data['query']		=	$this->Category_model->getChildrenCT($id_parent,$per_page,$this->_limit,0);
		}
		$this->load->view("admincp/category/ajax_childtrash_view",$data);
	}

	public function add()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Thêm danh mục sản phẩm";

			$data['query']		=	$this->Category_model->getParent();
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();	
					
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");	
			$this->load->view("js/ckeditor_view");		
			$this->load->view("js/elfinder_view");	
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/category/add_view");
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function update()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Chỉnh sửa danh mục sản phẩm";

			$data['query']		=	$this->Category_model->getParent();
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();	
				

			//get attribute
			if($this->input->get('id')) {
				$id 				=	$this->input->get('id');
				$data['id']			=	$id;
				if($this->Category_model->getCategoryById($id))
				{
					$query			=	$this->Category_model->getCategoryById($id);
					foreach ($query as $row) {
						# code...
						$data['name']				=	$row->name;
						$data['title']				=	$row->title;
						$data['images']				=	$row->images;
						$data['id_parent']			=	$row->id_parent;
						$data['status']				=	$row->status;
						$data['detail']				=	$row->detail;
					}
				}	
				$this->load->view("admincp/head_view",$data);
				$this->load->view("js/bootbox_view");	
				$this->load->view("js/ckeditor_view");		
				$this->load->view("js/elfinder_view");	
				$this->load->view("admincp/endhead_view");			
				$this->load->view("controls/modals_view");
				$this->load->view("admincp/navigation_view",$datauser);
				$this->load->view("admincp/left_view",$data);
				$this->load->view("admincp/category/update_view");
				$this->load->view("admincp/footer_view");
			}
			else
			{
				redirect(base_url("admincp"), "location");
			}
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
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
			$images 			=	$this->input->post('txtLogo');
			$link 				=	$this->input->post('txtLink');
			$status				=	$this->input->post('slStatus');	
			$detail 			=	$this->input->post('txtDetail');	

			//Get name parent
			$name_parent 		=	"";
			if($id_parent != 0) {
				$query 				=	$this->Category_model->getCategoryById($id_parent);
				foreach ($query as $row) {
					$name_parent	=	$row->name;
				}
			}

			$arrayName = array(
								'id_parent' 	=> 		$id_parent,
								'name_parent' 	=>		$name_parent,
								'name'			=>		$name,
								'title'			=>		$title,
								'images'		=>		$images,
								'link'			=>		$link,
								'detail'		=>		$detail,
								'status'		=>		$status,
								'date_added'	=>		$data_added,
								'last_modified'	=>		$last_modified
						);
			if($this->Category_model->insert($arrayName))
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
		$stt 		=	"";
		$msg 		=	"";
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtName', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtNameSub', 'Title', 'trim|required|xss_clean|callback_checkcategorybeforupdate');
		if($this->form_validation->run() == FALSE)
		{
			$stt = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else
		{
			$datestring         =   "%Y/%m/%d %h:%i:%s";
			$data_added			=	mdate($datestring, time() - 60*60);
	        $last_modified      =   mdate($datestring, time() - 60*60);
			$name 				=	$this->input->post('txtName');	
			$title				=	$this->input->post('txtNameSub');
			$id_parent 			=	$this->input->post('slParent');
			$images 			=	$this->input->post('txtLogo');
			$link 				=	$this->input->post('txtLink');
			$status				=	$this->input->post('slStatus');	
			$detail 			=	$this->input->post('txtDetail');
			$id 				=	$this->input->post('hd_id');

			//Get name parent
			$name_parent 		=	"";
			if($id_parent != 0) {
				$query 				=	$this->Category_model->getCategoryById($id_parent);
				foreach ($query as $row) {
					$name_parent	=	$row->name;
				}
			}

			$arrayName = array(
								'id_parent' 	=> 		$id_parent,
								'name_parent' 	=>		$name_parent,
								'name'			=>		$name,
								'title'			=>		$title,
								'images'		=>		$images,
								'link'			=>		$link,
								'detail'		=>		$detail,
								'status'		=>		$status,
								'last_modified'	=>		$last_modified
						);
			if($this->Category_model->update($arrayName,$id))
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
		if($this->Category_model->getByName($name,$id_parent) == FALSE) {
			if($this->Category_model->getByTitle($title,$id_parent) == FALSE)
			{
				$bool 	=  TRUE;
			}
		}
		return $bool;
	}

	public function checkcategorybeforupdate()
	{
		$bool 		=	FALSE;
		$id 		=	$this->input->post('hd_id');
		$id_parent	=	$this->input->post('slParent');
		$name 		=	$this->input->post('txtName');
		$title 		=	$this->input->post('txtNameSub');
		if($this->Category_model->getAnotherByName($id,$name,$id_parent) == FALSE) {
			if($this->Category_model->getAnotherByTitle($id,$title,$id_parent) == FALSE)
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
			if($this->Category_model->getByName($name,$id_parent))
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
			if($this->Category_model->getByTitle($title,$id_parent))
			{
				$echo = "1";
			}
		}
		echo $echo;
	}

	public function checkanothername()
	{
		$echo = "0";
		$id 		=	$this->input->post('id');
		$id_parent	=	$this->input->post('id_parent');
		$name 		=	$this->input->post('name');
		if($name != "") 
		{
			if($this->Category_model->getAnotherByName($id,$name,$id_parent))
			{
				$echo = "1";
			}			
		}
		echo $echo;
	}

	public function checkanothertitle()
	{
		$echo = "0";
		$id 		=	$this->input->post('id');
		$id_parent	=	$this->input->post('id_parent');
		$title 		=	$this->input->post('title');
		if($title != "") 
		{
			if($this->Category_model->getAnotherByTitle($id,$title,$id_parent))
			{
				$echo = "1";
			}			
		}
		echo $echo;
	}

	public function movetrash()
	{
		//Load Library form_validation of Codeigniter
		$this->load->library('form_validation');

		$num = 1;
		$index = $this->input->post('hd_count');
		for($count = 1; $count <= $index; $count++)
		{
			//$this->form_validation->set_rules('check'.$count,'ID','trim|required|xss_clean');

			$id 	=	$this->input->post('check'.$count);
			//if($this->form_validation->run() == TRUE)
			//{
				if($this->Category_model->movetrash($id))
				{
					$num++;
				}
			//}			
		}

		if($num === $index){
			echo "Lỗi không thể cập nhật dữ liệu";
		}
		else {			
			echo "Các thông tin đã được cập nhật thành công";
		}	
	}
	
	public function status()
	{
		$id 		= 	$this->input->post('id');
		$status 	= 	$this->input->post('status');

		if($this->Category_model->updatestatus($id,$status))
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
		if($this->Category_model->movetrash($id)){
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
		if($this->Category_model->outtrash($id)){
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
		if($this->Category_model->delete($id)){
			$success = "1";			
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

	public function filter()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Thêm bộ lọc cho danh mục";

			$data['filter']		=	$this->Filter_model->getfilter();
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();	
			$data['index']		=	0;	
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");		
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/category/filter_view");
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function filteradd()
	{

	}
	
	public function addfilter()
	{
		
	}
	
}