<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Liststore extends CI_Controller {
	private $_limit 	=	10;
	public function  __construct() {
        parent::__construct();		
        $this->load->Model('Store_list_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Danh sách chi nhánh";
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
			$key = "";
			if($this->input->get('key')) {
				$key 				=	$this->input->get('key');
				$num_rows			=	$this->Store_list_model->getListKey($id_store,$key);
			}
			else {
				$num_rows			=	$this->Store_list_model->getList($id_store);				
			}
			$data['key'] 		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);
			$data['index']		=	0;
			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/liststore/list_view",$data);
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
		$id_store				=	$this->input->post('id');
		$per_page				=	$start * $this->_limit;
		$data['index']			=	0;
		$data['datestring'] 	= 	"%d/%m/%Y %h:%i";
		if($this->input->post('key') != "") {
			$key 					=	$this->input->post('key');
			$data['query']			=	$this->Store_list_model->getListKeyLimit($id_store,$key,$per_page,$this->_limit);
		}
		else {
			$data['query']			=	$this->Store_list_model->getListLimit($id_store,$per_page,$this->_limit);
		}
		$this->load->view('stores/liststore/ajax_list_view',$data);
	}

	public function trash()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Danh sách chi nhánh đã xóa";
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
			$key = "";
			if($this->input->get('key')) {
				$key 				=	$this->input->get('key');
				$num_rows			=	$this->Store_list_model->getListKey($id_store,$key,0);
			}
			else {
				$num_rows			=	$this->Store_list_model->getList($id_store,0);				
			}
			$data['key'] 		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);
			$data['index']		=	0;
			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/liststore/trash_view",$data);
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
		$id_store				=	$this->input->post('id');
		$per_page				=	$start * $this->_limit;
		$data['index']			=	0;
		$data['datestring'] 	= 	"%d/%m/%Y %h:%i";
		if($this->input->post('key') != "") {
			$key 					=	$this->input->post('key');
			$data['query']			=	$this->Store_list_model->getListKeyLimit($id_store,$key,$per_page,$this->_limit,0);
		}
		else {
			$data['query']			=	$this->Store_list_model->getListLimit($id_store,$per_page,$this->_limit,0);
		}
		$this->load->view('stores/liststore/ajax_trash_view',$data);
	}

	public function add()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Thêm mới chi nhánh";
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

			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");
			$this->load->view("admincp/endhead_view");					
			$this->load->view("controls/modals_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/liststore/add_view",$data);
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
			$data['titlepage']	=	"Chỉnh sửa chi nhánh";
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
				$query 			=	$this->Store_list_model->getListById($id);
				foreach ($query as $row) {
					$data['name']			=	$row->name;
					$data['address']		=	$row->address;
					$data['phone']			=	$row->phone;
					$data['fax']			=	$row->fax;
					$data['longitude'] 	= 	$row->longitude;
					$data['latitude'] 	= 	$row->latitude;
					$data['status']			=	$row->status;
				}
				$data['id']		=	$id;
				$this->load->view("admincp/head_view",$data);
				$this->load->view("js/bootbox_view");
				$this->load->view("admincp/endhead_view");					
				$this->load->view("controls/modals_view");
				$this->load->view("stores/navigation_view",$datauser);
				$this->load->view("stores/left_view",$dataleft);
				$this->load->view("stores/liststore/update_view",$data);
				$this->load->view("stores/footer_view");
			}
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}

	}

	public function addStore()
	{
		$stt 	=	"";
		$msg 	=	"";

		$datestring         =   "%Y/%m/%d %h:%i:%s";
		$data_added			=	mdate($datestring, time() - 60*60);
	    $last_modified      =   mdate($datestring, time() - 60*60);
		$id_store 	=		$this->input->post('hd_store');
		$name 		=		trim($this->input->post('txtName'));
		$address 	=		trim($this->input->post('txtAddress'));
		$phone 		=		trim($this->input->post('txtPhone'));
		$fax 	 	=		trim($this->input->post('txtFax'));
		$status 	=		$this->input->post('slStatus');
		$longitude 	=		$this->input->post('hd_longitude'); //kinh độ
		$latitude 	=		$this->input->post('hd_latitude'); //vĩ độ

		$arrayName 	= array(
						'id_store' 		=> 	$id_store, 
						'name'	   		=>	$name,
						'address'  		=> 	$address,
						'phone'    		=> 	$phone,
						'fax'	   		=> 	$fax,
						'longitude'		=>	$longitude,
						'latitude'		=>	$latitude,
						'status'   		=> 	$status,
						'date_added'	=> 	$data_added,
						'last_modified'	=>	$last_modified
					);
		$stt 	=	"1";
		$msg 	=	"Lỗi không thể cập nhật dữ liệu";
		if($this->Store_list_model->insert($arrayName)) {
			$stt 	=	"0";
			$msg 	=	"Các dữ liêu đã được cập nhật thành công";
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function updateStore()
	{
		$stt 	=	"";
		$msg 	=	"";

		$datestring         =   "%Y/%m/%d %h:%i:%s";
	    $last_modified      =   mdate($datestring, time() - 60*60);
		$id 	 	=		$this->input->post('hd_id');
		$name 		=		trim($this->input->post('txtName'));
		$address 	=		trim($this->input->post('txtAddress'));
		$phone 		=		trim($this->input->post('txtPhone'));
		$fax 	 	=		trim($this->input->post('txtFax'));
		$longitude 	=		$this->input->post('hd_longitude'); //kinh độ
		$latitude 	=		$this->input->post('hd_latitude'); //vĩ độ
		$status 	=		$this->input->post('slStatus');


		$arrayName 	= array(
						'name'	   => $name,
						'address'  => $address,
						'phone'    => $phone,
						'fax'	   => $fax,
						'longitude'		=>		$longitude,
						'latitude'		=>		$latitude,
						'status'   => $status,
						'last_modified'	=>	$last_modified
					);
		$stt 	=	"1";
		$msg 	=	"Lỗi không thể cập nhật dữ liệu";
		if($this->Store_list_model->update($arrayName,$id)) {
			$stt 	=	"0";
			$msg 	=	"Các dữ liêu đã được cập nhật thành công";
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function status()
	{

		$id 		= 	$this->input->post('id');
		$status 	= 	$this->input->post('status');

		if($this->Store_list_model->updatestatus($id,$status))
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

		$id 		= 	$this->input->post('id');

		if($this->Store_list_model->delete($id))
		{
			$messages = "Dữ liệu cập nhật thành công";
			$success  = "1";
		}
		else
		{
			$messages = "Dữ liệu cập nhật thất bại";
			$success  = "0";
		}
		$arrayName = array('msg' => $messages, 'status' => $success);
		echo json_encode($arrayName);
	}

	public function outtrash()
	{
		$id 		= 	$this->input->post('id');

		if($this->Store_list_model->updatestatuscp($id,1))
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

	public function movetrash()
	{
		$id 		= 	$this->input->post('id');

		if($this->Store_list_model->updatestatuscp($id,0))
		{
			$messages = "Dữ liệu cập nhật thành công";
			$success  = "1";
		}
		else
		{
			$messages = "Dữ liệu cập nhật thất bại";
			$success  = "0";
		}
		$arrayName = array('msg' => $messages, 'status' => $success);
		echo json_encode($arrayName);
	}
}