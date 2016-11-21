<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partner extends CI_Controller {
	private $_limit 	=	10;
	public function __construct(){
		parent::__construct();		
		$this->load->Model('Partner_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Danh sách đối tác";

			$key 	=	"";
			if($this->input->get('key')) {
				$key 			=	trim($this->input->get('key'));
				$num_rows		=	$this->Partner_model->getPartnerByCodeOrName($key);
			}
			else {
				$num_rows		= 	$this->Partner_model->getPartner1();
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
			$this->load->view("admincp/partner/partner_view",$data);
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function pagging()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$data['datestring'] = 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));
			$data['query']	=	$this->Partner_model->getPartnerByCodeOrNameLimit($key,$per_page,$this->_limit);
		}
		else
		{
			$data['query']		=	$this->Partner_model->getPartnerLimit($per_page,$this->_limit);
		}
		$this->load->view("admincp/partner/ajax_partner_view",$data);
	}

	public function add()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['titlepage'] 	= 	"Thêm mới đối tác";
			$session_data 		= 	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['group']		=	$session_data['group'];
			
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");				
			$this->load->view("js/elfinder_view");	
			$this->load->view("admincp/endhead_view");
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/partner/add_view",$data);
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
			$data['titlepage'] 	= 	"Chỉnh sửa đối tác";
			$session_data 		= 	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			if($this->input->get('id')) {
				$id 				=	$this->input->get('id');
				$data['id']			=	$id;
				if($this->Partner_model->getPartnerByid($id))
				{
					$query			=	$this->Partner_model->getPartnerByid($id);
					foreach ($query as $row) {
						# code...
						$data['code']				=	$row->code;
						$data['name']				=	$row->name;
						$data['email']				=	$row->email;
						$data['phone']				=	$row->phone;
						$data['link']				=	$row->link;
						$data['logo']				=	$row->logo;
						$data['detail']				=	$row->detail;
						$data['status']				=	$row->status;
					}
				}
				$this->load->view("admincp/head_view",$data);
				$this->load->view("js/bootbox_view");				
				$this->load->view("js/elfinder_view");	
				$this->load->view("admincp/endhead_view");
				$this->load->view("controls/modals_view");
				$this->load->view("admincp/navigation_view",$datauser);
				$this->load->view("admincp/left_view",$data);
				$this->load->view("admincp/partner/update_view",$data);
				$this->load->view("admincp/footer_view",$data);
			}
		}		
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function addPartner()
	{
		$status 	=	"";
		$msg 		=	"";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtCode', 'Code', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtName', 'Name', 'trim|required|xss_clean|callback_checkpartnerbeforeinsert');		
		$this->form_validation->set_rules('txtEmail', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('txtPhone', 'Phone', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('txtLink', 'Link', 'trim|xss_clean');
		$this->form_validation->set_rules('txtImages', 'Logo', 'trim|xss_clean');
		$this->form_validation->set_rules('txtDescription', 'Description','trim|xss_clean');

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
			$email 				=	$this->input->post('txtEmail');
			$phone 				=	$this->input->post('txtPhone');
			$code 				= 	$this->input->post('txtCode');	
			$link				=	$this->input->post('txtLink');
			$logo 				=	$this->input->post('txtImages');
			$detail				=	$this->input->post('txtDescription');	
			$status				=	$this->input->post('slStatus');				

			$arrayName = array(
								'code' 			=> 		$code, 
								'name'			=>		$name,
								'email'			=>		$email,
								'phone'			=>		$phone,
								'link'			=>		$link,
								'logo'			=>		$logo,
								'detail'		=>		$detail,
								'status'		=>		$status,
								'date_added'	=>		$data_added,
								'last_modified'	=>		$last_modified
						);
			if($this->Partner_model->insert($arrayName))
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

	public function updatePartner()
	{
		$status 	=	"";
		$msg 		=	"";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtCode', 'Code', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtName', 'Name', 'trim|required|xss_clean|callback_checkpartnerbeforeupdate');				
		$this->form_validation->set_rules('txtEmail', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('txtPhone', 'Phone', 'trim|required|numeric|xss_clean');	
		$this->form_validation->set_rules('txtLink', 'Link', 'trim|xss_clean');
		$this->form_validation->set_rules('txtImages', 'Logo', 'trim|xss_clean');
		$this->form_validation->set_rules('txtDescription', 'Description','trim|xss_clean');

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
			$email 				=	$this->input->post('txtEmail');
			$phone 				=	$this->input->post('txtPhone');
			$code 				= 	$this->input->post('txtCode');	
			$link				=	$this->input->post('txtLink');
			$logo 				=	$this->input->post('txtImages');
			$detail				=	$this->input->post('txtDescription');	
			$status				=	$this->input->post('slStatus');				
			$id 				=	$this->input->post('hd_id');
			$arrayName = array(
								'code' 			=> 		$code, 
								'name'			=>		$name,								
								'email'			=>		$email,
								'phone'			=>		$phone,
								'link'			=>		$link,
								'logo'			=>		$logo,
								'detail'		=>		$detail,
								'status'		=>		$status,
								'last_modified'	=>		$last_modified
						);
			if($this->Partner_model->update($arrayName, $id))
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

	public function trash()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Danh sách đối tác đã xóa";

			$key 	=	"";
			if($this->input->get('key')) {
				$key 			=	trim($this->input->get('key'));
				$num_rows		=	$this->Partner_model->getPartnerByCodeOrName($key,0);
			}
			else {
				$num_rows		= 	$this->Partner_model->getPartner1(0);
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
			$this->load->view("admincp/partner/trash_view",$data);
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
		$data['datestring'] = 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));
			$data['query']	=	$this->Partner_model->getPartnerByCodeOrNameLimit($key,$per_page,$this->_limit,0);
		}
		else
		{
			$data['query']		=	$this->Partner_model->getPartnerLimit($per_page,$this->_limit,0);
		}
		$this->load->view("admincp/partner/ajax_trash_view",$data);
	}

	public function checkpartnerbeforeinsert()
	{
		$bool 	=	FALSE;
		$code 	=	$this->input->post('txtCode');
		$name 	=	$this->input->post('txtName');

		if($this->Partner_model->getPartnerByCode($code) == FALSE)
		{
			if($this->Partner_model->getPartnerByName($name) == FALSE)
			{
				$bool = TRUE;
			}			
		}
		return $bool;
	}

	public function checkpartnerbeforeupdate()
	{
		$bool	=	FALSE;
		$code 	=	$this->input->post('txtCode');
		$name 	=	$this->input->post('txtName');
		$id 	=	$this->input->post('hd_id');
		if($this->Partner_model->getPartnerAnotherCode($id, $code) == FALSE)
		{
			if($this->Partner_model->getPartnerAnotherName($id, $name) == FALSE)
			{
				$bool = TRUE;
			}			
		}
		return $bool;
	}

	public function checkname()
	{
		$echo 	= "0";
		$name	=	$this->input->post('name');
		if($name != "") 
		{
			if($this->Partner_model->getPartnerByName($name))
			{
				$echo = "1";
			}			
		}
		echo $echo;
	}

	public function checkcode()
	{
		$echo 	= "0";
		$code	=	$this->input->post('code');
		if($code != "") 
		{
			if($this->Partner_model->getPartnerByCode($code))
			{
				$echo 	= "1";
			}			
		}
		echo $echo;
	}

	public function checkanothername()
	{
		$echo 	=	"0";
		$name	=	$this->input->post('name');
		$id 	=	$this->input->post('id');
		if($name != "") 
		{
			if($this->Partner_model->getPartnerAnotherName($id, $name))
			{
				$echo = "1";
			}			
		}
		echo $echo;
	}

	public function checkanothercode()
	{
		$echo 	=	"0";
		$code	=	$this->input->post('code');
		$id 	=	$this->input->post('id');
		if($code != "") 
		{
			if($this->Partner_model->getPartnerAnotherCode($id, $code))
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
				if($this->Partner_model->movetrash($id))
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

		if($this->Partner_model->updatestatus($id,$status))
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

		if($this->Partner_model->movetrash($id)){
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

		if($this->Partner_model->delete($id)){
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

		if($this->Partner_model->outtrash($id)){
			$success = "1";
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

	public function deleteall()
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
				if($this->Partner_model->delete($id))
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