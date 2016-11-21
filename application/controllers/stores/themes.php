<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Themes extends CI_Controller {
	private $_limit 	=	10;
	public function  __construct() {
        parent::__construct();		
        $this->load->Model('Store_themes_model');
        $this->load->Model('Store_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Thư viện template";
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
			$key = "";
			if($this->input->get('key')) {
				$key 				=	$this->input->get('key');
				$num_rows			=	$this->Store_themes_model->getThemes1LikeName($key);
			}
			else {
				$num_rows			=	$this->Store_themes_model->getThemes1();				
			}
			$data['query'] 		=	$num_rows;
			$data['key'] 		=	$key;
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);
			$data['index']		=	0;
			$this->load->view("admincp/head_view",$data);	
			$this->load->view("controls/colorbox_view");		
			$this->load->view("admincp/endhead_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/themes/list_view",$data);
			$this->load->view("stores/footer_view");
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function pagging_list()
	{
		$start 					=	$this->input->post('page');
		$id_store 				=	$this->input->post('id_store');

		$query 					=	$this->Store_model->getStoreById($id_store);
		$themes 				=	"";
		foreach ($query  as $row) {
			$themes 			=	$row->themes;
		}

		$data['themes']			=	$themes;
		$per_page				=	$start * $this->_limit;
		$data['index']			=	$per_page;
		$data['datestring'] 	= 	"%d/%m/%Y %h:%i";
		$key 					=	"";
		if($this->input->post('key') != "") {
			$key 					=	$this->input->post('key');
			$data['query']			=	$this->Store_themes_model->getThemes1LikeNameLimit($key,$per_page,$this->_limit);
		}
		else {
			$data['query']			=	$this->Store_themes_model->getThemes1Limit($per_page,$this->_limit);
		}
		$data['key'] 			=	$key;
		$data['id_store'] 		=	$id_store;
		$this->load->view('stores/themes/ajax_list_view',$data);
	}

	public function detail()
	{
		if($this->session->userdata('logged_store'))
		{			
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
			$id_themes = 0;

			if($this->input->get('id')) {
				$id_themes 			=	$this->input->get('id');
				$data['query'] 		=	$this->Store_themes_model->getThemesById($id_themes);

				$namethemes 		=	"";
				$themes 			=	"";
				foreach ($data['query'] as $row) {
					$namethemes 	=	$row->name;
					$themes 		=	$row->folder;
				}
				$data['titlepage']	=	$namethemes;
				$data['num_result'] =	$this->Store_model->getStoreByThemes($themes);
				$query 				=	$this->Store_model->getStoreById($id_store);
				$data['boolsamplethemes']	=	0;
				$namestore 			=	"";
				foreach ($query as $row) {
					if($themes == $row->themes) {
						$data['boolsamplethemes']	=	1;
					}
					$namestore 		=	$row->name;
					break;
				}

				$data['id_store']	=	$id_store;
				$data['name_store']	=	$namestore;

				$data['index']		=	0;
				$this->load->view("admincp/head_view",$data);	
				$this->load->view("controls/colorbox_view");		
				$this->load->view("admincp/endhead_view");
				$this->load->view("stores/navigation_view",$datauser);
				$this->load->view("stores/left_view",$dataleft);
				$this->load->view("stores/themes/detail_view",$data);
				$this->load->view("stores/footer_view");
			}
			else {
				redirect(base_url("stores/login"), "location");
			}
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}
	
	public function setthemes()
	{
		$id_store 	=	"";
		$themes 	=	"";

		$stt 		=	"";
		$msg 		=	"";
		$id_store 	=	$this->input->post('id_store');
		$themes 	=	$this->input->post('themes');

		if($id_store != "" && $themes != "")
		{
			$arrayName 	= array('themes' => $themes);
			$stt 		=	"1";
			$msg 		=	"Lỗi không thể cài đặt giao diện!";

			if($this->Store_model->update($arrayName,$id_store)) {
				$stt 		=	"0";
				$msg 		=	"Cài đặt thành công";
			}
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}
}