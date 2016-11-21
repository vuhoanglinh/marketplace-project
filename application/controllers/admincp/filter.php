<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filter extends CI_Controller {
	private $_limit 	=	10;
	public function  __construct() {
        parent::__construct();
		$this->load->Model("Filter_model");
		$this->load->Model("Filter_meta_model");
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			
			$session_data 		= 	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			
				$data['titlepage'] 	= 	"Danh mục bộ lọc sản phẩm";	

				$key 				=	"";
				if($this->input->get('key')) {
					$key 			=	trim($this->input->get('key'));
					$num_rows		=	$this->Filter_model->getLikeKey($key);
				}
				else {
					$num_rows		=	$this->Filter_model->getfilter();
				}

				$data['titleadd']	=	"Thêm danh mục bộ lọc sản phẩm";
				$data['titleupdate']=	"Chỉnh sửa danh mục bộ lọc sản phẩm";
				$data['result']		= 	$this->Emailcategory_model->getCategory();
				$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
				$data['index'] 		= 	0;

				$data['key']		=	$key;
				$data['num_result']	=	count($num_rows);
				$data['total_page']	=	ceil(count($num_rows)/$this->_limit);

				$data['datestring'] = 	"%d/%m/%Y %h:%i";
				$this->load->view("admincp/head_view",$data);
				$this->load->view("js/bootbox_view");
				$this->load->view("admincp/endhead_view");			
				$this->load->view("controls/modals_view");
				$this->load->view("admincp/navigation_view",$datauser);
				$this->load->view("admincp/left_view",$data);
				$this->load->view("admincp/filter/filter_view",$data);
				$this->load->view("admincp/footer_view");
			
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function pagging_filter()
	{
		$data['titleadd']	=	"Thêm danh mục bộ lọc sản phẩm";
		$data['titleupdate']=	"Chỉnh sửa danh mục bộ lọc sản phẩm";
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$data['datestring'] = 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));
			$data['query']	=	$this->Filter_model->getLikeKeyLimit($key,$per_page,$this->_limit);
		}
		else
		{
			$data['query']		=	$this->Filter_model->getfilterlimit($per_page,$this->_limit);
		}
		$this->load->view("admincp/filter/ajax_filter_view",$data);
	}

	public function action()
	{
		$stt 	=	"";
		$msg	=	"";
		$id 	=	$this->input->post('hd_id');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtName','Name', 'trim|required|xss_clean|callback_checkname1');
		$this->form_validation->set_rules('txtNameSub','Title','trim|xss_clean');

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
			$arrayName = array(
								'name'			=>		$name,
								'title'			=>		$title,
								'last_modified'	=>		$last_modified
						);
			$stt 			= 	"1";
			$msg 			= 	"Lỗi không thể cập nhật dữ liệu";

			if($id == 0) {
				$arrayName['date_added']	=	$data_added;
				if($this->Filter_model->insert($arrayName)) {
					$stt 			= 	"0";
					$msg 			=	"Các thông tin đã được cập nhật thành công";
				}
			}
			else {
				if($this->Filter_model->update($arrayName, $id)) {
					$stt 			= 	"0";
					$msg 			=	"Các thông tin đã được cập nhật thành công";
				}
			}
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function checkname1()
	{
		$id 	=	$this->input->post('hd_id');
		$name 	=	$this->input->post('txtName');
		$bool 	=	FALSE;
		if($id == 0) {
			if($this->Filter_model->getfilterByName($name) == FALSE) {
				$bool = TRUE;
			}
		}
		else {
			if($this->Filter_model->getfilterByNameId($id,$name) == FALSE) {
				$bool = TRUE;
			}
		}
		return $bool;
	}	

	public function checkname()
	{
		$id 	=	$this->input->post('id');
		$name 	=	$this->input->post('name');
		$echo 	=	"0";
		if($id == 0) {
			if($this->Filter_model->getfilterByName($name)) {
				$echo 	=	"1";
			}
		}
		else {
			if($this->Filter_model->getfilterByNameId($id,$name)) {
				$echo 	=	"1";
			}
		}
		echo $echo;
	}

	public function status()
	{
		$id 		= 	$this->input->post('id');
		$status 	= 	$this->input->post('status');

		if($this->Filter_model->updatestatus($id,$status))
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
		if($this->Filter_model->delete($id)){
			$this->Filter_meta_model->deleteidfilter($id);
			$success = "1";			
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

	public function meta()
	{
		if($this->session->userdata('logged_in'))
		{
			
			$session_data 		= 	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			
			if($this->input->get('id')) {
				$id_filter 			=	$this->input->get('id');
				$data['id']			=	$id_filter;
				$data['titlepage'] 	= 	"Danh sách bộ lọc sản phẩm";	

				$query 				=	$this->Filter_model->getfilterbyid($id_filter);
				foreach ($query as $row) {
					$data['name_filter']	=	$row->name;
				}

				$key 		=	"";
				if($this->input->get('key')) {
					$key 			=	trim($this->input->get('key'));
					$num_rows		=	$this->Filter_meta_model->getLikeKey($id_filter,$key);
				}
				else {
					$num_rows		=	$this->Filter_meta_model->getmeta($id_filter);
				}

				$data['titleadd']	=	"Thêm bộ lọc sản phẩm";
				$data['titleupdate']=	"Chỉnh sửa bộ lọc sản phẩm";
				$data['result']		= 	$this->Emailcategory_model->getCategory();
				$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
				$data['index'] 		= 	0;
				$data['key']		=	$key;
				$data['num_result']	=	count($num_rows);
				$data['total_page']	=	ceil(count($num_rows)/$this->_limit);

				$data['datestring'] = 	"%d/%m/%Y %h:%i";
				$this->load->view("admincp/head_view",$data);
				$this->load->view("js/bootbox_view");
				$this->load->view("js/elfinder_view");	
				$this->load->view("admincp/endhead_view");			
				$this->load->view("controls/modals_view");
				$this->load->view("admincp/navigation_view",$datauser);
				$this->load->view("admincp/left_view",$data);
				$this->load->view("admincp/filter/meta_view",$data);
				$this->load->view("admincp/footer_view");
			}
			
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function pagging_meta()
	{
		$data['titleadd']	=	"Thêm bộ lọc sản phẩm";
		$data['titleupdate']=	"Chỉnh sửa bộ lọc sản phẩm";
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$id_filter 				=	$this->input->post('id');
		$data['datestring'] = 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));
			$data['query']	=	$this->Filter_meta_model->getLikeKeyLimit($id_filter,$key,$per_page,$this->_limit);
		}
		else
		{
			$data['query']		=	$this->Filter_meta_model->getmetalimit($id_filter,$per_page,$this->_limit);
		}
		$this->load->view("admincp/filter/ajax_meta_view",$data);
	}

	public function actionmt()
	{
		$stt 	=	"";
		$msg	=	"";
		$id 	=	$this->input->post('hd_id');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtName','Name', 'trim|required|xss_clean|callback_checknamemt1');
		if($this->form_validation->run() == FALSE) {
			$stt = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else {
			$name 				=	$this->input->post('txtName');	
			$meta_value			=	$this->input->post('txtNameSub');	
			$image 				=	$this->input->post('txtLogo');	
			$id_filter 			=	$this->input->post('hd_id_filter');
			$type 				=	$this->input->post('slType');
			$arrayName = array(
								'id_filter'		=> 		$id_filter,								
								'type'			=>		$type,								
								'image'			=>		$image,
								'name'			=>		$name,
								'meta_value'	=>		$meta_value,

						);
			$stt 			= 	"1";
			$msg 			= 	"Lỗi không thể cập nhật dữ liệu";

			if($id == 0) {
				if($this->Filter_meta_model->insert($arrayName)) {
					$stt 			= 	"0";
					$msg 			=	"Các thông tin đã được cập nhật thành công";
				}
			}
			else {
				if($this->Filter_meta_model->update($arrayName, $id)) {
					$stt 			= 	"0";
					$msg 			=	"Các thông tin đã được cập nhật thành công";
				}
			}
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function statusmt()
	{
		$id 		= 	$this->input->post('id');
		$status 	= 	$this->input->post('status');

		if($this->Filter_meta_model->updatestatus($id,$status))
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

	public function deletemt()
	{
		$success 	= "0";
		
		$id 		= $this->input->post('id');
		if($this->Filter_meta_model->delete($id)){
			$success = "1";			
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}
	public function checknamemt1()
	{
		$id 		=	$this->input->post('hd_id');
		$id_filter 	=	$this->input->post('hd_id_filter');
		$name 		=	$this->input->post('txtName');

		$bool 	=	FALSE;
		if($id == 0) {
			if($this->Filter_meta_model->getByName($id_filter,$name) == FALSE) {
				$bool = TRUE;
			}
		}
		else {
			if($this->Filter_meta_model->getByNameId($id_filter,$id,$name) == FALSE) {
				$bool = TRUE;
			}
		}
		return $bool;
	}

	public function checknamemt()
	{
		$id 		=	$this->input->post('id');
		$id_filter 	=	$this->input->post('id_filter');
		$name 		=	$this->input->post('name');

		$bool 	=	"0";
		if($id == 0) {
			if($this->Filter_meta_model->getByName($id_filter,$name)) {
				$bool = "1";
			}
		}
		else {
			if($this->Filter_meta_model->getByNameId($id_filter,$id,$name)) {
				$bool = "1";
			}
		}
		echo $bool;
	}
}