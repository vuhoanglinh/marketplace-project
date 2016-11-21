<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Themes extends CI_Controller {

	private $_limit 	=	10;
	public function __construct() {
		parent::__construct();	
		$this->load->Model('Store_themes_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Danh sách template";

			$key = "";
			if($this->input->get('key'))
			{
				$key 			=	$this->input->get('key');
				$num_rows		=	$this->Store_themes_model->getThemesLikeName($key);
			}
			else
			{
				$num_rows		=	$this->Store_themes_model->getThemes();
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
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/themes/themes_view",$data);
			$this->load->view("admincp/footer_view");
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
			$session_data 		=	$this->session->userdata('logged_in');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage'] 	= 	"Thêm mới template";

			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			$data['index']		=	0;
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/bootbox_view");
			$this->load->view("js/ckeditor_view");	
			$this->load->view("js/ckfinder_view");		
			$this->load->view("admincp/endhead_view");			
			$this->load->view("controls/modals_view");
			$this->load->view("admincp/navigation_view",$datauser);
			$this->load->view("admincp/left_view",$data);
			$this->load->view("admincp/themes/add_view",$data);
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
			$data['titlepage'] 	= 	"Thêm mới template";

			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['result']		= 	$this->Emailcategory_model->getCategory();
			$data['storegroup']	=	$this->Storegroup_model->getStoreGroup();
			
			if($this->input->get('id')) {
				$data['id'] 	=	$this->input->get('id');

				$query 			=	$this->Store_themes_model->getThemesById($id);
				foreach ($query as $row) {
					$data['name'] 	=	$row->name;
					$data['folder'] =	$row->folder;
					$data['image1'] =	$row->image1;
					$data['image2'] =	$row->image2;
					$data['image3']	=	$row->image3;
					$data['image4'] =	$row->image4;
					$data['detail'] =	$row->detail;
					$data['status'] =	$row->status;

				}
				
				$data['index']		=	0;
				$this->load->view("admincp/head_view",$data);
				$this->load->view("js/bootbox_view");
				$this->load->view("js/ckeditor_view");	
				$this->load->view("js/ckfinder_view");		
				$this->load->view("admincp/endhead_view");			
				$this->load->view("controls/modals_view");
				$this->load->view("admincp/navigation_view",$datauser);
				$this->load->view("admincp/left_view",$data);
				$this->load->view("admincp/themes/update_view",$data);
				$this->load->view("admincp/footer_view");	
			}
			else {
				redirect(base_url("admincp/login"), "location");
			}			
		}
		else
		{
			redirect(base_url("admincp/login"), "location");
		}
	}

	public function addThemes()
	{
		$stt 	=	"";
		$msg 	=	"";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtName', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtFolder', 'Folder', 'trim|required|xss_clean|callback_check');
		if($this->form_validation->run() == FALSE)
		{
			$stt 	= "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else
		{
			$datestring         =   "%Y/%m/%d %h:%i:%s";
			$date_added			=	mdate($datestring, time() - 60*60);
	        $last_modified      =   mdate($datestring, time() - 60*60);

	        $name 				=	$this->input->post('txtName');
	        $folder 			=	$this->input->post('txtFolder');
	        $image1 			=	$this->input->post('txtImage1');
	        $image2 			=	$this->input->post('txtImage2');
	        $image3 			=	$this->input->post('txtImage3');
	        $image4 			=	$this->input->post('txtImage4');
	        $detail 			=	$this->input->post('txtDetail');
			$status				=	$this->input->post('slStatus');	


	        $arrayName 		= 	array(
	        					'name' 			=>	$name,
	        					'folder'		=>	$folder,
	        					'image1'		=>	$image1,
	        					'image2'		=>	$image2,
	        					'image3'		=>	$image3,
	        					'image4'		=>	$image4,
	        					'detail'		=>	$detail,		        					
								'status'		=>	$status,
								'date_added'	=>	$date_added,
								'last_modified'	=>	$last_modified
	        				);

	        $stt 			= 	"1";
			$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
	        if($this->Store_themes_model->insert($arrayName)){
	        	$stt 			= 	"0";
				$msg 			=	"Các thông tin đã được cập nhật thành công";
	        }
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function updateThemes()
	{
		$stt 	=	"";
		$msg 	=	"";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtName', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtFolder', 'Folder', 'trim|required|xss_clean|callback_check');
		if($this->form_validation->run() == FALSE)
		{
			$stt 	= "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else
		{
			$datestring         =   "%Y/%m/%d %h:%i:%s";
			$date_added			=	mdate($datestring, time() - 60*60);
	        $last_modified      =   mdate($datestring, time() - 60*60);

	        $name 				=	$this->input->post('txtName');
	        $folder 			=	$this->input->post('txtFolder');
	        $image1 			=	$this->input->post('txtImage1');
	        $image2 			=	$this->input->post('txtImage2');
	        $image3 			=	$this->input->post('txtImage3');
	        $image4 			=	$this->input->post('txtImage4');
	        $detail 			=	$this->input->post('txtDetail');
			$status				=	$this->input->post('slStatus');	

			$id 				=	$this->input->post('hd_id');
	        $arrayName 		= 	array(
	        					'name' 			=>	$name,
	        					'folder'		=>	$folder,
	        					'image1'		=>	$image1,
	        					'image2'		=>	$image2,
	        					'image3'		=>	$image3,
	        					'image4'		=>	$image4,
	        					'detail'		=>	$detail,		        					
								'status'		=>	$status,
								'last_modified'	=>	$last_modified
	        				);

	        $stt 			= 	"1";
			$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
	        if($this->Store_themes_model->update($arrayName,$id)){
	        	$stt 			= 	"0";
				$msg 			=	"Các thông tin đã được cập nhật thành công";
	        }
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}
	public function check()
	{
		$bool 		=	FALSE;
		$name 		=	$this->input->post('txtName');
		$folder 	=	$this->input->post('txtFolder');
		$id 		=	$this->input->post('hd_id');

		if($this->Store_themes_model->getThemesByName($name,$id) == FALSE)
		{
			if($this->Store_themes_model->getThemesByFolder($folder,$id) == FALSE)
			{
				$bool 	=	 TRUE;
			}
		}
		return $bool;
	}

	public function checkname()
	{
		$echo 		=	"0";
		$name 		=	$this->input->post('name');
		$id			=	$this->input->post('id');
		if($name != "") 
		{
			if($this->Store_themes_model->getThemesByName($name,$id))
			{
				$echo = "1";
			}			
		}
		echo $echo;
	}

	public function checkfolder()
	{
		$echo 		=	"0";
		$name 		=	$this->input->post('name');
		$id			=	$this->input->post('id');
		if($name != "") 
		{
			if($this->Store_themes_model->getThemesByFolder($name,$id))
			{
				$echo = "1";
			}			
		}
		echo $echo;
	}

}