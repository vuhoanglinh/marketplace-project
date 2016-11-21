<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images extends CI_Controller {
	public function  __construct() {
        parent::__construct();		
        $this->load->Model('Store_images_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Hình ảnh slideshow";
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
			$data['query']		=	$this->Store_images_model->getImage($id_store);
			$data['num_result'] =	count($data['query']);
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['index']		=	0;
			$this->load->view("admincp/head_view",$data);
			$this->load->view("controls/colorbox_view");
			$this->load->view("admincp/endhead_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/images/slideshow_gallery_view",$data);
			$this->load->view("stores/footer_view");
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function ad()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Hình ảnh quảng cáo";
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
			$data['query']		=	$this->Store_images_model->getImage($id_store,1);
			$data['num_result'] =	count($data['query']);
			$data['ad']			=	1;
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['index']		=	0;
			$this->load->view("admincp/head_view",$data);
			$this->load->view("controls/colorbox_view");
			$this->load->view("admincp/endhead_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/images/slideshow_gallery_view",$data);
			$this->load->view("stores/footer_view");
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function trash()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Hình ảnh đã xóa";
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

			if(!$this->input->get('ad')) {
				$data['query']		=	$this->Store_images_model->getImage($id_store,0,0);
				$data['num_result'] =	count($data['query']);
			}
			else
			{
				$data['ad']			=	1;
				$data['query']		=	$this->Store_images_model->getImage($id_store,1,0);
				$data['num_result'] =	count($data['query']);
			}
			$data['datestring'] = 	"%d/%m/%Y %h:%i";
			$data['index']		=	0;
			$this->load->view("admincp/head_view",$data);
			$this->load->view("controls/colorbox_view");
			$this->load->view("admincp/endhead_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/images/trash_gallery_view",$data);
			$this->load->view("stores/footer_view");
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function add()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Thêm mới hình ảnh";
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
			$this->load->view("controls/colorbox_view");
			$this->load->view("js/bootbox_view");
			$this->load->view("js/ckfinder_view");
			$this->load->view("admincp/endhead_view");					
			$this->load->view("controls/modals_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/images/add_view",$data);
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
			$data['titlepage']	=	"Chỉnh sửa hình ảnh";
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
				$id 			=		$this->input->get('id');
				$data['id']		=		$id;
				$query 			=		$this->Store_images_model->getImageById($id);
				foreach ($query as $row) {
					$data['image']		=	$row->image;
					$data['thumb']		=	$row->thumb;
					$data['link']		=	$row->link;
					$data['status']		=	$row->status;
				}

				$this->load->view("admincp/head_view",$data);
				$this->load->view("controls/colorbox_view");
				$this->load->view("js/bootbox_view");
				$this->load->view("js/ckfinder_view");
				$this->load->view("admincp/endhead_view");					
				$this->load->view("controls/modals_view");
				$this->load->view("stores/navigation_view",$datauser);
				$this->load->view("stores/left_view",$dataleft);
				$this->load->view("stores/images/update_view",$data);
				$this->load->view("stores/footer_view");
			}
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function addImages()
	{
		$stt 			=		"";
		$msg 			=		"";
		$datestring         =   "%Y/%m/%d %h:%i:%s";
		$data_added			=	mdate($datestring, time() - 60*60);
	    $last_modified      =   mdate($datestring, time() - 60*60);
		$id_store 		=		$this->input->post('hd_store');
		$image 			=		$this->input->post('txtImages');
		$thumb 			=		$this->input->post('txtThumb');
		$link 			=		$this->input->post('txtLink');
		$type 			=		$this->input->post('slType');
		$status 		=		$this->input->post('slStatus');	


		$arrayName 		= array(
								'id_store' 		=> 		$id_store, 
								'image'	   		=>		$image,
								'thumb'			=>		$thumb,
								'link'	   		=>		$link,
								'type'	   		=>		$type,
								'status'   		=>		$status,								
								'date_added'	=>		$data_added,
								'last_modified'	=>		$last_modified
						);

		$stt 			=		"1";
		$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
		if($this->Store_images_model->insert($arrayName))
		{
			$stt 		=	"0";
			$msg 		=	"Hình ảnh đã được cập nhật";
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function updateImages()
	{
		$stt 				=		"";
		$msg 				=		"";
		$datestring         =   "%Y/%m/%d %h:%i:%s";
	    $last_modified      =   mdate($datestring, time() - 60*60);
		$id 				=		$this->input->post('hd_id');
		$image 				=		$this->input->post('txtImages');
		$thumb 				=		$this->input->post('txtThumb');
		$link 				=		$this->input->post('txtLink');
		$type 				=		$this->input->post('slType');
		$status 			=		$this->input->post('slStatus');	


		$arrayName 		= array( 
								'image'	   		=>		$image,
								'thumb'			=>		$thumb,
								'link'	   		=>		$link,
								'type'	   		=>		$type,
								'status'   		=>		$status,	
								'last_modified'	=>		$last_modified
						);

		$stt 			=		"1";
		$msg 			= 	"Lỗi không thể cập nhật dữ liệu";
		if($this->Store_images_model->update($arrayName,$id))
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

		if($this->Store_images_model->updatestatus($id,$status))
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

	public function statuscp()
	{
		$id 		= 	$this->input->post('id');
		$statuscp 	= 	$this->input->post('status');

		if($this->Store_images_model->updatestatuscp($id,$statuscp))
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

	public function delete()
	{
		$id 		= 	$this->input->post('id');
		$image		=	"";
		$thumb		=	"";

		$query 		=	$this->Store_images_model->getImageById($id);
		foreach ($query as $row) {
				$image		=	$row->image;
				$thumb		=	$row->thumb;
		}
		if($this->Store_images_model->delete($id))
		{
			$messages = "Dữ liệu cập nhật thành công";
			$success  = "1";
			@unlink($image);
			@unlink($thumb);
		}
		else
		{
			$messages = "Dữ liệu cập nhật thất bại";
			$success  = "0";
		}
		$arrayName = array('msg' => $messages, 'info' => $success);
		echo json_encode($arrayName);
	}

	public function un()
	{
		@unlink($_GET['a']);
	}
}