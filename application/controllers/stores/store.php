<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends CI_Controller {
	public function  __construct() {
        parent::__construct();	
        $this->load->Model('Store_model');	
	}
	
	public function index()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Thông tin cửa hàng";
			$session_data 		= 	$this->session->userdata('logged_store');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$id_store 			=	$session_data['id'];
			$dataconfig['id_store'] =	$id_store;
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
			$query 				=	$this->Store_model->getStoreById($id_store);
			foreach ($query as $row) {
				$dataconfig['name'] 		= 	$row->name;
				$dataconfig['name_contact'] = 	$row->name_contact;
				$dataconfig['phone'] 		= 	$row->phone;
				$dataconfig['email']		=	$row->email;
				$dataconfig['address']		=	$row->address;
			}
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/ckeditor_view");
			$this->load->view("js/ckfinder_view");
			$this->load->view("js/bootbox_view");	
			$this->load->view("admincp/endhead_view");	
			$this->load->view("controls/modals_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/config/stores_view",$dataconfig);
			$this->load->view("stores/footer_view");
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function config()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Thiết lập cửa hàng";
			$session_data 		= 	$this->session->userdata('logged_store');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$id_store 			=	$session_data['id'];
			$dataconfig['id_store'] =	$id_store;
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
			$query 				=	$this->Store_model->getStoreById($id_store);
			foreach ($query as $row) {
				$dataconfig['logo'] 		= 	$row->logo;
				$dataconfig['website'] 		= 	$row->website;
				$dataconfig['hotline'] 		= 	$row->hotline;
				$dataconfig['detail']		=	$row->detail;
				$dataconfig['intro']		=	$row->intro;
				$dataconfig['keyword']		=	$row->keyword;
				$dataconfig['description']	=	$row->description;
				$dataconfig['descript_brand']	=	$row->descript_brand;
			}
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/ckeditor_view");
			$this->load->view("js/ckfinder_view");
			$this->load->view("js/bootbox_view");	
			$this->load->view("admincp/endhead_view");	
			$this->load->view("controls/modals_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/config/config_view",$dataconfig);
			$this->load->view("stores/footer_view");
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function editstore()
	{
		$stt 			=		"";
		$msg 			=		"";
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtName', 'Name', 'trim|required|xss_clean|callback_checknameATinput');
		$this->form_validation->set_rules('txtNameContact', 'Name Manager Store', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtEmail', 'Email', 'trim|required|valid_email|xss_clean');
		if($this->form_validation->run() == FALSE)
		{
			$status = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else
		{	
			$id 			=		$this->input->post('hd_id_store1');	
			$name 			=		$this->input->post('txtName');
			$name_contact	=		$this->input->post('txtNameContact');
			$email 			=		$this->input->post('txtEmail');
			$phone 			=		$this->input->post('txtPhone');
			$address 		=		$this->input->post('txtAddress');
			$arrayName 		= array(
								'name' 				=> 		$name, 
								'name_contact'		=>		$name_contact,
								'email'				=>		$email,
								'phone'				=>		$phone,
								'address'			=>		$address
							);
			if($this->Store_model->update($arrayName,$id))
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

	public function checknameATinput()
	{
		$bool 	=	FALSE;
		$id 	=	$this->input->post('hd_id_store1');	
		$name 	=	$this->input->post('txtName');		
		if($this->Store_model->getStoreAnotherName($id,$name) == FALSE)
		{
			$bool = TRUE;
		}
		return $bool;	
	}

	public function editconfig()
	{
		$stt 			=		"";
		$msg 			=		"";
		$datestring         =   "%Y/%m/%d %h:%i:%s";
	    $last_modified      =   mdate($datestring, time() - 60*60);
		$id_store 		=		$this->input->post('hd_id_store');
		$logo 			=		trim($this->input->post('txtLogo'));
		$website		=		$this->input->post('txtWebsite');
		$hotline		=		$this->input->post('txtHotline');
		$intro 			=		$this->input->post('txtIntro');
		$detail 		=		$this->input->post('txtDetail');
		$keyword 		=		$this->input->post('txtKeyword');
		$description 	=		$this->input->post('txtDescription');
		$descript_brand 	=		$this->input->post('txtDescripBrand');

		$arrayName 	= array(
						'logo' 			=> 	$logo , 
						'website'		=> 	$website,
						'hotline'		=>	$hotline,
						'intro'			=>	$intro,
						'detail'		=>	$detail,
						'keyword'		=>	$keyword,
						'description'	=>	$description,
						'descript_brand'=>	$descript_brand,
						'last_modified'	=>		$last_modified
					);
		$stt 			= 	"1";
		$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
		if($this->Store_model->update($arrayName,$id_store))
		{
			$stt 			= 	"0";
			$msg 			=	"Các thông tin đã được cập nhật thành công";
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function edituser()
	{
		$stt 			=		"";
		$msg 			=		"";
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtOldPass', 'Old Password', 'required|callback_checkpass');
		$this->form_validation->set_rules('txtNewPass', 'Old Password', 'required|min_length[6]|max_length[20]');
		$this->form_validation->set_rules('txtRePass', 'Old Password', 'required|matches[txtNewPass]');
		if($this->form_validation->run() == FALSE)
		{
			$stt = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else
		{	

			$id_store 		=		$this->input->post('hd_id_store2');
			$oldpass 		=		$this->input->post('txtOldPass');
			$newpass 		=		$this->input->post('txtNewPass');

			if($oldpass == $newpass)
			{
				$stt = "2";
				$msg 	= "Mật khẩu mới không được trùng với mật khẩu cũ!";
			}
			else
			{
				$arrayName = array('password' => md5($newpass));
				$stt 			= 	"1";
				$msg 			= 	"Lỗi! Vui lòng kiểm tra lại";
				if($this->Store_model->update($arrayName,$id_store))
				{
					$stt 		= 	"0";
					$msg 		=	"Mật khẩu đã được cập nhật";
				}
			}
		}	
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function checkpass()
	{
		$bool 			=		FALSE;
		$id_store 		=		$this->input->post('hd_id_store2');
		$oldpass 		=		$this->input->post('txtOldPass');
		$code 			=		$this->input->post('txtID');
		$query 			=		$this->Store_model->getStoreById($id_store);
		foreach ($query as $row) {
			$temp 		=		$row->password;
			$ctemp 		=		$row->code;
		}

		if(md5($oldpass) == $temp && $code == $ctemp)
		{
			$bool 		=	TRUE;
		}

		return $bool;
	}
}