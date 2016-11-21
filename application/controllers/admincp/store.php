<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends CI_Controller {

	private $_limit 	=	10;
	public function  __construct() {
        parent::__construct();		
        $this->load->Model('Store_model');
	}

	//Page Store
	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Danh sách cửa hàng";

			$key = "";
			$id_group = "";
			if($this->input->get('id')) {
				$id_group			=	trim($this->input->get('id'));
				if($this->input->get('key')) {
					$key 			=	trim($this->input->get('key'));
					$num_rows		=	$this->Store_model->getStoreByGroupCodeName($id_group,$key);
				}
				else {
					$num_rows		= 	$this->Store_model->getStoreByGroup($id_group);
				}
			}
			else
			{
				if($this->input->get('key')) {
					$key 			=	trim($this->input->get('key'));
					$num_rows		=	$this->Store_model->getStoreBykey($key);
				}
				else {
					$num_rows		= 	$this->Store_model->getStore1();
				}
			}


			$data['id']			=	$id_group;
			$data['key']		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);

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
			$this->load->view("admincp/store/store_view",$data);
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function paggingstore()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$data['datestring'] 	= 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
			if($this->input->post('id') != "") {
				$id_group			=	trim($this->input->post('id'));
				$data['id']			=	$id_group;
				if($this->input->post('key')) {
					$key 			=	trim($this->input->post('key'));
					$data['query']	=	$this->Store_model->getStoreByGroupCodeNameLimit($id_group,$per_page,$this->_limit,$key);
				}
				else {
					$data['query']	= 	$this->Store_model->getStoreByGroupLimit($id_group,$per_page,$this->_limit);
				}
			}
			else
			{
				if($this->input->post('key')) {
					$key 			=	trim($this->input->post('key'));
					$data['query']	=	$this->Store_model->getStoreBykeyLimit($key,$per_page,$this->_limit);
				}
				else {
					$data['query']	= 	$this->Store_model->getStoreLimit($per_page,$this->_limit);
				}
			}

		$this->load->view("admincp/store/ajax_store_view",$data);
	}

	public function add()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Thêm mới cửa hàng";

			
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$this->load->view("admincp/head_view",$data);			
			$this->load->view("js/ckeditor_view");
			$this->load->view("js/elfinder_view");
			$this->load->view("js/bootbox_view");
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/store/add_view",$data);
			$this->load->view("admincp/footer_view");
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
			$data['titlepage'] 	= 	"Danh sách cửa hàng";

			$key = "";
			$id_group = "";
			if($this->input->get('id')) {
				$id_group			=	trim($this->input->get('id'));
				if($this->input->get('key')) {
					$key 			=	trim($this->input->get('key'));
					$num_rows		=	$this->Store_model->getStoreByGroupCodeName($id_group,$key,0);
				}
				else {
					$num_rows		= 	$this->Store_model->getStoreByGroup($id_group,0);
				}
			}
			else
			{
				if($this->input->get('key')) {
					$key 			=	trim($this->input->get('key'));
					$num_rows		=	$this->Store_model->getStoreBykey($key,0);
				}
				else {
					$num_rows		= 	$this->Store_model->getStore1(0);
				}
			}


			$data['id']			=	$id_group;
			$data['key']		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);

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
			$this->load->view("admincp/store/trash_view",$data);
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function paggingtrash()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$data['datestring'] 	= 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
			if($this->input->post('id') != "") {
				$id_group			=	trim($this->input->post('id'));
				$data['id']			=	$id_group;
				if($this->input->post('key')) {
					$key 			=	trim($this->input->post('key'));
					$data['query']	=	$this->Store_model->getStoreByGroupCodeNameLimit($id_group,$per_page,$this->_limit,$key,0);
				}
				else {
					$data['query']	= 	$this->Store_model->getStoreByGroupLimit($id_group,$per_page,$this->_limit,0);
				}
			}
			else
			{
				if($this->input->post('key')) {
					$key 			=	trim($this->input->post('key'));
					$data['query']	=	$this->Store_model->getStoreBykeyLimit($key,$per_page,$this->_limit,0);
				}
				else {
					$data['query']	= 	$this->Store_model->getStoreLimit($per_page,$this->_limit,0);
				}
			}

		$this->load->view("admincp/store/ajax_storetrash_view",$data);
	}

	public function update()
	{		
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Chỉnh sửa cửa hàng";

			
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$data['datestring'] = 	"%d/%m/%Y %h:%i";

			if($this->input->get('id')) {
				$id 					=	$this->input->get('id');
				$dataud['id']			=	$id;
				$dataud['storegroup']	=	$data['storegroup'];				
				$query 					=	$this->Store_model->getStoreById($id);
				foreach ($query as $row) {
					$dataud['name'] 		= 	$row->name;
					$dataud['name_contact'] = 	$row->name_contact;
					$dataud['username'] 	= 	$row->username;
					$dataud['phone'] 		= 	$row->phone;
					$dataud['email']		=	$row->email;
					$dataud['address']		=	$row->address;
					$dataud['website'] 		= 	$row->website;
					$dataud['logo'] 		= 	$row->logohome;
					$dataud['avatar'] 		= 	$row->avatar;
					$dataud['id_group'] 	= 	$row->id_group;
					$dataud['status'] 		= 	$row->status;
					$dataud['longitude'] 	= 	$row->longitude;
					$dataud['latitude'] 	= 	$row->latitude;
				}

				$this->load->view("admincp/head_view",$data);			
				$this->load->view("js/ckeditor_view");
				$this->load->view("js/elfinder_view");
				$this->load->view("js/bootbox_view");
				$this->load->view("admincp/endhead_view");			
				$this->load->view("controls/modals_view");
				$this->load->view("admincp/navigation_view",$datauser);
				$this->load->view("admincp/left_view",$data);
				$this->load->view("admincp/store/update_view",$dataud);
				$this->load->view("admincp/footer_view");
			}
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function checkanothername()
	{
		$bool 	= 	"0";
		$id 	=	$this->input->post('id');
		$name 	=	$this->input->post('name');
		if($this->Store_model->getStoreAnotherName($id,$name))
		{
			$bool 	= 	"1";
		}
		echo $bool;
	}

	public function checkanotherusername()
	{
		$bool 		= 	"0";
		$id 		=	$this->input->post('id');
		$username 	=	$this->input->post('username');
		if($this->Store_model->getStoreATUsername($id,$username))
		{
			$bool 	= 	"1";
		}
		echo $bool;
	}


	public function delete()
	{

	}
	
	public function status()
	{
		$id 		= 	$this->input->post('id');
		$status 	= 	$this->input->post('status');

		if($this->Store_model->updatestatus($id,$status))
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
		$success = "0";
		
		$id = $this->input->post('id');

		if($this->Store_model->movetrash($id)){
			$success = "1";
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

	public function movetrash()
	{
		$num = 1;
		$index = $this->input->post('hd_count');
		for($count = 1; $count <= $index; $count++)
		{
			//$this->form_validation->set_rules('check'.$count,'ID','trim|required|xss_clean');

			$id 	=	$this->input->post('check'.$count);
			//if($this->form_validation->run() == TRUE)
			//{
				if($this->Store_model->movetrash($id))
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

	public function outtrash()
	{
		$success = "0";
		
		$id = $this->input->post('id');

		if($this->Store_model->outtrash($id)){
			$success = "1";
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

	public function addStore()
	{
		$status 			=	"";
		$msg 				=	"";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtName', 'Name', 'trim|required|xss_clean|callback_checknameinput');
		$this->form_validation->set_rules('txtNameSub', 'Title', 'trim|required|xss_clean|callback_checktitleinput');
		$this->form_validation->set_rules('txtNameContact', 'Name Manager Store', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtUsername', 'Username For Store', 'trim|required|xss_clean|callback_checkusernameinput');
		$this->form_validation->set_rules('txtPassword','Password', 'trim|required|min_length[6]|max_length[20]|xss_clean'); 
		$this->form_validation->set_rules('txtRePassword','Confirm Password', 'trim|required|matches[txtPassword]|min_length[6]|max_length[20]|xss_clean'); 
		$this->form_validation->set_rules('txtEmail', 'Email', 'trim|required|valid_email|xss_clean');
		if($this->form_validation->run() == FALSE)
		{
			$status = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else
		{	
			$query 			=	$this->Store_model->getId();
			foreach($query as $row)
        	{
          		$id   =   ($row->id != "") ? $row->id : 1;
        	}
        	$datastring 	=	"%Y/%m/%d %h:%m:%i";
			$date_added 	=	mdate($datastring, time() - 60*60);
			$last_modified 	=	mdate($datastring, time() - 60*60);

			$code 			=	"ST".str_pad($id,6,"0", STR_PAD_LEFT);
			$name 			=	$this->input->post('txtName');
			$title 			=	$this->input->post('txtNameSub');
			$name_contact	=	$this->input->post('txtNameContact');
			$username 		=	$this->input->post('txtUsername');
			$password 		= 	$this->input->post('txtPassword');
			$email 			=	$this->input->post('txtEmail');
			$phone 			=	$this->input->post('txtPhone');
			$address		=	$this->input->post('txtAddress');
			$website		=	$this->input->post('txtWebsite');
			$logohome 		=	$this->input->post('txtLogo');
			$avatar			=	$this->input->post('txtImages');
			$id_group		=	$this->input->post('slGroup');
			$status			=	$this->input->post('slStatus');

			$longitude 		=	$this->input->post('hd_longitude'); //kinh độ
			$latitude 		=	$this->input->post('hd_latitude'); //vĩ độ

			$arrayName 		= array(
								'id_group'		=>		$id_group,
								'code' 			=> 		$code, 
								'name'			=> 		$name,
								'title'			=>		$title,
								'username'		=>		$username,
								'password'		=>		md5($password),
								'name_contact'	=>		$name_contact,
								'email'			=>		$email,
								'phone'			=>		$phone,
								'address'		=>		$address,
								'website'		=>		$website,
								'logohome'		=>		$logohome,
								'avatar'		=>		$avatar,
								'longitude'		=>		$longitude,
								'latitude'		=>		$latitude,
								'status'		=>		$status,
								'date_added'	=>		$date_added,
								'last_modified'	=>		$last_modified
							);
			if($this->Store_model->insert($arrayName))
			{
				$status 		= 	"0";
				$msg 			=	"Các thông tin đã được cập nhật thành công";
				$path 			= 	"public/upload/store/".$title;

			    if(!is_dir($path)) //create the folder if it's not already exists
			    {
			      mkdir($path,0755,TRUE);
			    } 
			}
			else
			{
				$status 		= 	"1";
				$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
			}
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));

	}

	public function updateStore()
	{
		
		$status 			=	"";
		$msg 				=	"";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtName', 'Name', 'trim|required|xss_clean|callback_checknameATinput');
		$this->form_validation->set_rules('txtNameContact', 'Name Manager Store', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtUsername', 'Username For Store', 'trim|required|xss_clean|callback_checkusernaATinput');
		//$this->form_validation->set_rules('txtPassword','Password', 'required|min_length[6]|max_length[20]'); 
		//$this->form_validation->set_rules('txtRePassword','Confirm Password', 'trim|required|matches[txtPassword]|min_length[6]|max_length[20]|xss_clean'); 
		$this->form_validation->set_rules('txtEmail', 'Email', 'trim|required|valid_email|xss_clean');
		if($this->form_validation->run() == FALSE)
		{
			$status = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else
		{	
			

        	$datastring 	=	"%Y/%m/%d %h:%m:%i";
			$last_modified 	=	mdate($datastring, time() - 60*60);

			$name 			=	$this->input->post('txtName');
			$name_contact	=	$this->input->post('txtNameContact');
			$username 		=	$this->input->post('txtUsername');
			//$password 		= 	$this->input->post('txtPassword');
			$email 			=	$this->input->post('txtEmail');
			$phone 			=	$this->input->post('txtPhone');
			$address		=	$this->input->post('txtAddress');
			$website		=	$this->input->post('txtWebsite');
			$logohome 		=	$this->input->post('txtLogo');
			$avatar			=	$this->input->post('txtImages');
			$id_group		=	$this->input->post('slGroup');
			$status			=	$this->input->post('slStatus');

			$longitude 		=	$this->input->post('hd_longitude'); //kinh độ
			$latitude 		=	$this->input->post('hd_latitude'); //vĩ độ

			$id 			=	$this->input->post('hd_id');
			$arrayName 		= array(
								'id_group'		=>		$id_group,								
								'name'			=> 		$name,
								'username'		=>		$username,
								'password'		=>		md5($password),
								'name_contact'	=>		$name_contact,
								'email'			=>		$email,
								'phone'			=>		$phone,
								'address'		=>		$address,
								'website'		=>		$website,
								'logohome'		=>		$logohome,
								'avatar'		=>		$avatar,
								'longitude'		=>		$longitude,
								'latitude'		=>		$latitude,
								'status'		=>		$status,
								'last_modified'	=>		$last_modified
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

	public function checkname()
	{
		$echo 	= 	"0";
		$name 	=	$this->input->post('name');
		if($name != "") 
		{
			if($this->Store_model->getStoreByName($name))
			{
				$echo = "1";
			}			
		}
		echo $echo;
	}

	public function checknameinput()
	{
		$bool 	=	FALSE;
		$name 	=	$this->input->post('txtName');		
		if($this->Store_model->getStoreByName($name) == FALSE)
		{
			$bool = TRUE;
		}
		return $bool;		
	}

	public function checkusername()
	{
		$echo 		=	"0";
		$username	=	$this->input->post('username');
		if($username != "") 
		{
			if($this->Store_model->getStoreByUsername($username))
			{
				$echo = "1";
			}
		}
		echo $echo;
	}

	public function checkusernameinput()
	{
		$bool 	= FALSE;
		$username	=	$this->input->post('txtUsername');		
		if($this->Store_model->getStoreByUsername($username) == FALSE)
		{
			$bool = TRUE;
		}
		return $bool;
	}
	public function checkusernaATinput()
	{
		$bool 	=	FALSE;
		$id 	=	$this->input->post('hd_id');	
		$name 	=	$this->input->post('txtName');		
		if($this->Store_model->getStoreAnotherName($id,$name) == FALSE)
		{
			$bool = TRUE;
		}
		return $bool;	
	}

	public function checknameATinput()
	{
		$bool 	=	FALSE;
		$id 	=	$this->input->post('hd_id');	
		$name 	=	$this->input->post('txtName');		
		if($this->Store_model->getStoreAnotherName($id,$name) == FALSE)
		{
			$bool = TRUE;
		}
		return $bool;	
	}

	public function checktitle()
	{
		$echo 	=	"0";
		$title	=	$this->input->post('title');
		if($title != "") 
		{
			if($this->Store_model->getStoreByTitle($title))
			{
				$echo = "1";
			}			
		}
		echo $echo;
	}

	public function checktitleinput()
	{
		$bool 	= FALSE;
		$title	=	$this->input->post('txtNameSub');		
		if($this->Store_model->getStoreByTitle($title) == FALSE)
		{
			$bool = TRUE;
		}
		return $bool;
	}


	//Page Store Group
	public function group()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Danh sách nhóm cửa hàng";

			$key 	= "";
			if($this->input->get('key')) {
				$key 			=	trim($this->input->get('key'));
				$num_rows		=	$this->Storegroup_model->getStoreGroupByCodeOrName($key);
			}
			else {
				$num_rows		= 	$this->Storegroup_model->getStoreGroup1();
			}
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$data['key']		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);

			$data['index'] 		= 	0;
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/store/group_view",$data);
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function pagginggroup()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$data['datestring'] = 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));
			$data['query']	=	$this->Storegroup_model->getStoreGroupByCodeOrNameLimit($key,$per_page,$this->_limit);
		}
		else
		{
			$data['query']		=	$this->Storegroup_model->getStoreGroupLimit($per_page,$this->_limit);
		}
		$this->load->view("admincp/store/ajax_group_view",$data);
	}

	public function trashg()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Nhóm cửa hàng đã xóa";

			$key 	= "";
			if($this->input->get('key')) {
				$key 			=	trim($this->input->get('key'));
				$num_rows		=	$this->Storegroup_model->getStoreGroupByCodeOrName($key,0);
			}
			else {
				$num_rows		= 	$this->Storegroup_model->getStoreGroup1(0);
			}
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$data['key']		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);
			
			$data['index']		=	0;
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/store/grouptrash_view",$data);
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function pagginggrouptrash()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$data['datestring'] = 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));
			$data['query']	=	$this->Storegroup_model->getStoreGroupByCodeOrNameLimit($key,$per_page,$this->_limit,0);
		}
		else
		{
			$data['query']		=	$this->Storegroup_model->getStoreGroupLimit($per_page,$this->_limit,0);
		}
		$this->load->view("admincp/store/ajax_grouptrash_view",$data);
	}

	public function addg()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Thêm mới nhóm cửa hàng";

			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/store/addgroup_view");
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect("admincp");
		}
	}

	public function updateg()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Thêm mới nhóm cửa hàng";

			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			if($this->input->get('id')) {
				$id 				=	$this->input->get('id');
				$data['id']			=	$id;
				if($this->Storegroup_model->getStoreGroupById($id))
				{
					$query			=	$this->Storegroup_model->getStoreGroupById($id);
					foreach ($query as $row) {
						# code...
						$data['code']				=	$row->code;
						$data['name']				=	$row->name;
						$data['detail']				=	$row->detail;
						$data['status']				=	$row->status;
					}
				}
				$data['datestring'] = 	"%d/%m/%Y %h:%i";
				$this->load->view("admincp/head_view",$data);
				$this->load->view("js/bootbox_view");
				$this->load->view("admincp/endhead_view");			
				$this->load->view("controls/modals_view");
				$this->load->view("admincp/navigation_view",$datauser);
				$this->load->view("admincp/left_view",$data);
				$this->load->view("admincp/store/updategroup_view",$data);
				$this->load->view("admincp/footer_view");
			}
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function addStoreg()
	{
		$status 	=	"";
		$msg 		=	"";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtCode', 'Code', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtName', 'Name', 'trim}required|xss_clean|callback_checkSGBeforeInsert');
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
			$detail				=	$this->input->post('txtDescription');		
			$status				=	$this->input->post('slStatus');
			$arrayName = array(
								'code' 			=> 		$code, 
								'name'			=>		$name,
								'detail'		=>		$detail,
								'status'		=>		$status,
								'date_added'	=>		$data_added,
								'last_modified'	=>		$last_modified
						);
			if($this->Storegroup_model->insert($arrayName))
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

	public function updateStoreg()
	{
		$status 	=	"";
		$msg 		=	"";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtCode', 'Code', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtName', 'Name', 'trim}required|xss_clean|callback_checkSGBeforeUpdate');
		if($this->form_validation->run() == FALSE)
		{
			$status = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else
		{
			$datestring         =   "%Y/%m/%d %h:%i:%s";
	        $last_modified      =   mdate($datestring, time() - 60*60);
			$code 				= 	$this->input->post('txtCode');
			$name 				=	$this->input->post('txtName');	
			$detail				=	$this->input->post('txtDescription');		
			$status				=	$this->input->post('slStatus');

			$id 				=	$this->input->post('hd_id');
			$arrayName = array(
								'code' 			=> 		$code, 
								'name'			=>		$name,
								'detail'		=>		$detail,
								'status'		=>		$status,
								'last_modified'	=>		$last_modified
						);
			if($this->Storegroup_model->update($arrayName, $id))
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

	public function checkSGBeforeInsert()
	{
		$bool 		=	FALSE;
		$code 		=	$this->input->post('txtCode');
		$name 		=	$this->input->post('txtName');

		if($this->Storegroup_model->getStoreGroupByCode($code) == FALSE)
		{
			if($this->Storegroup_model->getStoreGroupByName($name) == FALSE)
			{
				$bool = TRUE;
			}			
		}
		return $bool;
	}

	public function checkSGBeforeUpdate()
	{
		$bool 		=	FALSE;
		$code 		=	$this->input->post('txtCode');
		$name 		=	$this->input->post('txtName');
		$id 		=	$this->input->post('hd_id');

		if($this->Storegroup_model->getStoreGroupAnotherCode($id,$code) == FALSE)
		{
			if($this->Storegroup_model->getStoreGroupAnotherName($id,$name) == FALSE)
			{
				$bool = TRUE;
			}
		}
		return $bool;
	}

	public function statusg()
	{
		$id 		= 	$this->input->post('id');
		$status 	= 	$this->input->post('status');

		if($this->Storegroup_model->updatestatus($id,$status))
		{
			$messages = "Dữ liệu cập nhật thành công";
			$success  = "1";
			$this->Store_model->updatestatusByGroup($id,$status);
		}
		else
		{
			$messages = "Dữ liệu cập nhật thất bại";
			$success  = "0";
		}
		$arrayName = array('msg' => $messages, 'info' => $success, 'status' => $status);
		echo json_encode($arrayName);
	}

	public function blockg()
	{
		$success = "0";
		
		$id = $this->input->post('id');

		if($this->Storegroup_model->movetrash($id)){
			$success = "1";
			$this->Store_model->movetrashByGroup($id);
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

	public function movetrashg()
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
				if($this->Storegroup_model->movetrash($id))
				{
					$num++;
					$this->Store_model->movetrashByGroup($id);
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

	public function outtrashg()
	{	
		$success = "0";
		
		$id = $this->input->post('id');

		if($this->Storegroup_model->outtrash($id)){
			$success = "1";
			$this->Store_model->outtrashByGroup($id);
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

	public function deletegall()
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
				if($this->Storegroup_model->delete($id))
				{
					$num++;
					$this->Store_model->deleteByGroup($id);
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

	public function deleteg()
	{
		$id = $this->input->post('id');

		if($this->Storegroup_model->delete($id)){
			$success = "1";
			$this->Store_model->deleteByGroup($id);
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

	public function checkcodeg()
	{
		$code 	=	$this->input->post('code');
		if($code != "") 
		{
			if($this->Storegroup_model->getStoreGroupByCode($code))
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

	public function checkanothercodeg()
	{
		$code 	=	$this->input->post('code');
		$id 	=	$this->input->post('id');
		if($code != "") 
		{
			if($this->Storegroup_model->getStoreGroupAnotherCode($id,$code))
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

	public function checknameg()
	{
		$name 	=	$this->input->post('name');
		if($name != "") 
		{
			if($this->Storegroup_model->getStoreGroupByName($name))
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

	public function checkanothernameg()
	{
		$name 	=	$this->input->post('name');
		$id 	=	$this->input->post('id');
		if($name != "") 
		{
			if($this->Storegroup_model->getStoreGroupAnotherName($id,$name))
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
}