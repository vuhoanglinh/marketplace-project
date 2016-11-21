<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slideshow extends CI_Controller {

	public function  __construct() {
        parent::__construct();		
        $this->load->Model('Product_model');
        $this->load->Model('News_model');
        $this->load->Model('Slideshow_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_level'))
		{
			$session_data 		=	$this->session->userdata('logged_in_level');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage']	=	"Quản lý slideshow";						
			$data['numpro_not_active'] 	=	count($this->Product_model->getNotActive());
			$data['news_category'] 		=	$this->News_model->getList();

			$key 				=	"";
			if($this->input->get('key')) 
			{	
				$key 			=	$this->input->get('key');			
			}	
			$num_rows			=	$this->Slideshow_model->getList();	
			$data['query']		=	$num_rows;
			$data['key'] 		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['index']		=	0;
			$data['datestring'] = 	"%d/%m/%Y %h:%i";

			$this->load->view("admincp/head_view",$data);			
			$this->load->view("controls/colorbox_view");
			$this->load->view("admincp/endhead_view");
			$this->load->view("adminlevel/navigation_view",$datauser);
			$this->load->view("adminlevel/left_view",$data);
			$this->load->view("adminlevel/slideshow/list_view",$data);
			$this->load->view("adminlevel/footer_view");
		}
		else
		{
			redirect(base_url("adminlevel/login"), "location");
		}
	}

	public function add()
	{
		if($this->session->userdata('logged_in_level'))
		{
			$session_data 		=	$this->session->userdata('logged_in_level');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage']	=	"Thêm mới hình ảnh";						
			$data['numpro_not_active'] 	=	count($this->Product_model->getNotActive());
			$data['news_category'] 		=	$this->News_model->getList();
			

			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/ckeditor_view");
			$this->load->view("js/ckfinder_view");
			$this->load->view("js/elfinder_view");	
			$this->load->view("js/bootbox_view");	
			$this->load->view("admincp/endhead_view");
			$this->load->view("controls/modals_view");
			$this->load->view("adminlevel/navigation_view",$datauser);
			$this->load->view("adminlevel/left_view",$data);
			$this->load->view("adminlevel/slideshow/add_view");
			$this->load->view("adminlevel/footer_view");
		}
		else
		{
			redirect(base_url("adminlevel/login"), "location");
		}
	}

	public function update()
	{
		if($this->session->userdata('logged_in_level'))
		{
			$session_data 		=	$this->session->userdata('logged_in_level');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage']	=	"Quản lý slideshow";						
			$data['numpro_not_active'] 	=	count($this->Product_model->getNotActive());
			$data['news_category'] 		=	$this->News_model->getList();
			

			if($this->input->get('id')) {
				$id 			=	$this->input->get('id');
				$query 			=	$this->Slideshow_model->getID($id);
				$image 			=	"";
				$link 			=	"";
				$status 		=	"";
				foreach ($query as $row) {
					$image 		=	$row->image;
					$link 		=	$row->link;
					$status 	=	$row->status;
				}

				$data['id']		=	$id;
				$data['image']	=	$image;
				$data['link']	=	$link;
				$data['status']	=	$status;

				$this->load->view("admincp/head_view",$data);
				$this->load->view("js/ckeditor_view");
				$this->load->view("js/ckfinder_view");
				$this->load->view("js/elfinder_view");	
				$this->load->view("js/bootbox_view");	
				$this->load->view("admincp/endhead_view");
				$this->load->view("controls/modals_view");
				$this->load->view("adminlevel/navigation_view",$datauser);
				$this->load->view("adminlevel/left_view",$data);
				$this->load->view("adminlevel/slideshow/update_view",$data);
				$this->load->view("adminlevel/footer_view");
			}
			else
			{
				redirect(base_url("adminlevel/login"), "location");
			}
		}
		else
		{
			redirect(base_url("adminlevel/login"), "location");
		}
	}

	public function addImages()
	{
		$stt 			=		"";
		$msg 			=		"";
		$datestring         =   "%Y/%m/%d %h:%i:%s";
		$data_added			=	mdate($datestring, time() - 60*60);
	    $last_modified      =   mdate($datestring, time() - 60*60);
		$image 			=		$this->input->post('txtImages');
		$link 			=		$this->input->post('txtLink');
		$status 		=		$this->input->post('slStatus');	


		$arrayName 		= array( 
								'image'	   		=>		$image,
								'link'	   		=>		$link,
								'status'   		=>		$status,								
								'date_added'	=>		$data_added,
								'last_modified'	=>		$last_modified
						);

		$stt 			=		"1";
		$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
		if($this->Slideshow_model->insert($arrayName))
		{
			$stt 		=	"0";
			$msg 		=	"Hình ảnh đã được cập nhật";
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function updateImages()
	{
		$stt 			=		"";
		$msg 			=		"";
		$datestring     =   "%Y/%m/%d %h:%i:%s";
		$data_added		=	mdate($datestring, time() - 60*60);
	    $last_modified  =   mdate($datestring, time() - 60*60);
		$image 			=		$this->input->post('txtImages');
		$link 			=		$this->input->post('txtLink');
		$status 		=		$this->input->post('slStatus');	

		$id 			=		$this->input->post('hd_id');	

		$arrayName 		= array( 
								'image'	   		=>		$image,
								'link'	   		=>		$link,
								'status'   		=>		$status,	
								'last_modified'	=>		$last_modified
						);

		$stt 			=		"1";
		$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
		if($this->Slideshow_model->update($arrayName,$id))
		{
			$stt 		=	"0";
			$msg 		=	"Hình ảnh đã được cập nhật";
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function status()
	{
		$id 		= 	$this->input->post('id');
		$status 	= 	$this->input->post('status');

		if($this->Slideshow_model->updatestatus($id,$status))
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
}