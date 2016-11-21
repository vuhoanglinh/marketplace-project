<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CI_Controller {
	private $_limit 	=	10;
	public function  __construct() {
        parent::__construct();		
        $this->load->Model('Store_event_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Timeline sự kiện";
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
			$num_rows			=	$this->Store_event_model->getEvent($id_store);
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);
			
			
			$data['index']		=	0;
			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/event/event_view",$data);
			$this->load->view("stores/footer_view");
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function paggingtimeline()
	{
		$start 					=	$this->input->post('page');
		$id_store				=	$this->input->post('id_store');
		$per_page				=	$start * $this->_limit;
		$data['datestring'] 	= 	"%d/%m/%Y";
		$data['query']			=	$this->Store_event_model->getEventLimit1($id_store,$per_page,$this->_limit);
		$this->load->view('stores/event/ajax_timeline_view',$data);
	}

	public function table()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Danh sách sự kiện";
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
				$num_rows			=	$this->Store_event_model->getEventKey2($id_store,$key);
			}
			else {
				$num_rows			=	$this->Store_event_model->getEvent2($id_store);				
			}
			$data['key'] 		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);
			$data['index']		=	0;
			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/event/list_event_view",$data);
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
			$data['query']			=	$this->Store_event_model->getEventKeyLimit2($id_store,$key,$per_page,$this->_limit);
		}
		else {
			$data['query']			=	$this->Store_event_model->getEventLimit2($id_store,$per_page,$this->_limit);
		}
		$this->load->view('stores/event/ajax_list_view',$data);
	}

	public function trash()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Timeline sự kiện";
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
				$num_rows			=	$this->Store_event_model->getEventKey($id_store,$key,2);
			}
			else {
				$num_rows			=	$this->Store_event_model->getEvent($id_store,2);				
			}
			$data['key'] 		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);
			$data['index']		=	0;
			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/event/trash_view",$data);
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
			$data['query']			=	$this->Store_event_model->getEventKeyLimit($id_store,$key,$per_page,$this->_limit,2);
		}
		else {
			$data['query']			=	$this->Store_event_model->getEventLimit1($id_store,$per_page,$this->_limit,2);
		}
		$this->load->view('stores/event/ajax_trash_view',$data);
	}

	public function add()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Thêm mới sự kiện";
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
			$this->load->view("js/ckeditor_view");
			$this->load->view("admincp/endhead_view");					
			$this->load->view("controls/modals_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/event/add_view",$data);
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
			$data['titlepage']	=	"Thêm mới sự kiện";
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
				$query 			=	$this->Store_event_model->getEventById($id);

				foreach ($query as $row) {
					$data['name']		=	$row->name;
					$data['detail']		=	$row->detail;
					$data['text']		=	$row->text;
					$data['time']		=	$row->time;
					$data['status']		=	$row->status;
				}

				$this->load->view("admincp/head_view",$data);
				$this->load->view("js/bootbox_view");
				$this->load->view("js/ckeditor_view");
				$this->load->view("admincp/endhead_view");					
				$this->load->view("controls/modals_view");
				$this->load->view("stores/navigation_view",$datauser);
				$this->load->view("stores/left_view",$dataleft);
				$this->load->view("stores/event/update_view",$data);
				$this->load->view("stores/footer_view");
			}
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function addEvent()
	{
		$stt 		=	"";
		$msg 		=	"";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtName', 'Title', 'trim|required|xss_clean|callback_checkname2');
		$this->form_validation->set_rules('txtDetail', 'Detail', 'trim|xss_clean');
		$this->form_validation->set_rules('txtText', 'Content', 'trim');

		if($this->form_validation->run() == FALSE) {
			$stt 	=	"2";
			$msg 	=	"Dữ liều đầu vào không hợp lệ!";
		}
		else {
			$datestring         =   "%Y/%m/%d %h:%i:%s";
			$data_added			=	mdate($datestring, time() - 60*60);
	        $last_modified      =   mdate($datestring, time() - 60*60);
			$name 				=	$this->input->post('txtName');
			$detail 			=	$this->input->post('txtDetail');
			$text 				=	$this->input->post('txtText');
			$time 				=	$this->input->post('txtTime');
			$status				=	$this->input->post('slStatus');
			$id_store 			=	$this->input->post('hd_store');


			$arrayName 			= array(
									'id_store' 		=> 	$id_store, 
									'name'			=> 	$name,
									'detail'		=>	$detail,
									'text'			=>	$text,
									'time'			=>	$time,
									'status'		=>	$status,
									'date_added'	=> 	$data_added,
									'last_modified'	=>	$last_modified
								);

			$stt 	=	"1";
			$msg 	=	"Lỗi không thể cập nhật dữ liệu";
			if($this->Store_event_model->insert($arrayName)) {
				$stt 	=	"0";
				$msg 	=	"Các dữ liêu đã được cập nhật thành công";
			}
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function updateEvent()
	{
		$stt 		=	"";
		$msg 		=	"";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtName', 'Title', 'trim|required|xss_clean|callback_checkanothername2');
		$this->form_validation->set_rules('txtDetail', 'Detail', 'trim|xss_clean');
		$this->form_validation->set_rules('txtText', 'Content', 'trim');

		if($this->form_validation->run() == FALSE) {
			$stt 	=	"2";
			$msg 	=	"Dữ liệu đầu vào không hợp lệ!";
		}
		else {
			$datestring         =   "%Y/%m/%d %h:%i:%s";
	        $last_modified      =   mdate($datestring, time() - 60*60);
			$name 				=	$this->input->post('txtName');
			$detail 			=	$this->input->post('txtDetail');
			$text 				=	$this->input->post('txtText');
			$time 				=	$this->input->post('txtTime');
			$status				=	$this->input->post('slStatus');
			$id 	 			=	$this->input->post('hd_id');


			$arrayName 			= array(
									'name'			=> 	$name,
									'detail'		=>	$detail,
									'text'			=>	$text,
									'time'			=>	$time,
									'status'		=>	$status,
									'last_modified'	=>	$last_modified
								);

			$stt 	=	"1";
			$msg 	=	"Lỗi không thể cập nhật dữ liệu";
			if($this->Store_event_model->update($arrayName, $id)) {
				$stt 	=	"0";
				$msg 	=	"Các dữ liêu đã được cập nhật thành công";
			}
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function checkname()
	{
		$bool 		=	"0";
		$id_store 	=	$this->input->post('id');
		$name 		=	$this->input->post('name');
		if($this->Store_event_model->getEventByName($id_store,$name)) {
			$bool 	=	"1";
		}
		echo $bool;
	}

	public function checkname2()
	{
		$bool 		=	FALSE;
		$id_store 	=	$this->input->post('hd_store');
		$name 		=	$this->input->post('txtName');
		if($this->Store_event_model->getEventByName($id_store,$name) == FALSE) {
			$bool 	=	TRUE;
		}
		return $bool;
	}

	public function checkanothername()
	{
		$bool 		=	"0";
		$id_store 	=	$this->input->post('id_store');
		$id 		=	$this->input->post('id');
		$name 		=	$this->input->post('name');
		if($this->Store_event_model->getEventByNameID($id_store,$id,$name)) {
			$bool 	=	"1";
		}
		echo $bool;
	}

	public function checkanothername2()
	{
		$bool 		=	FALSE;
		$id_store 	=	$this->input->post('hd_store');
		$id 		=	$this->input->post('hd_id');
		$name 		=	$this->input->post('txtName');
		if($this->Store_event_model->getEventByNameID($id_store,$id,$name) == FALSE) {
			$bool 	=	TRUE;
		}
		return $bool;
	}

	public function status()
	{
		$id 		= 	$this->input->post('id');
		$status 	= 	$this->input->post('status');

		if($this->Store_event_model->updatestatus($id,$status))
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

	public function movetrash()
	{
		$id = $this->input->post('id');

		if($this->Store_event_model->updatestatus($id,2)){
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
		$id = $this->input->post('id');

		if($this->Store_event_model->updatestatus($id,1)){
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
		$id = $this->input->post('id');

		if($this->Store_event_model->delete($id)){
			$success = "1";
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}
}