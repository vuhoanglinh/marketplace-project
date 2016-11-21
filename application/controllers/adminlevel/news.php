<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
	private $_limit 	=	10;
	public function  __construct() {
        parent::__construct();		
        $this->load->Model('Product_model');
        $this->load->Model('News_model');
        $this->load->Model('News_detail_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in_level'))
		{
			$session_data 		=	$this->session->userdata('logged_in_level');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage']	=	"Trang quản lý tin tức";						
			$data['numpro_not_active'] 	=	count($this->Product_model->getNotActive());
			$data['news_category'] 		=	$this->News_model->getList();

			$data['code']= 	$this->input->get('code');
			$id_category 		=	"";
			$name_category 		=	"";
			if($this->input->get('cat')) 
			{	
				$id_category 	=	$this->input->get('cat');
				$query			=	$this->News_model->getID($id_category);
				foreach ($query as $row) {
					$name_category 	=	$row->name;
				}
			}

			$data['id_category']=	$id_category;
			$data['name_category']=	$name_category;
			$key 				=	"";
			if($this->input->get('key')) 
			{	
				$key 			=	$this->input->get('key');			
			}	
			$num_rows		=	$this->News_detail_model->getNews1($id_category,$key);			
			$data['key'] 		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);
			$data['index']		=	0;
			$data['datestring'] = 	"%d/%m/%Y %h:%i";

			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view");
			$this->load->view("adminlevel/navigation_view",$datauser);
			$this->load->view("adminlevel/left_view",$data);
			$this->load->view("adminlevel/news/list_view",$data);
			$this->load->view("adminlevel/footer_view");
		}
		else
		{
			redirect(base_url("adminlevel/login"), "location");
		}
	}

	public function pagging_news()
	{
		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$id_store				=	$this->input->post('id_store');
		$data['datestring'] = 	"%d/%m/%Y %h:%i";
		$data['index']			=	0;
		$key 			=	"";
		$id_category 	= 	"";
		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));			
		}
		
		if($this->input->post('cat'))
		{
			$id_category	=	trim($this->input->post('cat'));			
		}
		$data['code']= 	$this->input->post('code');
		$data['query'] 		=	$this->News_detail_model->getNews1Limit($id_category,$per_page,$this->_limit,$key);
		$this->load->view("adminlevel/news/ajax_list_view",$data);
	}

	public function trash()
	{

	}

	public function add()
	{
		if($this->session->userdata('logged_in_level'))
		{
			$session_data 		=	$this->session->userdata('logged_in_level');
			$datauser['name'] 	= 	$session_data['name'];
			$datauser['avatar'] = 	$session_data['avatar'];
			$data['titlepage']	=	"Thêm mới tin tức";						
			$data['numpro_not_active'] 	=	count($this->Product_model->getNotActive());
			$data['news_category'] 		=	$this->News_model->getList();


			$data['category'] 	=	$this->News_model->getList();
			$this->load->view("admincp/head_view",$data);
			$this->load->view("js/ckeditor_view");
			$this->load->view("js/ckfinder_view");
			$this->load->view("js/elfinder_view");	
			$this->load->view("js/bootbox_view");	
			$this->load->view("admincp/endhead_view");
			$this->load->view("controls/modals_view");
			$this->load->view("adminlevel/navigation_view",$datauser);
			$this->load->view("adminlevel/left_view",$data);
			$this->load->view("adminlevel/news/add_view",$data);
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
			$data['titlepage']	=	"Chỉnh sửa tin tức";						
			$data['numpro_not_active'] 	=	count($this->Product_model->getNotActive());
			$data['news_category'] 		=	$this->News_model->getList();


			$data['category'] 	=	$this->News_model->getList();

			if($this->input->get('id')) {
				$id_news		=	$this->input->get('id');
				$query 			=	$this->News_detail_model->getNewsByID($id_news);
				$name 			=	"";
				$name_category 	=	"";
				$title 			=	"";
				$images			=	"";
				$video 			=	"";
				$id_category 	=	"";
				$keyword 		=	"";
				$description 	=	"";
				$detail 		=	"";
				$content 		=	"";
				$status 		=	"";
				foreach ($query as $row) {
					$name 			=	$row->name;
					$name_category 	=	$row->name_category;
					$title 			=	$row->title;
					$images			=	$row->images;
					$video 			=	$row->video;
					$id_category 	=	$row->id_category;
					$keyword 		=	$row->keyword;
					$description 	=	$row->description;
					$detail 		=	$row->detail;
					$content 		=	$row->content;
					$status 		=	$row->status;
				}
				$data['id']				=	$id_news;
				$data['name']			=	$name;
				$data['name_category']	=	$name_category;
				$data['title']			=	$title;
				$data['images']			=	$images;
				$data['video']			=	$video;
				$data['id_category']	=	$id_category;
				$data['keyword']		=	$keyword;
				$data['description']	=	$description;
				$data['detail']			=	$detail;
				$data['content'] 		=	$content;
				$data['status']			=	$status;

				$this->load->view("admincp/head_view",$data);
				$this->load->view("js/ckeditor_view");
				$this->load->view("js/ckfinder_view");
				$this->load->view("js/elfinder_view");	
				$this->load->view("js/bootbox_view");	
				$this->load->view("admincp/endhead_view");
				$this->load->view("controls/modals_view");
				$this->load->view("adminlevel/navigation_view",$datauser);
				$this->load->view("adminlevel/left_view",$data);
				$this->load->view("adminlevel/news/update_view",$data);
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

	public function addNews()
	{
		$stt = "";
		$msg = "";
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtName', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtNameSub', 'Title', 'trim|required|xss_clean|callback_check');
		if($this->form_validation->run() == FALSE) {
			$stt = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else
		{
			$datestring         =   "%Y/%m/%d %h:%i:%s";
			$data_added			=	mdate($datestring, time() - 60*60);
	        $last_modified      =   mdate($datestring, time() - 60*60);
			$name 				=	$this->input->post('txtName');	
			$title				=	$this->input->post('txtNameSub');
			$id_parent 			=	$this->input->post('slParent');
			$images				=	$this->input->post('txtLink');
			$video 				=	$this->input->post('txtVideo');
			$keyword 			=	$this->input->post('txtKeyword');
			$description 		=	$this->input->post('txtDescription');
			$detail 			=	$this->input->post('txtDetail');
			$content	 		=	$this->input->post('txtContent');
			$status				=	$this->input->post('slStatus');

			//Get name parent
			$name_parent 		=	"";
			if($id_parent != 0) {
				$query 				=	$this->News_model->getID($id_parent);
				foreach ($query as $row) {
					$name_parent	=	$row->name;
				}
			}

			$arrayName = array(
								'id_category' 	=> 		$id_parent,
								'name_category'	=>		$name_parent,
								'name'			=>		$name,
								'title'			=>		$title,
								'images'		=>		$images,
								'video'			=>		$video,
								'keyword'		=>		$keyword,
								'description'	=>		$description,
								'detail'		=>		$detail,
								'content'		=>		$content,
								'status'		=>		$status,
								'date_added'	=>		$data_added,
								'last_modified'	=>		$last_modified
						);
			$stt 			= 	"1";
			$msg 			= 	"Lỗi không thể cập nhật dữ liệu";

			if($this->News_detail_model->insert($arrayName)) {
				$stt 			= 	"0";
				$msg 			=	"Các thông tin đã được cập nhật thành công";
			}
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function updateNews()
	{
		$stt = "";
		$msg = "";
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtName', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtNameSub', 'Title', 'trim|required|xss_clean|callback_check');
		if($this->form_validation->run() == FALSE) {
			$stt = "2";
			$msg 	= "Dữ liệu đầu vào không hợp lệ!";
		}
		else
		{
			$datestring         =   "%Y/%m/%d %h:%i:%s";
	        $last_modified      =   mdate($datestring, time() - 60*60);
			$name 				=	$this->input->post('txtName');	
			$title				=	$this->input->post('txtNameSub');
			$id_parent 			=	$this->input->post('slParent');
			$images				=	$this->input->post('txtLink');
			$video 				=	$this->input->post('txtVideo');
			$keyword 			=	$this->input->post('txtKeyword');
			$description 		=	$this->input->post('txtDescription');
			$detail 			=	$this->input->post('txtDetail');
			$content	 		=	$this->input->post('txtContent');
			$status				=	$this->input->post('slStatus');

			//Get name parent
			$name_parent 		=	"";
			if($id_parent != 0) {
				$query 				=	$this->News_model->getID($id_parent);
				foreach ($query as $row) {
					$name_parent	=	$row->name;
				}
			}

			$id 				=	$this->input->post('hd_id');
			$arrayName = array(
								'id_category' 	=> 		$id_parent,
								'name_category'	=>		$name_parent,
								'name'			=>		$name,
								'title'			=>		$title,
								'images'		=>		$images,
								'video'			=>		$video,
								'keyword'		=>		$keyword,
								'description'	=>		$description,
								'detail'		=>		$detail,
								'content'		=>		$content,
								'status'		=>		$status,
								'last_modified'	=>		$last_modified
						);
			$stt 			= 	"1";
			$msg 			= 	"Lỗi không thể cập nhật dữ liệu";

			if($this->News_detail_model->update($arrayName,$id)) {
				$stt 			= 	"0";
				$msg 			=	"Các thông tin đã được cập nhật thành công";
			}
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}

	public function check()
	{
		$bool 		= FALSE;
		$id_parent	=	$this->input->post('slParent');
		$name 		=	$this->input->post('txtName');
		$title 		=	$this->input->post('txtNameSub');
		$id 		=	$this->input->post('hd_id');
		if($this->News_detail_model->getNewsByName($name,$id_parent,$id) == FALSE) {
			if($this->News_detail_model->getNewsByTitle($title,$id_parent,$id) == FALSE)
			{
			
				$bool 	=  TRUE;
			}
		}
		return $bool;
	}

	public function checkname()
	{
		$echo 		=	"0";
		$name 		=	$this->input->post('name');
		$id_parent	=	$this->input->post('id_parent');
		$id 		=	$this->input->post('id');
		if($name != "") 
		{
			if($this->News_detail_model->getNewsByName($name,$id_parent,$id))
			{
				$echo = "1";
			}			
		}
		echo $echo;
	}

	public function checktitle()
	{
		$echo 	=	"0";
		$title	=	$this->input->post('title');		
		$id_parent	=	$this->input->post('id_parent');
		$id 		=	$this->input->post('id');
		if($title != "") 
		{
			if($this->News_detail_model->getNewsByTitle($title,$id_parent,$id))
			{
				$echo = "1";
			}
		}
		echo $echo;
	}

	public function status()
	{
		$id 		= 	$this->input->post('id');
		$status 	= 	$this->input->post('status');

		if($this->News_detail_model->updatestatus($id,$status))
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

	public function home()
	{
		$id 		= 	$this->input->post('id');
		$status 	= 	$this->input->post('status');

		$arrayName = array('home' => $status);
		if($this->News_detail_model->update($arrayName,$id))
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
		$success 	= "0";
		
		$id 		= $this->input->post('id');
		if($this->News_detail_model->movetrash($id)){
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
		$success 	= "0";
		
		$id 		= $this->input->post('id');
		if($this->News_detail_model->outtrash($id)){
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
		$success 	= "0";
		
		$id 		= $this->input->post('id');
		if($this->News_detail_model->delete($id)){
			$success = "1";			
		}
		else {			
			$success = "0";
		}		
		$arrayName = array('status' => $success);
		echo json_encode($arrayName);
	}

}