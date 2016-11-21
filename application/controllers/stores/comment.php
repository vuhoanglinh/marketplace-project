<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Controller {
	private $_limit 	=	10;
	public function  __construct() {
        parent::__construct();		
	}

	public function index()
	{
		if($this->session->userdata('logged_store'))
		{
			$data['titlepage']	=	"Timeline người dùng liên hệ";
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
				
			$num_rows			=	$this->Store_contact_model->getList($id_store);
			$data['num_result']	=	count($num_rows);
			$data['total_page']	=	ceil(count($num_rows)/$this->_limit);
			
			
			$data['index']		=	0;
			$this->load->view("admincp/head_view",$data);
			$this->load->view("admincp/endhead_view");
			$this->load->view("stores/navigation_view",$datauser);
			$this->load->view("stores/left_view",$dataleft);
			$this->load->view("stores/comment/comment_view",$data);
			$this->load->view("stores/footer_view");
		}
		else
		{
			redirect(base_url("stores/login"), "location");
		}
	}

	public function paggingtimeline()
	{
		$start 					=	$this->input->post('page');
		$id_store				=	$this->input->post('id_store');
		$data['id_store']		=	$id_store;
		$per_page				=	$start * $this->_limit;
		$data['datestring'] 	= 	"%d/%m/%Y";
		$data['query']			=	$this->Store_contact_model->getListLimit($id_store,$per_page,$this->_limit);
		$this->load->view('stores/comment/ajax_comment_view',$data);
	}

	public function active()
	{
		if($this->input->post('id')) {
			$id = $this->input->post('id');
			$arrayName = array('active' => 1);
			if($this->Store_contact_model->update($arrayName,$id))
			{
				echo "1";
			}
		}
	}
}