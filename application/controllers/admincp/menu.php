<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {

	private $_limit 	=	10;
	public function  __construct() {
        parent::__construct();
		$this->load->Model("Menu_model");
	}
	
	public function test() {
		$query =	array();
		$query['parent'] = $this->Menu_model->getParentMenu();

		$index = 0;
		$query['child'] = array();
		$data['index'] = 0;
		$temp = $query['parent'];
		foreach ($temp as $key) {
			$id_parent = $key->id;
			$query['child'][$index] = $this->Menu_model->getChildrenMenu($id_parent);
			$index++;
		}
		
		$data['query'] = $query;
		$this->load->view('admincp/menu/test',$data);
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		= 	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Danh sách menu";	

			$key = "";
			if($this->input->get('key')) {
				$key 				=	trim($this->input->get('key'));
				$num_rows			=	$this->Menu_model->getMenuByCodeOrName($key,1);
			}
			else {
				$num_rows			= 	$this->Menu_model->getALLMenu(1);				
			}
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
			$this->load->view("admincp/menu/menu_view",$data);
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function pagging_menu()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start* $this->_limit;
		$data['index']			=	0;
		$data['datestring'] 	= 	"%d/%m/%Y %h:%i";
		if($this->input->post('key') != "") {
			$key 				=	trim($this->input->post('key'));
			$data['query']		=	$this->Menu_model->getMenuCN($key,1,$per_page,$this->_limit);
		}
		else {			
				$data['query']		=	$this->Menu_model->getMenu(1,$per_page,$this->_limit);
		}
		$this->load->view("admincp/menu/ajax_menu_view",$data);
	}

	public function trash()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		= 	$this->session->userdata('logged_in');
			$datauser['name'] 		= 	$session_data['name'];
			$datauser['avatar'] 	= 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Danh sách menu đã xóa";	
			$key = "";
			if($this->input->get('key')) {
				$key 				=	trim($this->input->get('key'));
				$num_rows			=	$this->Menu_model->getMenuByCodeOrName($key,0);
			}
			else {
				$num_rows			= 	$this->Menu_model->getALLMenu(0);				
			}
			$data['key']		=	$key;			
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);
			
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
			$this->load->view("admincp/menu/del_view",$data);
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function pagging_menutrash()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start* $this->_limit;
		$data['index']			=	0;
		$data['datestring'] = 	"%d/%m/%Y %h:%i";
		if($this->input->post('key') != "") {
			$key 				=	trim($this->input->post('key'));
			$data['query']		=	$this->Menu_model->getMenuCN($key,0,$per_page,$this->_limit);
		}
		else {			
				$data['query']		=	$this->Menu_model->getMenu(0,$per_page,$this->_limit);
		}
		$this->load->view("admincp/menu/ajax_menutrash_view",$data);
	}

	//Form thêm mới menu
	public function add()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		= 	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Thêm mới menu";
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['query']		=	$this->Menu_model->getParentMenu();
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$this->load->view("admincp/head_view",$data);	
			$this->load->view("js/validation_view");		
			$this->load->view("js/bootbox_view");
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/menu/add_view",$data);			
			$this->load->view("admincp/footer_view");
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	//Form thêm mới menu
	public function update()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		= 	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Chỉnh sửa menu";
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['query']		=	$this->Menu_model->getParentMenu();
			if($this->input->get('id')) {
				$id 				=	$this->input->get('id');
				$data['id']			=	$id;
				if($this->Menu_model->getMenuByid($id))
				{
					$query			=	$this->Menu_model->getMenuByid($id);
					foreach ($query as $row) {
						# code...
						$data['code']				=	$row->code;
						$data['id_parent']			=	$row->id_parent;
						$data['name']				=	$row->name;
						$data['title']				=	$row->title;
						$data['link']				=	$row->link;
						$data['sort']				=	$row->sort;
						$data['status']				=	$row->status;
						$data['keyword']			=	$row->keyword;
						$data['description']		=	$row->description;
					}
				}
			
				$data['result']		= 	$this->Emailcategory_model->getCategory();
				$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
				
				$this->load->view("admincp/head_view",$data);	
				$this->load->view("js/validation_view");		
				$this->load->view("js/bootbox_view");
				$this->load->view("admincp/endhead_view");			
				$this->load->view("controls/modals_view");
				$this->load->view("admincp/navigation_view",$datauser);
				$this->load->view("admincp/left_view",$data);
				$this->load->view("admincp/menu/update_view",$data);				
				$this->load->view("admincp/footer_view");
			}
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function addMenu()
	{

			$status 			=	"";
			$msg 				=	"";
		//Load Library form_validation of Codeigniter
		$this->load->library('form_validation');

		//Set rules for input
		$this->form_validation->set_rules('txtCode','Code','trim|required|xss_clean');
		$this->form_validation->set_rules('txtName','Name','trim|required|xss_clean|callback_checkMenuBeforeInsert');
		if($this->form_validation->run() == FALSE) {
			$status = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else {			
			$datestring         =   "%Y/%m/%d %h:%i:%s";
			$data_added			=	mdate($datestring, time() - 60*60);
	        $last_modified      =   mdate($datestring, time() - 60*60);
			$code 				= 	$this->input->post('txtCode');
			$parent 			=	$this->input->post('slParent');
			$name 				=	$this->input->post('txtName');
			$title 				= 	$this->input->post('txtNameSub');
			$link				=	$this->input->post('txtLink');
			$sort				=	$this->input->post('txtSort');
			$status				=	$this->input->post('slStatus');
			$keyword			=	$this->input->post('txtKeyword');
			$description		=	$this->input->post('txtDescription');

			$arrayName = array(
								'code' 			=> 		$code, 
								'type'			=> 		'1',
								'name'			=>		$name,
								'title'			=>		$title,
								'keyword'		=>		$keyword,
								'description'	=>		$description,
								'link'			=>		$link,
								'id_parent'		=> 		$parent,
								'sort'			=>		$sort,
								'status'		=>		$status,
								'date_added'	=>		$data_added,
								'last_modified'	=>		$last_modified
							);
			if($this->Menu_model->insertMenu($arrayName))
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

	public function updateMenu()
	{
		$status 			=	"";
		$msg 				=	"";
		//Load Library form_validation of Codeigniter
		$this->load->library('form_validation');

		//Set rules for input
		$this->form_validation->set_rules('txtCode','Code','trim|required|xss_clean');
		$this->form_validation->set_rules('txtName','Name','trim|required|xss_clean|callback_checkMenuBeforeUpdate');
		if($this->form_validation->run() == FALSE) {
			$status = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else {		
			$datestring         =   "%Y/%m/%d %h:%i:%s";
	        $last_modified      =   mdate($datestring, time() - 60*60);
			$code 				= 	$this->input->post('txtCode');
			$parent 			=	$this->input->post('slParent');
			$name 				=	$this->input->post('txtName');
			$title 				= 	$this->input->post('txtNameSub');
			$link				=	$this->input->post('txtLink');
			$sort				=	$this->input->post('txtSort');
			$status				=	$this->input->post('slStatus');
			$keyword			=	$this->input->post('txtKeyword');
			$description		=	$this->input->post('txtDescription');

			//Menu id
			$id 				=	$this->input->post('hd_id');
			

			$arrayName = array(
								'code' 			=> 		$code, 
								'type'			=> 		'1',
								'name'			=>		$name,
								'title'			=>		$title,
								'keyword'		=>		$keyword,
								'description'	=>		$description,
								'link'			=>		$link,
								'id_parent'		=> 		$parent,
								'sort'			=>		$sort,
								'status'		=>		$status,
								'last_modified'	=>		$last_modified
							);
			
			if($this->Menu_model->updateMenu($arrayName, $id))
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

	public function checkMenuBeforeInsert()
	{
		$bool	=	FALSE;
		$code	= 	$this->input->post('txtCode');
		$name 	=	$this->input->post('txtName');
		if($this->Menu_model->getMenuByCode($code) == FALSE)
		{
			if($this->Menu_model->getMenuByName($name) == FALSE)
			{
				$bool = TRUE;
			}			
		}
		return $bool;
	}

	public function checkMenuBeforeUpdate()
	{
		$bool 	=	FALSE;
		$code	= 	$this->input->post('txtCode');
		$name 	=	$this->input->post('txtName');
		//Menu id
		$id 	=	$this->input->post('hd_id');
		if($this->Menu_model->getMenuAnotherCode($id, $code) == FALSE)
		{
			if($this->Menu_model->getMenuAnotherName($id, $name) == FALSE)
			{
				$bool = TRUE;
			}			
		}
		return $bool;
	}

	public function checkcode()
	{
		$echo 	= "0";
		$code 	= $this->input->post('code');
		if($code != "") {
			if($this->Menu_model->getMenuByCode($code))
			{
				$echo 	= "1";
			}			
		}
		echo $echo;
	}

	public function checkname()
	{
		$echo 	= "0";
		$name 	= $this->input->post('name');
		if($name != "") {
			if($this->Menu_model->getMenuByName($name))
			{
				$echo 	= "1";
			}			
		}	
		echo $echo;	
	}

	public function checkanothercode()
	{		
		$echo =	"0";
		$code = $this->input->post('code');
		$id   =	$this->input->post('id');
		if($code != "") {
			if($this->Menu_model->getMenuAnotherCode($id, $code))
			{
				$echo = "1";
			}			
		}
		echo $echo;
	}

	public function checkanothername()
	{
		$echo = "0";
		$name = $this->input->post('name');
		$id   =	$this->input->post('id');
		if($name != "") {
			if($this->Menu_model->getMenuAnotherName($id, $name))
			{
				$echo 	= "1";
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
				if($this->Menu_model->movetrash($id))
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

	public function movetrasha()
	{
		//Load Library form_validation of Codeigniter
		//$this->load->library('form_validation');

		
		$id = $this->input->post('id');

		if($this->Menu_model->movetrash($id)){
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

		if($this->Menu_model->outtrash($id)){
			$success = "1";
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);		
	}

	public function status()
	{
		$id 		= 	$this->input->get('id');
		$status 	= 	$this->input->get('status');

		if($this->Menu_model->updatestatus($id,$status))
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
		$id = $this->input->post('id');

		if($this->Menu_model->delete($id)){
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
		//$this->load->library('form_validation');

		$num = 1;
		$index = $this->input->post('hd_count');
		for($count = 1; $count <= $index; $count++)
		{
			//$this->form_validation->set_rules('check'.$count,'ID','trim|required|xss_clean');

			$id 	=	$this->input->post('check'.$count);
			//if($this->form_validation->run() == TRUE)
			//{
				if($this->Menu_model->delete($id))
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

}

/* End of file menu.php */
/* Location: ./application/controllers/admincp/menu.php */