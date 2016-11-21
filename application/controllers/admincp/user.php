<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function  __construct() {
        parent::__construct();
		$this->load->Model('Users_model');
	}
	
	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['titlepage'] 	= 	"Danh sách quản trị viên";
			$session_data 		= 	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['index']		= 	0;
			if($this->input->get('key')) {
				$key 			=	trim($this->input->get('key'));
				$data['query']	=	$this->Users_model->getUserByCodeOrName($key);
			}
			else {
				$data['query']	= 	$this->Users_model->getALLUser();
			}
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/users/users_table_view",$data);
			$this->load->view("admincp/footer_view",$data);
		}		
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function add()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['titlepage'] 	= 	"Thêm mới quản trị viên";
			$session_data 		= 	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");				
			$this->load->view("js/elfinder_view");	
			//$this->load->view("admincp/js/fileupload_view");
			//$this->load->view("admincp/js/ajaxfileupload_view");
			$this->load->view("admincp/endhead_view");
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/users/add_view",$data);
			$this->load->view("admincp/footer_view",$data);
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
			$data['titlepage'] 	= 	"Thêm mới quản trị viên";
			$session_data 		= 	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			
			if($this->input->get('id'))
			{
				$id 			= 	$this->input->post('id');
				$data['id']		= 	$id;
				if($this->Users_model->getUserById($id))
				{
					$query   	=	$this->Users_model->getUserById($id);
					foreach($query as $row)
					{
						$data['name'] 		= 		$row->name;
						$data['username']	=		$row->username;
						$data['password']	=		$row->password;
						$data['email']		=		$row->email;
						$data['phone']		=		$row->phone;
						$data['address']	=		$row->address;
						$data['avatar']		=		$row->avatar;
					}
				}
			}
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");				
			$this->load->view("js/elfinder_view");	
			//$this->load->view("admincp/js/fileupload_view");
			//$this->load->view("admincp/js/ajaxfileupload_view");
			$this->load->view("admincp/endhead_view");
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/users/update_view",$data);
			$this->load->view("admincp/footer_view",$data);
		}		
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function checkusername()
	{
		$user 		= 		$this->input->post('user');
		if($user != "")
		{
			if($this->Users_model->getUserName($user) == TRUE)
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
		}
		else
		{
			echo "0";
		}
	}

	public function addUser()
	{
		$status = "";
		$msg 	= "";
		//Load Library form_validation of Codeigniter
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtName','Name','trim|required|xss_clean');
		$this->form_validation->set_rules('txtUsername','Username','trim|required|xss_clean|callback_checkUserBeforeInsert');
		$this->form_validation->set_rules('txtPassword','Password','trim|required|min_length[6]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('txtEmail','Email','trim|required|xss_clean|callback_checkEmail');
		if($this->form_validation->run() == FALSE)
		{
			$status = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else
		{
			$query 			=	$this->Users_model->getIdForUser();
			foreach($query as $row)
        	{
          		$id   =   ($row->id != "") ? $row->id : 1;
        	}
		
			$datastring 	=	"%Y/%m/%d %h:%m:%i";
			$date_addded 	=	mdate($datastring, time() - 60*60);
			$last_modified 	=	mdate($datastring, time() - 60*60);
			$code 			=	"us".str_pad($id,4,"0", STR_PAD_LEFT);
			$name 			=	$this->input->post('txtName');
			$username 		=	$this->input->post('txtUsername');
			$password 		= 	$this->input->post('txtPassword');
			$email 			=	$this->input->post('txtEmail');
			$phone 			=	$this->input->post('txtPhone');
			$level 			=	$this->input->post('rLevel');
			$address	 	=	$this->input->post('txtAddress');
			$avatar 		=	$this->input->post('txtImages');

			$arrayName 		= 	array(
								'code' 			=> 		$code, 
								'name'			=>		$name,
								'username'		=>		$username,
								'password'		=>		$password,
								'md5_pass'		=>		md5($password),
								'sha1_pass'		=>		sha1($password),
								'email'			=>		$email,
								'phone'			=>		$phone,
								'group'			=>		$level,
								'address'		=>		$address,
								'avatar'		=>		$avatar,
								'date_added'	=>		$date_addded,
								'last_modified'	=>		$last_modified
							);
			if($this->Users_model->insertUser($arrayName))
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
		echo json_encode(array('msg' => $msg, 'status' => $status));
	}

	public function checkEmail()
	{
		$email 		=	$this->input->post('txtEmail');
		$this->load->helper('email');
		if(valid_email($email)) {
			return TRUE;
		}
		else {
			return FALSE;
		}

	}

	public function checkUserBeforeInsert()
	{
		$username 	= 	$this->input->post('txtUsername');
		if($this->Users_model->getUserName($username) == TRUE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function status()
	{
		$id 		= 	$this->input->post('id');
		$status 	= 	$this->input->post('status');

		if($this->Users_model->updatestatus($id,$status))
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
	/***
	//Upload file
	public function upfile()
	{
		$name 					 =		$this->input->post('txtName');		
		$config['upload_path'] 	 = 		'.\public\upload\avatar';
		$config['allowed_types'] = 		'gif|jpg|png';
		$config['max_size']  	 = 		1024 * 8;
		$config['file_name']	 = 		$name;
		$config['encrypt_name']  = 		TRUE;
		$this->load->library("upload",$config);
		if(!$this->upload->do_upload("ufile")){
			return TRUE;
		}
		else {
			return FALSE;
		}
		
	}
	***/
	public function test()
	{
		$query 			=	$this->Users_model->getIdForUser();
			foreach($query as $row)
        	{
          		$id   =   $row->id;
        	}
        	$code 			=	"us".str_pad($id,4,"0", STR_PAD_LEFT);
        	echo $code;
	}
}

/* End of file index.php */
/* Location: ./application/controllers/admincp/user.php */