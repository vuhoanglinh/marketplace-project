<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	private $_limit 	=	10;
	public function  __construct() {
        parent::__construct();	
        $this->load->Model('Config_model');	
        $this->load->Model('Menu_model');	
        $this->load->Model('Category_model');	
        $this->load->Model('Store_model');
        $this->load->Model('Slideshow_model');
        $this->load->Model('Product_model');
        $this->load->Model('Product_images_model');
        $this->load->Model('Product_attribute_model');
        $this->load->Model('News_model');
        $this->load->Model('News_detail_model');
        $this->load->helper('string');
	}

	public function loadxhtt()
	{
			$_page 			= 	1;  // trang được chọn
			$_groupage 		=	1; // số nhóm trang
			$_numgroup 		=	5; // số trang hiện thị 
			$_perpage 		=	0; // vị trí lấy dữ liệu

			//Lay trang:
			if($this->input->post('page') != 0)
			{
			   	$page 	= $this->input->post('page');
			   	$n 		= ceil($page / $_numgroup); //Group page
			}
			else
		    {
				$n 		= $this->input->post('n'); 
				$page 	= ($n-1) * $_numgroup + 1;
  			}

  			$_limit2 		=	6;
  			$_page 			= 	$page;  // trang được chọn
			$_groupage 		=	$n; // số nhóm trang
			$_perpage 		=	($_page - 1) * $_limit2;  // vị trí lấy dữ liệu

			$_headpage 		=	($n - 1) * $_numgroup + 1;
			$_endpage 		=	$_headpage + $_numgroup - 1;

			$data['headpage']	=	$_headpage;
			$data['endpage']	=	$_endpage;
			$data['page']		=	$_page;
			$data['grouppage']	=	$n;
			$data['index'] 		=	$_headpage;

			$total_row 		=	count($this->News_detail_model->getNews(1));
			$_groupage 		=	ceil($_page / $_numgroup); // số nhóm trang
			
			$_perpage 		=	($_page - 1) * $_limit2; // vị trí lấy dữ liệu


			$trendnews 			=	$this->News_detail_model->getNewsLimit(1,"",0,$_perpage,$_limit2);
						
			$_totalpage 		=	ceil($total_row / $_limit2); // tổng số trang			
			$_totalgroup 		= 	ceil($_totalpage / $_numgroup); // tổng số nhóm trang

			//Xác định trang cuối
			if($_endpage > $_totalpage)
			{
				$data['endpage']	=	$_totalpage;
			}

			$data['toltalpage']	=	$_totalpage;
			$data['toltalgroup']=	$_totalgroup;
			$data['b_count'] 	=	0;
			$data['start']		=	$_perpage;
			$data['end']		=	$_perpage + count($trendnews);
			$data['num_result']	=	$total_row;
			$data['trendnews'] 	=	$trendnews;
			$data['datestring']		=	"%d/%m/%Y";
		$this->load->view('themes/default/ajax/xhtt_view',$data);
	}

	public function loadxhtt2()
	{
			$_page 			= 	1;  // trang được chọn
			$_groupage 		=	1; // số nhóm trang
			$_numgroup 		=	5; // số trang hiện thị 
			$_perpage 		=	0; // vị trí lấy dữ liệu

			//Lay trang:
			if($this->input->post('page') != 0)
			{
			   	$page 	= $this->input->post('page');
			   	$n 		= ceil($page / $_numgroup); //Group page
			}
			else
		    {
				$n 		= $this->input->post('n'); 
				$page 	= ($n-1) * $_numgroup + 1;
  			}

  			$_limit2 		=	4;
  			$_page 			= 	$page;  // trang được chọn
			$_groupage 		=	$n; // số nhóm trang
			$_perpage 		=	($_page - 1) * $_limit2;  // vị trí lấy dữ liệu

			$_headpage 		=	($n - 1) * $_numgroup + 1;
			$_endpage 		=	$_headpage + $_numgroup - 1;

			$data['headpage']	=	$_headpage;
			$data['endpage']	=	$_endpage;
			$data['page']		=	$_page;
			$data['grouppage']	=	$n;
			$data['index'] 		=	$_headpage;

			$total_row 		=	count($this->News_detail_model->getNews2(1));
			$_groupage 		=	ceil($_page / $_numgroup); // số nhóm trang
			
			//Tin tức thời trang
			$query			=	$this->News_model->getID(1);
			foreach ($query as $row) {
				$data['namecategory']		=	$row->name;
			}
			$news 			=	$this->News_detail_model->getNewsLimit2(1,$_perpage,$_limit2);
						
			$_totalpage 		=	ceil($total_row / $_limit2); // tổng số trang			
			$_totalgroup 		= 	ceil($_totalpage / $_numgroup); // tổng số nhóm trang

			//Xác định trang cuối
			if($_endpage > $_totalpage)
			{
				$data['endpage']	=	$_totalpage;
			}
			$data['toltalpage']	=	$_totalpage;
			$data['toltalgroup']=	$_totalgroup;
			$data['b_count'] 	=	0;
			$data['start']		=	$_perpage;
			$data['end']		=	$_perpage + count($news);
			$data['num_result']	=	$total_row;
			$data['news'] 		=	$news;
			$data['datestring']		=	"%d/%m/%Y";
		$this->load->view('themes/default/ajax/xhtt2_view',$data);
	}
	
	public function loadttt()
	{
			$_page 			= 	1;  // trang được chọn
			$_groupage 		=	1; // số nhóm trang
			$_numgroup 		=	5; // số trang hiện thị 
			$_perpage 		=	0; // vị trí lấy dữ liệu

			//Lay trang:
			if($this->input->post('page') != 0)
			{
			   	$page 	= $this->input->post('page');
			   	$n 		= ceil($page / $_numgroup); //Group page
			}
			else
		    {
				$n 		= $this->input->post('n'); 
				$page 	= ($n-1) * $_numgroup + 1;
  			}

  			$_limit2 		=	4;
  			$_page 			= 	$page;  // trang được chọn
			$_groupage 		=	$n; // số nhóm trang
			$_perpage 		=	($_page - 1) * $_limit2;  // vị trí lấy dữ liệu

			$_headpage 		=	($n - 1) * $_numgroup + 1;
			$_endpage 		=	$_headpage + $_numgroup - 1;

			$data['headpage']	=	$_headpage;
			$data['endpage']	=	$_endpage;
			$data['page']		=	$_page;
			$data['grouppage']	=	$n;
			$data['index'] 		=	$_headpage;

			$total_row 		=	count($this->News_detail_model->getNews2(2));
			$_groupage 		=	ceil($_page / $_numgroup); // số nhóm trang
			
			//Tin tức thời trang
			$query			=	$this->News_model->getID(2);
			foreach ($query as $row) {
				$data['namecategory']		=	$row->name;
			}
			$news 			=	$this->News_detail_model->getNewsLimit2(2,$_perpage,$_limit2);
						
			$_totalpage 		=	ceil($total_row / $_limit2); // tổng số trang			
			$_totalgroup 		= 	ceil($_totalpage / $_numgroup); // tổng số nhóm trang

			//Xác định trang cuối
			if($_endpage > $_totalpage)
			{
				$data['endpage']	=	$_totalpage;
			}
			$data['toltalpage']	=	$_totalpage;
			$data['toltalgroup']=	$_totalgroup;
			$data['b_count'] 	=	0;
			$data['start']		=	$_perpage;
			$data['end']		=	$_perpage + count($news);
			$data['num_result']	=	$total_row;
			$data['news'] 		=	$news;
			$data['datestring']		=	"%d/%m/%Y";
		$this->load->view('themes/default/ajax/ttt_view',$data);
	}

	public function loadvideo()
	{
			$_page 			= 	1;  // trang được chọn
			$_groupage 		=	1; // số nhóm trang
			$_numgroup 		=	5; // số trang hiện thị 
			$_perpage 		=	0; // vị trí lấy dữ liệu

			//Lay trang:
			if($this->input->post('page') != 0)
			{
			   	$page 	= $this->input->post('page');
			   	$n 		= ceil($page / $_numgroup); //Group page
			}
			else
		    {
				$n 		= $this->input->post('n'); 
				$page 	= ($n-1) * $_numgroup + 1;
  			}

  			$_limit2 		=	5;
  			$_page 			= 	$page;  // trang được chọn
			$_groupage 		=	$n; // số nhóm trang
			$_perpage 		=	($_page - 1) * $_limit2;  // vị trí lấy dữ liệu

			$_headpage 		=	($n - 1) * $_numgroup + 1;
			$_endpage 		=	$_headpage + $_numgroup - 1;

			$data['headpage']	=	$_headpage;
			$data['endpage']	=	$_endpage;
			$data['page']		=	$_page;
			$data['grouppage']	=	$n;
			$data['index'] 		=	$_headpage;

			$total_row 		=	count($this->News_detail_model->getNews2(3));
			$_groupage 		=	ceil($_page / $_numgroup); // số nhóm trang
			
			//Tin tức thời trang
			$query			=	$this->News_model->getID(3);
			foreach ($query as $row) {
				$data['namecategory']		=	$row->name;
			}
			$news 			=	$this->News_detail_model->getNewsLimit2(3,$_perpage,$_limit2);
						
			$_totalpage 		=	ceil($total_row / $_limit2); // tổng số trang			
			$_totalgroup 		= 	ceil($_totalpage / $_numgroup); // tổng số nhóm trang

			//Xác định trang cuối
			if($_endpage > $_totalpage)
			{
				$data['endpage']	=	$_totalpage;
			}
			$data['toltalpage']	=	$_totalpage;
			$data['toltalgroup']=	$_totalgroup;
			$data['b_count'] 	=	0;
			$data['start']		=	$_perpage;
			$data['end']		=	$_perpage + count($news);
			$data['num_result']	=	$total_row;
			$data['news'] 		=	$news;
			$data['datestring']		=	"%d/%m/%Y";
		$this->load->view('themes/default/ajax/video_view',$data);
	}
}