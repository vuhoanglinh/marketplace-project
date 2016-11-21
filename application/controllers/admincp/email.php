<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {

	public function __construct(){
		parent::__construct();		
		$this->load->Model('Email_model');		
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Danh sách email";

			$id 	=	"";
			if($this->input->get('id') && $this->input->get('id') != "") {
				$id					=	trim($this->input->get('id'));
				if($this->input->get('key')) {
					$key 			=	trim($this->input->get('key'));
					$data['query']	=	$this->Email_model->getEmailByCodeOrName($key,$id);
				}
				else {
					$data['query']	= 	$this->Email_model->getEmailByCategory($id);
				}

				$data['id']			=	$id;
			}
			else
			{

			}

			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();

			$data['index'] 		= 	0;
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/email/email_view",$data);
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function category()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Danh sách danh mục email";

			if($this->input->get('key')) {
				$key 			=	trim($this->input->get('key'));
				$data['query']	=	$this->Emailcategory_model->getCategoryByCodeOrName($key);
			}
			else {
				$data['query']	= 	$this->Emailcategory_model->getCategory();
			}
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$data['index'] 		= 	0;
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/email/email_category_view",$data);
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function addct()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Thêm danh mục email";

			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/email/add_category_view");
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function updatect()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Chỉnh sửa danh mục email";

			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			if($this->input->get('id')) {
				$id 				=	$this->input->get('id');
				$data['id']			=	$id;
				if($this->Emailcategory_model->getEmailctById($id))
				{
					$query			=	$this->Emailcategory_model->getEmailctById($id);
					foreach ($query as $row) {
						# code...
						$data['code']				=	$row->code;
						$data['name']				=	$row->name;
						$data['status']				=	$row->status;
					}
				}
			
				$this->load->view("admincp/head_view",$data);
				$this->load->view("js/bootbox_view");
				$this->load->view("admincp/endhead_view");			
				$this->load->view("controls/modals_view");
				$this->load->view("admincp/navigation_view",$datauser);
				$this->load->view("admincp/left_view",$data);
				$this->load->view("admincp/email/update_category_view",$data);
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

	public function trashct()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 			= 	$this->session->userdata('logged_in');
			$datauser['name'] 		= 	$session_data['name'];
			$datauser['avatar'] 	= 	$session_data['avatar'];
			$data['titlepage'] 		= 	"Danh sách menu đã xóa";			
			
			if($this->input->get('key')) {
				$key 			=	trim($this->input->get('key'));
				$data['query']	=	$this->Emailcategory_model->getCategoryTrashByCodeOrName($key);
			}
			else {
				$data['query']	= 	$this->Emailcategory_model->getCategoryTrash();
			}
			$data['index'] 		= 	0;
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/email/trash_category_view",$data);
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function addEmailct()
	{
		$status 			=	"";
		$msg 				=	"";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtCode', 'Code','trim|required|xss_clean');
		$this->form_validation->set_rules('txtName', 'Name', 'trim|required|xss_clean|callback_checkemailctbeforinsert');
		if($this->form_validation->run() == FALSE)
		{
			$status = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else
		{
			$datestring         =   "%Y/%m/%d %h:%i:%s";
			$data_added			=	mdate($datestring, time() - 60*60);
	        $last_modified      =   mdate($datestring, time() - 60*60);
			$code 				= 	$this->input->post('txtCode');
			$name 				=	$this->input->post('txtName');			
			$status				=	$this->input->post('slStatus');
			$arrayName = array(
								'code' 			=> 		$code, 
								'name'			=>		$name,
								'status'		=>		$status,
								'date_added'	=>		$data_added,
								'last_modified'	=>		$last_modified
						);
			if($this->Emailcategory_model->insertEmailCategory($arrayName))
			{
				$status 		= 	"0";
				$msg 			=	"Các thông tin đã được cập nhật thành công";
			}
			else
			{
				$status 		= 	"1";
				$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
			}			
		}	
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}

	public function checkemailctbeforinsert()
	{
		$bool 				=	FALSE;
		$name 				=	$this->input->post('txtName');
		$code				=	$this->input->post('txtCode');

		if($this->Emailcategory_model->getEmailctByCode($code) == FALSE)	
		{
			
			if($this->Emailcategory_model->getEmailctByName($name) == FALSE)
			{
				$bool 		=	TRUE;
			}					
		}
		return $bool;
	}

	public function updateEmailct()
	{
		$status 			=	"";
		$msg 				=	"";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtCode', 'Code','trim|required|xss_clean');
		$this->form_validation->set_rules('txtName', 'Name', 'trim|required|xss_clean|callback_checkemailctbeforupdate');
		if($this->form_validation->run() == FALSE)
		{
			$status = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else
		{
			$datestring         =   "%Y/%m/%d %h:%i:%s";
			$data_added			=	mdate($datestring, time() - 60*60);
	        $last_modified      =   mdate($datestring, time() - 60*60);
			$code 				= 	$this->input->post('txtCode');
			$name 				=	$this->input->post('txtName');			
			$status				=	$this->input->post('slStatus');					
			$id 				=	$this->input->post('hd_id');
			$arrayName = array(
								'code' 			=> 		$code, 
								'name'			=>		$name,
								'status'		=>		$status,
								'last_modified'	=>		$last_modified
						);
			if($this->Emailcategory_model->updateEmailCategory($arrayName, $id))
			{
				$status 		= 	"0";
				$msg 			=	"Các thông tin đã được cập nhật thành công";
			}
			else
			{
				$status 		= 	"1";
				$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
			}			
		}	
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}

	public function checkemailctbeforupdate()
	{
		$bool 				=	FALSE;
		$name 				=	$this->input->post('txtName');
		$code				=	$this->input->post('txtCode');		
		$id 				=	$this->input->post('hd_id');

		if($this->Emailcategory_model->getEmailctAnotherCode($id, $code) == FALSE)	
		{			
			if($this->Emailcategory_model->getEmailctAnotherName($id, $name) == FALSE)
			{
				$bool  		=	TRUE;
			}					
		}
		return $bool;
	}

	public function checkcodect()
	{
		$echo 	=	"0";
		$code 	=	$this->input->post('code');
		if($code != "") 
		{
			if($this->Emailcategory_model->getEmailctByCode($code))
			{
				$echo = "1";
			}			
		}
		echo $echo;
	}

	public function checknamect()
	{
		$echo 	=	"0";
		$name 	=	$this->input->post('name');
		if($name != "") 
		{
			if($this->Emailcategory_model->getEmailctByName($name))
			{
				$echo 	= "1";
			}			
		}
		echo $echo;
	}	

	public function statusct()
	{
		$id 		= 	$this->input->post('id');
		$status 	= 	$this->input->post('status');

		if($this->Emailcategory_model->updatestatus($id,$status))
		{
			$messages = "Dữ liệu cập nhật thành công";
			$success  = "1";
			$this->Email_model->updatestatusByParent($id,$status);
		}
		else
		{
			$messages = "Dữ liệu cập nhật thất bại";
			$success  = "0";
		}
		$arrayName = array('msg' => $messages, 'info' => $success, 'status' => $status);
		echo json_encode($arrayName);
	}

	public function blockct()
	{
		//Load Library form_validation of Codeigniter
		//$this->load->library('form_validation');

		$success = "0";
		
		$id = $this->input->post('id');

		if($this->Emailcategory_model->movetrash($id)){
			$success = "1";
			$this->Email_model->movetrash($id);
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

	
	public function movetrashct()
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
				if($this->Emailcategory_model->movetrash($id))
				{
					$num++;
					$this->Email_model->movetrash($id);
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

	public function checkanothercodect()
	{		
		$echo 	= "0";
		$code = $this->input->post('code');
		$id   =	$this->input->post('id');
		if($code != "") {
			if($this->Emailcategory_model->getEmailctAnotherCode($id, $code))
			{
				$echo 	= "1";
			}			
		}
		echo $echo;
	}

	public function checkanothernamect()
	{
		$echo 	= "0";
		$name = $this->input->post('name');
		$id   =	$this->input->post('id');
		if($name != "") {
			if($this->Emailcategory_model->getEmailctAnotherName($id, $name))
			{
				$echo 	= "1";
			}
		}
		echo $echo;
	}

	public function delct()
	{
		//Load Library form_validation of Codeigniter
		//$this->load->library('form_validation');

		$num = 1;
		$index = $this->input->post('hd_count');
		for($count = 1; $count <= $index; $count++)
		{
			//$this->form_validation->set_rules('check'.$count,'ID','trim|required|xss_clean');

			$id 	=	$this->input->post('check'.$count);
			//if($this->form_validation->run() == TRUE)
			//{
				if($this->Emailcategory_model->delete($id))
				{
					$num++;
					$this->Email_model->deleteByParent($id);
				}
			//}			
		}

		if($num === $index){
			echo "Lỗi không thể cập nhật dữ liệu";
		}
		else {			
			echo "Các dữ liệu đã được xóa thành công";
		}		
	}

	public function deletect()
	{
		$id = $this->input->post('id');

		if($this->Emailcategory_model->delete($id)){
			$success = "1";
			$this->Email_model->deleteByParent($id);
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

	public function outtrashct()
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
				if($this->Emailcategory_model->outtrash($id))
				{
					$num++;
					$this->Email_model->outtrashParent($id);
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
				if($this->Email_model->movetrash($id))
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

	public function add()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Thêm mới email";

			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$data['index'] 		= 	0;
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/email/add_view",$data);
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
			$data['titlepage'] 	= 	"Chỉnh sửa email";

			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$data['index'] 		= 	0;
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			if($this->input->get('id')) {
				$id 				=	$this->input->get('id');
				$data['id']			=	$id;
				if($this->Email_model->getById($id))
				{
					$query			=	$this->Email_model->getById($id);
					foreach ($query as $row) {
						# code...
						$data['code']				=	$row->code;
						$data['name']				=	$row->name;
						$data['email']				=	$row->email;
						$data['pass']				=	$row->pass;
						$data['smtp']				=	$row->smtp_server;
						$data['ssl']				=	$row->smtp_ssl;
						$data['port']				=	$row->port;
						$data['id_parent']			=	$row->id_parent;
						$data['status']				=	$row->status;
					}
				}
				$this->load->view("admincp/head_view",$data);
				$this->load->view("js/bootbox_view");
				$this->load->view("admincp/endhead_view");			
				$this->load->view("controls/modals_view");
				$this->load->view("admincp/navigation_view",$datauser);
				$this->load->view("admincp/left_view",$data);
				$this->load->view("admincp/email/update_view",$data);
				$this->load->view("admincp/footer_view");
			}
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function trash()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Danh sách email đã xóa";

			if($this->input->get('key')) {
				$key 			=	trim($this->input->get('key'));
				$data['query']	= 	$this->Email_model->getEmailTrashByCodeOrName($key);				
			}
			else {
				$data['query']	=	$this->Email_model->getEmailTrash();
			}

			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$data['index'] 		= 	0;
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/email/emailtrash_view",$data);
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function addEmail()
	{
		$status 	=	"";
		$msg 		=	"";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtName', 'Name', 'trim|required|xss_clean|callback_checkname1');
		$this->form_validation->set_rules('txtEmail', 'Email', 'trim|required|xss_clean|callback_checkemail1');
		$this->form_validation->set_rules('txtPassword', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtSMTP', 'SMPT Server', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtPort', 'SMTP Port','trim|numeric');

		if($this->form_validation->run() == FALSE)
		{
			$status = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else
		{
			$datestring         =   "%Y/%m/%d %h:%i:%s";
			$data_added			=	mdate($datestring, time() - 60*60);
	        $last_modified      =   mdate($datestring, time() - 60*60);			
			$name 				=	$this->input->post('txtName');
			$email 				= 	$this->input->post('txtEmail');	
			$password			=	$this->input->post('txtPassword');
			$smtp 				=	$this->input->post('txtSMTP');
			$ssl 				=	$this->input->post('txtSSL');
			$port 				=	$this->input->post('txtPort');	
			$status				=	$this->input->post('slStatus');	
			$id_parent 			=	$this->input->post('slCategory');
			$query 				=	$this->Emailcategory_model->getEmailctById($id_parent);
			foreach ($query as $row) {
				# code...
				$code 			=	$row->code;
			}


			$_1 				= @strpos($email,'@') + 1;
			$_2 				= @strpos($email,'.') - $_1;
			$type_email 		=	@substr($email,$_1,$_2);

			$arrayName = array(
								'code' 			=> 		$code, 
								'name'			=>		$name,
								'email'			=>		$email,
								'pass'			=>		$password,
								'type'			=>		$id_parent,
								'type_code'		=>		$code, 
								'type_email'	=> 		$type_email,
								'smtp_server'	=>		$smtp,
								'smtp_ssl'		=>		($ssl  == "")? 'ssl' : $ssl,
								'port'			=>		($port == "")? '465' : $port,
								'id_parent'		=>		$id_parent,
								'status'		=>		$status,
								'date_added'	=>		$data_added,
								'last_modified'	=>		$last_modified
						);
			if($this->Email_model->insert($arrayName))
			{
				$status 		= 	"0";
				$msg 			=	"Các thông tin đã được cập nhật thành công";
			}
			else
			{
				$status 		= 	"1";
				$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
			}				
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));	
	}

	public function checkname1()
	{
		$bool		=	FALSE;
		$name 		=	$this->input->post('txtName');
		if(!$this->Email_model->getByName($name))
		{
			$bool	=	TRUE;
		}
		return $bool;
	}

	public function checkemail1()
	{
		$bool 		=	FALSE;
		$email 		=	$this->input->post('txtEmail');
		$this->load->helper('email');
		if(valid_email($email)) 
		{
			if(!$this->Email_model->getByEmail($email))
			{
				$bool = TRUE;
			}

		}
		return $bool;
	}

	public function updateEmail()
	{
		$status 	=	"";
		$msg 		=	"";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtName', 'Name', 'trim|required|xss_clean|callback_checkanothername1');
		$this->form_validation->set_rules('txtEmail', 'Email', 'trim|required|xss_clean|callback_checkanotheremail1');
		$this->form_validation->set_rules('txtPassword', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtSMTP', 'SMPT Server', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtPort', 'SMTP Port','trim|numeric');

		if($this->form_validation->run() == FALSE)
		{
			$status = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else
		{
			$datestring         =   "%Y/%m/%d %h:%i:%s";
	        $last_modified      =   mdate($datestring, time() - 60*60);			
			$name 				=	$this->input->post('txtName');
			$email 				= 	$this->input->post('txtEmail');	
			$password			=	$this->input->post('txtPassword');
			$smtp 				=	$this->input->post('txtSMTP');
			$ssl 				=	$this->input->post('txtSSL');
			$port 				=	$this->input->post('txtPort');	
			$status				=	$this->input->post('slStatus');	
			$id_parent 			=	$this->input->post('slCategory');
			$query 				=	$this->Emailcategory_model->getEmailctById($id_parent);
			foreach ($query as $row) {
				# code...
				$code 			=	$row->code;
			}
			$id 				=	$this->input->post('hd_id');

			$_1 				= @strpos($email,'@') + 1;
			$_2 				= @strpos($email,'.') - $_1;
			$type_email 		=	@substr($email,$_1,$_2);

			$arrayName = array(
								'code' 			=> 		$code, 
								'name'			=>		$name,
								'email'			=>		$email,
								'pass'			=>		$password,
								'type'			=>		$id_parent,
								'type_code'		=>		$code, 
								'type_email'	=> 		$type_email,
								'smtp_server'	=>		$smtp,
								'smtp_ssl'		=>		($ssl  == "")? 'ssl' : $ssl,
								'port'			=>		($port == "")? '465' : $port,
								'id_parent'		=>		$id_parent,
								'status'		=>		$status,
								'last_modified'	=>		$last_modified
						);
			if($this->Email_model->update($arrayName, $id))
			{
				$status 		= 	"0";
				$msg 			=	"Các thông tin đã được cập nhật thành công";
			}
			else
			{
				$status 		= 	"1";
				$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
			}				
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}

	public function status()
	{
		$id 		= 	$this->input->post('id');
		$status 	= 	$this->input->post('status');

		if($this->Email_model->updatestatus($id,$status))
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
		//Load Library form_validation of Codeigniter
		//$this->load->library('form_validation');

		$success = "0";
		
		$id = $this->input->post('id');

		if($this->Email_model->movetrash($id)){
			$success = "1";
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

	public function checkname()
	{
		$echo 	= "0";
		$name	=	$this->input->post('name');
		if($name != "") 
		{
			if($this->Email_model->getByName($name))
			{
				echo "1";
			}
		}
		echo $echo;
	}

	public function checkemail()
	{
		$echo 	= "0";
		$email	=	$this->input->post('email');
		if($email != "") 
		{
			if($this->Email_model->getByEmail($email))
			{
				$echo 	= "1";
			}			
		}
		echo $echo;
	}

	public function checkanotheremail()
	{		
		$echo 	= 	"0";
		$email 	= 	$this->input->post('email');
		$id   	=	$this->input->post('id');
		if($email != "") {
			if($this->Email_model->getAnotherEmail($id, $email))
			{
				$echo 	= "1";
			}			
		}
		echo $echo;
	}

	public function checkanotheremail1()
	{		
		$bool 	=	FALSE;
		$email 	= 	$this->input->post('txtEmail');
		$id   	=	$this->input->post('hd_id');
		
		if($this->Email_model->getAnotherEmail($id, $email) == FALSE)
		{
			$bool = TRUE;
		}
		return $bool;		
	}

	public function checkanothername()
	{
		$echo 	= 	"0";
		$name 	= 	$this->input->post('name');
		$id   	=	$this->input->post('id');
		if($name != "") {
			if($this->Email_model->getAnotherName($id, $name))
			{
				$echo 	= "1";
			}			
		}
		echo $echo;
	}

	public function checkanothername1()
	{
		$bool = FALSE;
		$name = $this->input->post('txtName');
		$id   =	$this->input->post('hd_id');
		
		if($this->Email_model->getAnotherName($id, $name) == FALSE)
		{
			$bool = TRUE;
		}
		return $bool;
		
	}

	public function deleteall()
	{
		//Load Library form_validation of Codeigniter
		//$this->load->library('form_validation');

		$num = 1;
		$index = $this->input->post('hd_count');
		for($count = 1; $count <= $index; $count++)
		{
			//$this->form_validation->set_rules('check'.$count,'ID','trim|required|xss_clean');

			$id 	=	$this->input->post('check'.$count);
			//if($this->form_validation->run() == TRUE)
			//{
				if($this->Email_model->delete($id))
				{
					$num++;
				}
			//}			
		}

		if($num === $index){
			echo "Lỗi không thể cập nhật dữ liệu";
		}
		else {			
			echo "Các dữ liệu đã được xóa thành công";
		}		
	}

	public function delete()
	{
		$id = $this->input->post('id');

		if($this->Email_model->delete($id)){
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
				if($this->Email_model->outtrash($id))
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
}