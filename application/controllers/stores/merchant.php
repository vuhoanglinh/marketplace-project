<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Merchant extends CI_Controller {

	private $_limit 	=	10;
	private $_limit2 	=	10;
	public function  __construct() {
        parent::__construct();	

        //Load model
        $this->load->Model('Config_model');	
        $this->load->Model('Store_model');
        $this->load->Model('Store_images_model');
        $this->load->Model('Store_event_model');
        $this->load->Model('Store_list_model');
        $this->load->Model('Product_model');
        $this->load->Model('Product_images_model');
        $this->load->Model('Product_attribute_model');
	}

	public function index()
	{
		if($this->input->get('rel')) {
			$rel 		=	$this->input->get('rel'); // ID Store
			$data['id_store'] 	=	$rel;
			//Get favicon home
			$m_fav 		=	"";
			$m_logo 		=	"";
			$query 		=	$this->Config_model->getSystem();
			foreach ($query as $row) {
				$m_fav 	=	$row->favicon; //Favicon of system
				$m_logo 	=	$row->images; //Logo of system
			}
			

			//Get attribute of store
			$query 		=	$this->Store_model->getStoreById($rel);	
			$themes 	=	"";	//Get themes
			$name 		=	""; //Get name of store
			$email 		=	"";
			$company 	=	"";
			$add 		=	"";
			$logo 		=	""; //Get logo of store
			$website 	=	""; //Get website of store want to redirect
			$keyword 	=	""; //Get keyword for seo
			$description=	""; //Get description for seo
			$extentsion = 	"";
			foreach ($query as $row) {
					$themes 	=	$row->themes;	
					$name 		=	$row->name;
					$hotline 	=	$row->hotline;
					$email 		=	$row->email;
					$company 	=	$row->name_contact;
					$add 		=	$row->address;
					$logo 		=	$row->logo;
					$website	=	$row->website;
					$keyword 	=	$row->keyword;
					$description=	$row->description;
			}	
			$system 	=	$this->Config_model->getSeo('home');
			foreach ($system as $row) {
				$keyword 		.= 	$row->keyword;
				$description 	.=	$row->description;
				$extentsion 	= 	$row->extention;
			}

			$system 	=	$this->Config_model->getSeo('product');
			foreach ($system as $row) {
				$keyword 		.= 	$row->keyword;
				$description 	.=	$row->description;
				$extentsion 	.= 	$row->extention;
			}

			if($themes != "") {
				//Set favicon and logo home
				$data['m_fav']				=	$m_fav;
				$data['m_logo']				=	$m_logo;
				//Set title page for head
				$data['h_titlepage']		=	$name." @ Chon.vn - Trải nghiệm thời trang chính hãng";
				$data['h_name']				=	$name;
				$data['h_keyword']			=	$keyword;
				$data['h_description']		=	$description;
				$data['h_extentsion'] 		=	$extentsion;
				//Set header
				$data['hr_rel']				=	$rel;
				$data['hr_logo']			=	$logo;
				$data['hr_website']			=	$website;
				//Get banner 
				$data['b_banner']			=	$this->Store_images_model->getImage1($rel);
				$data['b_ad']				=	$this->Store_images_model->getImage1($rel,1);

				//Get category by store
				$stcatgory				=	array();			
				$stcatgory['parent']	=	$this->Store_category_model->getParent($rel);
				$count 					=	0; //for loop get parent store category 
				$count2 				=	0; //for loop get parent store category, count product
				$count3 				=	0; //for loop get child store category, count product
				$data['b_count']		=	0; // == $count for view
				$data['b_count2']		=	0; // == $count2 for view
				$data['b_count3']		=	0; // == $count3 for view
				$data['b_active']		=	0;
				$stcatgory['numpparent']=	array();
				$stcatgory['numpchild'] =	array();
				$stcatgory['child']		=	array();
				$temp 					=	$stcatgory['parent'];
				foreach ($temp as $row) {
					$id_parent 			=	$row->id;
					$stcatgory['numpparent'][$count2]	=	count($this->Product_model->getListBySTCategoryPR($id_parent));

					//Child store category
					$stcatgory['child'][$count] 		=	$this->Store_category_model->getChild($id_parent);

					foreach ($stcatgory['child'][$count]  as $key) {
						$id 			=	$key->id;
						$stcatgory['numpchild'][$count3]		= count($this->Product_model->getListBySTCategory1($id));
						$count3++;
					}	
					$count++;
					$count2++;
				}
				$data['b_category']		=	$stcatgory;

				$data['b_hotline']			=	$hotline;
				$data['b_email']			=	$email;
				$data['b_company']			=	$company;
				$data['b_address']			=	$add;
				$data['b_index']			=	0;
				$data['b_event']			=	$this->Store_event_model->getEvent($rel);
				$data['b_countevent'] 		=	3;

				$fcount 					=	0; //for loop get images for future list product
				$data['b_fcount'] 			=	0; // == $fcount for view

				$mcount 					=	0; //for loop get images for future list product
				$data['b_mcount'] 			=	0; // == $fcount for view

				$hcount 					=	0; //for loop get images for hot list product
				$data['b_hcount'] 			=	0; // == $hcount for view


				$product 					=	array();
				$product['b_fimage'] 		=	array();
				$product['b_mimage'] 		=	array();
				$product['b_himage'] 		=	array();
				//Get Future List Product
				$product['b_future'] 			=	$this->Product_model->getFutureList($rel);
					//Get images for Product
					foreach ($product['b_future']  as $row) {
						$query 					=	$this->Product_images_model->getImage1($row->id);
						$product['b_fimage'][$fcount] = "";
						foreach ($query as $key) {
							$product['b_fimage'][$fcount] = $key->image;
							break;
						}
						$fcount++;							
					}
				//Get Most View Product
				$product['b_mostview'] 		=	$this->Product_model->getMostViewList($rel);
					//Get images for Product
					foreach ($product['b_mostview']  as $row) {
						$query 							=	$this->Product_images_model->getImage1($row->id);
						$product['b_mimage'][$mcount] 	= 	"";
						foreach ($query as $key) {
							$product['b_mimage'][$mcount] = $key->image;
							break;
						}
						$mcount++;							
					}

				//Get Most View Product
				$product['b_hostview'] 		=	$this->Product_model->getHot($rel);
					//Get images for Product
					foreach ($product['b_hostview']  as $row) {
						$query 							=	$this->Product_images_model->getImage1($row->id);
						$product['b_himage'][$hcount] 	= 	"";
						foreach ($query as $key) {
							$product['b_himage'][$hcount] = $key->image;
							break;
						}
						$hcount++;							
					}

				$data['b_product'] = $product;
				$this->load->view("themes/".$themes."/head_view",$data);
				$this->load->view("themes/".$themes."/header_view",$data);
				$this->load->view("themes/".$themes."/index_view",$data);
				$this->load->view("themes/".$themes."/footer_view",$data);
			}
		}
	}

	public function intro()
	{	
		if($this->input->get('rel')) {
			$rel 				=	$this->input->get('rel');
			$data['id_store'] 	=	$rel;
			//Get favicon home
			$m_fav 		=	"";
			$m_logo 		=	"";
			$query 		=	$this->Config_model->getSystem();
			foreach ($query as $row) {
				$m_fav 	=	$row->favicon;
				$m_logo 	=	$row->images;
			}



			//Get attribute of store
			$query 		=	$this->Store_model->getStoreById($rel);	
			$themes 	=	"";	
			$name 		=	"";
			$logo 		=	"";
			$website 	=	"";
			$keyword 	=	"";
			$description=	"";
			$extentsion = 	"";
			foreach ($query as $row) {
					$themes 	=	$row->themes;	
					$name 		=	$row->name;
					$hotline 	=	$row->hotline;
					$logo 		=	$row->logo;
					$intro 		=	$row->intro;
					$website	=	$row->website;
					$keyword 	=	$row->keyword;
					$description=	$row->description;
			}	

			$system 	=	$this->Config_model->getSeo('home');
			foreach ($system as $row) {
				$extentsion 	= 	$row->extention;
			}

			if($themes != "") {
				//Set favicon and logo home
				$data['m_fav']				=	$m_fav;
				$data['m_logo']				=	$m_logo;
				//Set title page for head
				$data['h_titlepage']		=	"Trang giới thiệu về ".$name." @ Chon.vn - Trải nghiệm thời trang chính hãng";
				$data['h_name']				=	$name;
				$data['h_keyword']			=	$keyword;
				$data['h_description']		=	$description;

				//Set header
				$data['hr_rel']				=	$rel;
				$data['hr_logo']			=	$logo;
				$data['hr_website']			=	$website;
				//Get banner 
				$data['b_banner']			=	$this->Store_images_model->getImage1($rel);
				//$data['b_ad']				=	$this->Store_images_model->getImage1($rel,1);
				$data['h_extentsion'] 		=	$extentsion;
				//Get category by store
				$stcatgory				=	array();			
				$stcatgory['parent']	=	$this->Store_category_model->getParent($rel);
				$count 					=	0; //for loop get parent store category 
				$count2 				=	0; //for loop get parent store category, count product
				$count3 				=	0; //for loop get child store category, count product
				$data['b_count']		=	0; // == $count for view
				$data['b_count2']		=	0; // == $count2 for view
				$data['b_count3']		=	0; // == $count3 for view
				$data['b_active']		=	0;
				$stcatgory['numpparent']=	array();
				$stcatgory['numpchild'] =	array();
				$stcatgory['child']		=	array();
				$temp 					=	$stcatgory['parent'];
				foreach ($temp as $row) {
					$id_parent 			=	$row->id;
					$stcatgory['numpparent'][$count2]	=	count($this->Product_model->getListBySTCategoryPR($id_parent));

					//Child store category
					$stcatgory['child'][$count] 		=	$this->Store_category_model->getChild($id_parent);

					foreach ($stcatgory['child'][$count]  as $key) {
						$id 			=	$key->id;
						$stcatgory['numpchild'][$count3]		= count($this->Product_model->getListBySTCategory1($id));
						$count3++;
					}	
					$count++;
					$count2++;
				}
				$data['b_category']		=	$stcatgory;
				$data['b_hotline']			=	$hotline;
				$data['b_index']			=	0;
				$data['b_intro']			=	$intro;
				//$data['b_event']			=	$this->Store_event_model->getEvent($rel);
				$this->load->view("themes/".$themes."/head_view",$data);
				$this->load->view("themes/".$themes."/header_view",$data);
				$this->load->view("themes/".$themes."/intro_view",$data);
				$this->load->view("themes/".$themes."/footer_view",$data);
			}
		}
	}

	public function product()
	{
		if($this->input->get('rel')) {
			$rel 				=	$this->input->get('rel');
			$data['id_store'] 	=	$rel;
			//Get favicon home
			$m_fav 		=	"";
			$m_logo 		=	"";
			
			$query 		=	$this->Config_model->getSystem();
			foreach ($query as $row) {
				$m_fav 		=	$row->favicon;
				$m_logo 	=	$row->images;
				$_limit 	=	$row->title;
			}



			//Get attribute of store
			$query 		=	$this->Store_model->getStoreById($rel);	
			$themes 	=	"";	
			$name 		=	"";
			$logo 		=	"";
			$website 	=	"";
			$keyword 	=	"";
			$description=	"";
			$extentsion = 	"";
			foreach ($query as $row) {
					$themes 	=	$row->themes;	
					$name 		=	$row->name;
					$hotline 	=	$row->hotline;
					$logo 		=	$row->logo;
					$intro 		=	$row->intro;
					$website	=	$row->website;
					$keyword 	=	$row->keyword;
					$description=	$row->description;
			}	

			$system 	=	$this->Config_model->getSeo('home');
			foreach ($system as $row) {
				$extentsion 	= 	$row->extention;
			}

			if($themes != "") {
				//Set favicon and logo home
				$data['m_fav']				=	$m_fav;
				$data['m_logo']				=	$m_logo;
				//Set title page for head
				$data['h_titlepage']		=	"Danh sách sản phẩm | ".$name." @ Chon.vn - Trải nghiệm thời trang chính hãng";
				$data['h_name']				=	$name;
				$data['h_keyword']			=	$keyword;
				$data['h_description']		=	$description;

				//Set header
				$data['hr_rel']				=	$rel;
				$data['hr_logo']			=	$logo;
				$data['hr_website']			=	$website;
				//Get banner 
				$data['b_banner']			=	$this->Store_images_model->getImage1($rel);
				//$data['b_ad']				=	$this->Store_images_model->getImage1($rel,1);
				$data['h_extentsion'] 		=	$extentsion;
				//Get category by store
				$stcatgory				=	array();			
				$stcatgory['parent']	=	$this->Store_category_model->getParent($rel);
				$count 					=	0; //for loop get parent store category 
				$count2 				=	0; //for loop get parent store category, count product
				$count3 				=	0; //for loop get child store category, count product
				$data['b_count']		=	0; // == $count for view
				$data['b_count2']		=	0; // == $count2 for view
				$data['b_count3']		=	0; // == $count3 for view
				$data['b_active']		=	0;
				$stcatgory['numpparent']=	array();
				$stcatgory['numpchild'] =	array();
				$stcatgory['child']		=	array();
				$temp 					=	$stcatgory['parent'];
				foreach ($temp as $row) {
					$id_parent 			=	$row->id;
					$stcatgory['numpparent'][$count2]	=	count($this->Product_model->getListBySTCategoryPR($id_parent));

					//Child store category
					$stcatgory['child'][$count] 		=	$this->Store_category_model->getChild($id_parent);

					foreach ($stcatgory['child'][$count]  as $key) {
						$id 			=	$key->id;
						$stcatgory['numpchild'][$count3]		= count($this->Product_model->getListBySTCategory1($id));
						$count3++;
					}	
					$count++;
					$count2++;
				}
				$data['b_category']			=	$stcatgory;
				$data['b_hotline']			=	$hotline;
				$data['b_index']			=	0;

				//id store category
				$idct 	=	""; //$idct == id store category
				$namect =	""; ////$idct == name store category
				if($this->input->get('c')) {
					$idct 	=	$this->input->get('c');
					$query 	=	$this->Store_category_model->getCategoryById($idct);
					foreach ($query as $row) {
						$namect =	$row->name;
					}
				}
				$data['b_idct'] 	= $idct;
				$data['b_namect'] 	= $namect;

				$key = "";
				if($this->input->get('q')) {
					$key = $this->input->get('q');
				}
				//$key == query like name or code product
				$data['b_key'] 			=	$key;

				$page = 1;
				if($this->input->get('page'))
				{
					$page = $this->input->get('page');
				}
				$data['page']			=	$page;

				$grouppage = 1;
				if($this->input->get('n'))
				{
					$grouppage = $this->input->get('n');
					$data['page'] = 0;
				}
				$data['grouppage']			=	$grouppage;


				//List orderby
				$data['b_new'] 			=	"newest";
				$data['b_old'] 			=	"oldest";
				$data['b_highprice'] 	=	"higestprice";
				$data['b_lowprice'] 	=	"lowestprice";
				$data['b_mostview'] 	=	"highestviewed";
				$data['b_litteview'] 	=	"lowestviewed";
				//Get product orderby
				$_orderby  = "";
				if($this->input->get('sort')) {
					$_orderby 			=	$this->input->get('sort');					
				}

				$data['b_orderby'] 	= $_orderby;

				$this->load->view("themes/".$themes."/head_view",$data);
				$this->load->view("themes/".$themes."/header_view",$data);
				$this->load->view("themes/".$themes."/product_view",$data);
				$this->load->view("themes/".$themes."/footer_view",$data);
			}
		}
	}

	public function paggingproduct()
	{
		if($this->input->post('rel')) {
			$rel 		=	$this->input->post('rel'); // ID Store
			$data['id_store'] 	=	$rel;

			$query 		=	$this->Config_model->getSystem();
			foreach ($query as $row) {
				$this->_limit 	=	$row->title;
			}

			//Get attribute of store
			$query 		=	$this->Store_model->getStoreById($rel);	
			$themes 	=	"";	
			$name 		=	"";
			foreach ($query as $row) {
					$themes 	=	$row->themes;	
					$name 		=	$row->name;
			}

			$data['h_name']				=	$name;
			$data['hr_rel']				=	$rel;

			$data['namestore'] 	=	$name;
			//List orderby
				$data['b_new'] 			=	"newest";
				$data['b_old'] 			=	"oldest";
				$data['b_highprice'] 	=	"higestprice";
				$data['b_lowprice'] 	=	"lowestprice";
				$data['b_mostview'] 	=	"highestviewed";
				$data['b_litteview'] 	=	"lowestviewed";
				$data['b_sale'] 		=	"highestpromotion";
			//id store category
			$idct 	=	0; //$idct == id store category
			$namect =	""; ////$idct == name store category
			if($this->input->post('c') != "")
			{	
				$idct  	= $this->input->post('c');
				$query 	=	$this->Store_category_model->getCategoryById($idct);
				foreach ($query as $row) {
					$namect =	$row->name;
				}
			}

			$data['b_idct'] 	= $idct;
			$data['b_namect'] 	= $namect;


			$key 	=	"";
			if($this->input->post('q') != "") {
				$key 	=	$this->input->post('q');
			}
			//$key == query like name or code product
				$data['b_key'] 			=	$key;
			

			$data['url'] 	=	$this->input->post('url'); //url get from page product
			//Get product orderby
				$_orderby  = "";
				if($this->input->post('sort')) {
					$_orderby 			=	$this->input->post('sort');					
						$data['url'] 		=	$data['url']."&sort=".$_orderby;							
				}

				$data['b_orderby'] 	= $_orderby;

			$_page 			= 	1; // trang được chọn
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

  			$_page 			= 	$page;  // trang được chọn
			$_groupage 		=	$n; // số nhóm trang
			$_perpage 		=	($_page - 1) * $this->_limit;  // vị trí lấy dữ liệu

			$_headpage 		=	($n - 1) * $_numgroup + 1;
			$_endpage 		=	$_headpage + $_numgroup - 1;

			$data['headpage']	=	$_headpage;
			$data['endpage']	=	$_endpage;
			$data['page']		=	$_page;
			$data['grouppage']	=	$n;
			$data['index'] 		=	$_headpage;
			$data['index2'] 		=	$_headpage;
			
			$count 						=	0; //for loop get images for future list product
			$data['b_count'] 			=	0; // == $fcount for view

			$product 					=	array();
			$product['b_image'] 		=	array();
				

				$orderby 	=	$this->input->post('sort');
				switch ($orderby) {
					case $data['b_sale']:
						//Get Older List Product
						$total_row 		=	count($this->Product_model->getSale($rel,$idct,0,$key));
						$_groupage 		=	ceil($_page / $_numgroup); // số nhóm trang

						$_perpage 		=	($_page - 1) * $this->_limit; // vị trí lấy dữ liệu
						$product['b_view'] 			=	$this->Product_model->getSaleLimit($rel,$_perpage,$this->_limit,$idct,0,$key);
						//Get images for Product
						foreach ($product['b_view']  as $row) {
							$query 					=	$this->Product_images_model->getImage1($row->id);
							$product['b_image'][$count] = "";
							foreach ($query as $key) {
								$product['b_image'][$count] = $key->image;
								break;
							}
						$count++;							
						}
						break;
					case $data['b_old']:
						//Get Older List Product
						$total_row 		=	count($this->Product_model->getListOld($rel,$idct,0,$key));
						$_groupage 		=	ceil($_page / $_numgroup); // số nhóm trang

						$_perpage 		=	($_page - 1) * $this->_limit; // vị trí lấy dữ liệu
						$product['b_view'] 			=	$this->Product_model->getListOldLimit($rel,$_perpage,$this->_limit,$idct,0,$key);
						//Get images for Product
						foreach ($product['b_view']  as $row) {
							$query 					=	$this->Product_images_model->getImage1($row->id);
							$product['b_image'][$count] = "";
							foreach ($query as $key) {
								$product['b_image'][$count] = $key->image;
								break;
							}
						$count++;							
						}
						break;
					case $data['b_mostview']:
						//Get Future List Product
						$total_row 		=	count($this->Product_model->getMostViewList($rel,$idct,0,$key));
						$_groupage 		=	ceil($_page / $_numgroup); // số nhóm trang

						$_perpage 		=	($_page - 1) * $this->_limit; // vị trí lấy dữ liệu
						$product['b_view'] 			=	$this->Product_model->getMostViewListLimit($rel,$_perpage,$this->_limit,$idct,0,$key);
						//Get images for Product
						foreach ($product['b_view']  as $row) {
							$query 					=	$this->Product_images_model->getImage1($row->id);
							$product['b_image'][$count] = "";
							foreach ($query as $key) {
								$product['b_image'][$count] = $key->image;
								break;
							}
						$count++;							
						}
						break;
					case $data['b_litteview']:
						//Get Future List Product
						$total_row 		=	count($this->Product_model->getLitteViewList($rel,$idct,0,$key));
						$_groupage 		=	ceil($_page / $_numgroup); // số nhóm trang

						$_perpage 		=	($_page - 1) * $this->_limit; // vị trí lấy dữ liệu
						$product['b_view'] 			=	$this->Product_model->getLitteViewListLimit($rel,$_perpage,$this->_limit,$idct,0,$key);
						//Get images for Product
						foreach ($product['b_view']  as $row) {
							$query 					=	$this->Product_images_model->getImage1($row->id);
							$product['b_image'][$count] = "";
							foreach ($query as $key) {
								$product['b_image'][$count] = $key->image;
								break;
							}
						$count++;							
						}
						break;
					case $data['b_highprice']:
						//Get Future List Product
						$total_row 		=	count($this->Product_model->getHighPrice($rel,$idct,0,$key));
						$_groupage 		=	ceil($_page / $_numgroup); // số nhóm trang

						$_perpage 		=	($_page - 1) * $this->_limit; // vị trí lấy dữ liệu
						$product['b_view'] 			=	$this->Product_model->getHighPriceLimit($rel,$_perpage,$this->_limit,$idct,0,$key);
						//Get images for Product
						foreach ($product['b_view']  as $row) {
							$query 					=	$this->Product_images_model->getImage1($row->id);
							$product['b_image'][$count] = "";
							foreach ($query as $key) {
								$product['b_image'][$count] = $key->image;
								break;
							}
						$count++;							
						}
						break;
					case $data['b_lowprice']:
						//Get Future List Product
						$total_row 		=	count($this->Product_model->getLowPrice($rel,$idct,0,$key));
						$_groupage 		=	ceil($_page / $_numgroup); // số nhóm trang

						$_perpage 		=	($_page - 1) * $this->_limit; // vị trí lấy dữ liệu
						$product['b_view'] 			=	$this->Product_model->getLowPriceLimit($rel,$_perpage,$this->_limit,$idct,0,$key);
						//Get images for Product
						foreach ($product['b_view']  as $row) {
							$query 					=	$this->Product_images_model->getImage1($row->id);
							$product['b_image'][$count] = "";
							foreach ($query as $key) {
								$product['b_image'][$count] = $key->image;
								break;
							}
						$count++;							
						}
						break;
					case $data['b_new']:						
					default:
						//Get Future List Product
						$total_row 		=	count($this->Product_model->getFutureList($rel,$idct,0,$key));
						$_groupage 		=	ceil($_page / $_numgroup); // số nhóm trang

						$_perpage 		=	($_page - 1) * $this->_limit; // vị trí lấy dữ liệu
						$product['b_view'] 			=	$this->Product_model->getFutureListLimit($rel,$_perpage,$this->_limit,$idct,0,$key);
						//Get images for Product
						foreach ($product['b_view']  as $row) {
							$query 					=	$this->Product_images_model->getImage1($row->id);
							$product['b_image'][$count] = "";
							foreach ($query as $key) {
								$product['b_image'][$count] = $key->image;
								break;
							}
						$count++;							
						}
						break;
				}
			$_totalpage 		=	ceil($total_row / $this->_limit); // tổng số trang			
			$_totalgroup 		= 	ceil($_totalpage / $_numgroup); // tổng số nhóm trang

			//Xác định trang cuối
			if($_endpage > $_totalpage)
			{
				$data['endpage']	=	$_totalpage;
			}

			$data['toltalpage']=	$_totalpage;
			$data['toltalgroup']=	$_totalgroup;
			$data['orderby'] 	=	$orderby;
			$data['start']		=	$_perpage;
			$data['end']		=	$_perpage + count($product['b_view']);
			$data['num_result']	=	$total_row;
			$data['b_product'] 	=	$product;
			if($themes != "") 
			{
				$this->load->view("themes/".$themes."/ajax_loadproduct_view",$data);
			}
		}		
	}

	public function event()
	{
		if($this->input->get('rel')) {
			$rel 				=	$this->input->get('rel');
			$data['id_store'] 	=	$rel;
			//Get favicon home
			$m_fav 		=	"";
			$m_logo 		=	"";
			$query 		=	$this->Config_model->getSystem();
			foreach ($query as $row) {
				$m_fav 	=	$row->favicon;
				$m_logo 	=	$row->images;
			}



			//Get attribute of store
			$query 		=	$this->Store_model->getStoreById($rel);	
			$themes 	=	"";	
			$name 		=	"";
			$logo 		=	"";
			$website 	=	"";
			$keyword 	=	"";
			$description=	"";
			$extentsion = 	"";
			foreach ($query as $row) {
					$themes 	=	$row->themes;	
					$name 		=	$row->name;
					$hotline 	=	$row->hotline;
					$logo 		=	$row->logo;
					$intro 		=	$row->intro;
					$website	=	$row->website;
					$keyword 	=	$row->keyword;
					$description=	$row->description;
			}	

			$system 	=	$this->Config_model->getSeo('home');
			foreach ($system as $row) {
				$extentsion 	= 	$row->extention;
			}

			if($themes != "") {
				//Set favicon and logo home
				$data['m_fav']				=	$m_fav;
				$data['m_logo']				=	$m_logo;
				//Set title page for head
				$data['h_titlepage']		=	"Sự kiện | ".$name." @ Chon.vn - Trải nghiệm thời trang chính hãng";
				$data['h_name']				=	$name;
				$data['h_keyword']			=	$keyword;
				$data['h_description']		=	$description;

				//Set header
				$data['hr_rel']				=	$rel;
				$data['hr_logo']			=	$logo;
				$data['hr_website']			=	$website;
				//Get banner 
				$data['b_banner']			=	$this->Store_images_model->getImage1($rel);
				//$data['b_ad']				=	$this->Store_images_model->getImage1($rel,1);
				$data['h_extentsion'] 		=	$extentsion;
				//Get category by store
				$stcatgory				=	array();			
				$stcatgory['parent']	=	$this->Store_category_model->getParent($rel);
				$count 					=	0; //for loop get parent store category 
				$count2 				=	0; //for loop get parent store category, count product
				$count3 				=	0; //for loop get child store category, count product
				$data['b_count']		=	0; // == $count for view
				$data['b_count2']		=	0; // == $count2 for view
				$data['b_count3']		=	0; // == $count3 for view
				$data['b_active']		=	0;
				$stcatgory['numpparent']=	array();
				$stcatgory['numpchild'] =	array();
				$stcatgory['child']		=	array();
				$temp 					=	$stcatgory['parent'];
				foreach ($temp as $row) {
					$id_parent 			=	$row->id;
					$stcatgory['numpparent'][$count2]	=	count($this->Product_model->getListBySTCategoryPR($id_parent));

					//Child store category
					$stcatgory['child'][$count] 		=	$this->Store_category_model->getChild($id_parent);

					foreach ($stcatgory['child'][$count]  as $key) {
						$id 			=	$key->id;
						$stcatgory['numpchild'][$count3]		= count($this->Product_model->getListBySTCategory1($id));
						$count3++;
					}	
					$count++;
					$count2++;
				}
				$data['b_category']			=	$stcatgory;
				$data['b_hotline']			=	$hotline;
				$data['b_index']			=	0;

				$page = 1;
				if($this->input->get('page'))
				{
					$page = $this->input->get('page');
				}
				$data['page']			=	$page;

				$grouppage = 1;
				if($this->input->get('n'))
				{
					$grouppage = $this->input->get('n');
					$data['page'] = 0;
				}
				$data['grouppage']			=	$grouppage;

				
				$this->load->view("themes/".$themes."/head_view",$data);
				$this->load->view("themes/".$themes."/header_view",$data);
				$this->load->view("themes/".$themes."/event_view",$data);
				$this->load->view("themes/".$themes."/footer_view",$data);
			}
		}
	}

	public function paggingevent()
	{
		
		if($this->input->post('rel')) {
			$rel 		=	$this->input->post('rel'); // ID Store
			$data['id_store'] 	=	$rel;

			//Get attribute of store
			$query 		=	$this->Store_model->getStoreById($rel);	
			$themes 	=	"";	
			$name 		=	"";
			foreach ($query as $row) {
					$themes 	=	$row->themes;	
					$name 		=	$row->name;
			}

			$data['h_name']				=	$name;
			$data['hr_rel']				=	$rel;




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

  			$_page 			= 	$page;  // trang được chọn
			$_groupage 		=	$n; // số nhóm trang
			$_perpage 		=	($_page - 1) * $this->_limit;  // vị trí lấy dữ liệu

			$_headpage 		=	($n - 1) * $_numgroup + 1;
			$_endpage 		=	$_headpage + $_numgroup - 1;

			$data['headpage']	=	$_headpage;
			$data['endpage']	=	$_endpage;
			$data['page']		=	$_page;
			$data['grouppage']	=	$n;
			$data['index'] 		=	$_headpage;


			$data['url'] 	=	$this->input->post('url'); //url get from page product

			$total_row 		=	count($this->Store_event_model->getEvent($rel));
			$_groupage 		=	ceil($_page / $_numgroup); // số nhóm trang

			$_perpage 		=	($_page - 1) * $this->_limit2; // vị trí lấy dữ liệu


			$event 			=	$this->Store_event_model->getEventLimit1($rel,$_perpage,$this->_limit2);
						
			$_totalpage 		=	ceil($total_row / $this->_limit2); // tổng số trang			
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
			$data['end']		=	$_perpage + count($event);
			$data['num_result']	=	$total_row;
			$data['b_event'] 	=	$event;
			if($themes != "") 
			{
				$this->load->view("themes/".$themes."/ajax_loadevent_view",$data);
			}
		}		
	}

	public function assessment()
	{
		
	}

	public function contact()
	{
		if($this->input->get('rel')) {
			$rel 				=	$this->input->get('rel');
			$data['id_store'] 	=	$rel;
			//Get favicon home
			$m_fav 		=	"";
			$m_logo 		=	"";
			$query 		=	$this->Config_model->getSystem();
			foreach ($query as $row) {
				$m_fav 	=	$row->favicon;
				$m_logo 	=	$row->images;
			}



			//Get attribute of store
			$query 		=	$this->Store_model->getStoreById($rel);	
			$themes 	=	"";	
			$name 		=	"";
			$logo 		=	"";
			$detail  	=	"";
			$detail_brand=	"";
			$website 	=	"";
			$keyword 	=	"";
			$description=	"";
			$extentsion = 	"";
			foreach ($query as $row) {
					$themes 	=	$row->themes;	
					$name 		=	$row->name;
					$hotline 	=	$row->hotline;
					$logo 		=	$row->logo;
					$intro 		=	$row->intro;
					$detail 	=	$row->detail;
					$detail_brand=	$row->descript_brand;
					$website	=	$row->website;
					$keyword 	=	$row->keyword;
					$description=	$row->description;
			}	

			$system 	=	$this->Config_model->getSeo('home');
			foreach ($system as $row) {
				$extentsion 	= 	$row->extention;
			}

			if($themes != "") {
				//Set favicon and logo home
				$data['m_fav']				=	$m_fav;
				$data['m_logo']				=	$m_logo;
				//Set title page for head
				$data['h_titlepage']		=	"Liên hệ ".$name." @ Chon.vn - Trải nghiệm thời trang chính hãng";
				$data['h_name']				=	$name;
				$data['h_keyword']			=	$keyword;
				$data['h_description']		=	$description;
				$data['h_extentsion'] 		=	$extentsion;
				//Set header
				$data['hr_rel']				=	$rel;
				$data['hr_logo']			=	$logo;
				$data['hr_website']			=	$website;
				//Get banner 
				$data['b_banner']			=	$this->Store_images_model->getImage1($rel);
				//$data['b_ad']				=	$this->Store_images_model->getImage1($rel,1);

				//Get category by store
				$stcatgory				=	array();			
				$stcatgory['parent']	=	$this->Store_category_model->getParent($rel);
				$count 					=	0; //for loop get parent store category 
				$count2 				=	0; //for loop get parent store category, count product
				$count3 				=	0; //for loop get child store category, count product
				$data['b_count']		=	0; // == $count for view
				$data['b_count2']		=	0; // == $count2 for view
				$data['b_count3']		=	0; // == $count3 for view
				$data['b_active']		=	0;
				$stcatgory['numpparent']=	array();
				$stcatgory['numpchild'] =	array();
				$stcatgory['child']		=	array();
				$temp 					=	$stcatgory['parent'];
				foreach ($temp as $row) {
					$id_parent 			=	$row->id;
					$stcatgory['numpparent'][$count2]	=	count($this->Product_model->getListBySTCategoryPR($id_parent));

					//Child store category
					$stcatgory['child'][$count] 		=	$this->Store_category_model->getChild($id_parent);

					foreach ($stcatgory['child'][$count]  as $key) {
						$id 			=	$key->id;
						$stcatgory['numpchild'][$count3]		= count($this->Product_model->getListBySTCategory1($id));
						$count3++;
					}	
					$count++;
					$count2++;
				}
				$data['b_category']		=	$stcatgory;


				$data['b_hotline']			=	$hotline;
				$data['b_index']			=	0;
				$data['b_detail']			=	$detail;
				$data['b_brand']			=	$detail_brand;
				//$data['b_event']			=	$this->Store_event_model->getEvent($rel);
				$this->load->view("themes/".$themes."/head_view",$data);
				$this->load->view("themes/".$themes."/header_view",$data);
				$this->load->view("themes/".$themes."/contact_view",$data);
				$this->load->view("themes/".$themes."/footer_view",$data);
			}
		}
	}

	public function detail()
	{
		if($this->input->get('rel')) {
			$rel 				=	$this->input->get('rel');
			$data['id_store'] 	=	$rel;
			//Get favicon home
			$m_fav 		=	"";
			$m_logo 		=	"";
			
			$query 		=	$this->Config_model->getSystem();
			foreach ($query as $row) {
				$m_fav 		=	$row->favicon;
				$m_logo 	=	$row->images;
				$_limit 	=	$row->title;
			}

			$this->_limit 	=	$_limit;

			//Get attribute of store
			$query 		=	$this->Store_model->getStoreById($rel);	
			$themes 	=	"";	
			$name 		=	"";
			$logo 		=	"";
			$website 	=	"";
			$keyword 	=	"";
			$description=	"";
			$extentsion = 	"";
			$descriptionbrand = "";
			foreach ($query as $row) {
					$themes 	=	$row->themes;	
					$name 		=	$row->name;
					$hotline 	=	$row->hotline;
					$logo 		=	$row->logo;
					$intro 		=	$row->intro;
					$website	=	$row->website;
					$keyword 	=	$row->keyword;
					$description=	$row->description;
					$descriptionbrand = $row->descript_brand;
			}	

			$system 	=	$this->Config_model->getSeo('home');
			foreach ($system as $row) {
				$extentsion 	= 	$row->extention;
			}

			if($themes != "") {


				//Dữ liệu về sản phẩm
				$productimage 				=	array();
				$size 						=	array();
				$color 						=	array();

				$_likecount 				=	0;
				$data['b_lcount'] 			=	0;

				$likeproduct 					=	array();
				$likeproduct['b_limage'] 		=	array();


				$id_product = 	"";	//$id_product == id prodcut
				$view 		=	""; //$view, lượt view của sản phẩm
				$nameproduct= 	""; //tên sản phẩm
				$title 		=	""; //tên không dấu
				$images 	=	""; //hình ảnh sản phẩm
				$code 		=	""; //mã sản phẩm
				$detail 	=	""; //mô tả sản phẩm
				$content 	=	""; //bài viết sản phẩm
				$oldprice 	=	"";	//giá sản phẩm
				$newprice 	=	""; //giá khuyến mãi
				$idct 		=	""; //$idct == id store category
				$namect 	=	""; ////$idct == name store category
				if($this->input->get('code')) {
					$id_product 	=	$this->input->get('code');
					$query 			=	$this->Product_model->getListById($id_product);
					foreach ($query as $row) {
						$nameproduct=	$row->name;
						$view 		=	$row->view;
						$title 		=	$row->title; //tên không dấu
						$code 		=	$row->code; //mã sản phẩm
						$oldprice 	=	$row->price; //giá sản phẩm
						$newprice 	=	$row->s_price; //giá khuyến mãi
						$detail 	=	$row->detail; //mô tả sản phẩm
						$content 	=	$row->content;
						$idct 		=	$row->id_store_category;
					}

					if(count($query) > 0) {
						$arrayName = array('view' => ($view+1));
						$this->Product_model->update($arrayName,$id_product);
						
						$result 	=	$this->Store_category_model->getCategoryById($idct);
						foreach ($result as $row) {
							$namect = $row->name;
						}

								$productimage 								=	$this->Product_images_model->getImage1($id_product);
								$size 										=	$this->Product_attribute_model->getAttr1($id_product,0);
								$color 										=	$this->Product_attribute_model->getAttr1($id_product);
								foreach ($productimage as $key) {
										$images 	= 	$key->image;
										break;
									
								}
								


						//Get Future List Product
						$likeproduct['b_lview'] 		=	$this->Product_model->getLike($rel,$id_product,$this->_limit);
							//Get images for Product
							foreach ($likeproduct['b_lview']  as $row) {
								$query 										=	$this->Product_images_model->getImage1($row->id);
								$likeproduct['b_limage'][$_likecount] 		= 	"";
								foreach ($query as $key) {
									$likeproduct['b_limage'][$_likecount] 	= $key->image;
									break;
								}
								$_likecount++;							
							}



					}
				}

				$data['b_idct'] 	= 	$idct;
				$data['b_namect'] 	= 	$namect;
				$data['b_name']		=	$nameproduct;
				$data['b_code']		=	$code;
				$data['b_title']	=	$title;
				$data['id_product'] =	$id_product;
				$data['b_oldprice']	=	$oldprice;
				$data['b_newprice']	=	$newprice;
				$data['b_image']	=	$images;
				$data['b_detail']	=	$detail;
				$data['b_content']	=	$content;

				$data['b_likeproduct']	=	$likeproduct;
				$data['b_product']		=	$productimage;
				$data['b_size']			=	$size;
				$data['b_color']		=	$color;
				
				//////////////////////////////////////////
				//Set favicon and logo home
				$data['m_fav']				=	$m_fav;
				$data['m_logo']				=	$m_logo;
				//Set title page for head
				$data['h_titlepage']		=	$nameproduct." tại ".$name." @ Chon.vn - Trải nghiệm thời trang chính hãng";
				$data['h_name']				=	$name;
				$data['h_keyword']			=	$keyword;
				$data['h_description']		=	$description;
				$data['h_descriptionbrand']	=	$descriptionbrand;
				//Set header
				$data['hr_rel']				=	$rel;
				$data['hr_logo']			=	$logo;
				$data['hr_website']			=	$website;
				//Get banner 
				$data['b_banner']			=	$this->Store_images_model->getImage1($rel);
				//$data['b_ad']				=	$this->Store_images_model->getImage1($rel,1);
				$data['h_extentsion'] 		=	$extentsion;
				//Get category by store
				$stcatgory				=	array();			
				$stcatgory['parent']	=	$this->Store_category_model->getParent($rel);
				$count 					=	0; //for loop get parent store category 
				$count2 				=	0; //for loop get parent store category, count product
				$count3 				=	0; //for loop get child store category, count product
				$data['b_count']		=	0; // == $count for view
				$data['b_count2']		=	0; // == $count2 for view
				$data['b_count3']		=	0; // == $count3 for view
				$data['b_active']		=	0;
				$stcatgory['numpparent']=	array();
				$stcatgory['numpchild'] =	array();
				$stcatgory['child']		=	array();
				$temp 					=	$stcatgory['parent'];
				foreach ($temp as $row) {
					$id_parent 			=	$row->id;
					$stcatgory['numpparent'][$count2]	=	count($this->Product_model->getListBySTCategoryPR($id_parent));

					//Child store category
					$stcatgory['child'][$count] 		=	$this->Store_category_model->getChild($id_parent);

					foreach ($stcatgory['child'][$count]  as $key) {
						$id 			=	$key->id;
						$stcatgory['numpchild'][$count3]		= count($this->Product_model->getListBySTCategory1($id));
						$count3++;
					}	
					$count++;
					$count2++;
				}
				$data['b_category']			=	$stcatgory;
				$data['b_hotline']			=	$hotline;
				$data['b_index']			=	0;
				

				$this->load->view("themes/".$themes."/head_view",$data);
				$this->load->view("themes/".$themes."/header_view",$data);
				$this->load->view("themes/".$themes."/product_detail_view",$data);
				$this->load->view("themes/".$themes."/footer_view",$data);
			}
		}
	}

	public function stores()
	{
		if($this->input->get('rel')) {
			$rel 		=	$this->input->get('rel');
			//Get favicon home
			$m_fav 		=	"";
			$m_logo 		=	"";
			$query 		=	$this->Config_model->getSystem();
			foreach ($query as $row) {
				$m_fav 	=	$row->favicon;
				$m_logo 	=	$row->images;
			}



			//Get attribute of store
			$query 		=	$this->Store_model->getStoreById($rel);	
			$themes 	=	"";	
			$name 		=	"";
			$logo 		=	"";
			$website 	=	"";
			$keyword 	=	"";
			$description=	"";
			$extentsion = 	"";
			foreach ($query as $row) {
					$themes 	=	$row->themes;	
					$name 		=	$row->name;
					$hotline 	=	$row->hotline;
					$logo 		=	$row->logo;
					$intro 		=	$row->intro;
					$website	=	$row->website;
					$keyword 	=	$row->keyword;
					$description=	$row->description;
			}	

			$system 	=	$this->Config_model->getSeo('home');
			foreach ($system as $row) {
				$extentsion 	= 	$row->extention;
			}
			if($themes != "") {
				//Set favicon and logo home
				$data['m_fav']				=	$m_fav;
				$data['m_logo']				=	$m_logo;
				//Set title page for head
				$data['h_titlepage']		=	"Trang giới thiệu về ".$name." @ Chon.vn - Trải nghiệm thời trang chính hãng";
				$data['h_name']				=	$name;
				$data['h_keyword']			=	$keyword;
				$data['h_description']		=	$description;
				$data['h_extentsion'] 		=	$extentsion;
				//Set header
				$data['hr_rel']				=	$rel;
				$data['hr_logo']			=	$logo;
				$data['hr_website']			=	$website;
				//Get banner 
				$data['b_banner']			=	$this->Store_images_model->getImage1($rel);
				//$data['b_ad']				=	$this->Store_images_model->getImage1($rel,1);

				//Get category by store
				$stcatgory				=	array();			
				$stcatgory['parent']	=	$this->Store_category_model->getParent($rel);
				$count 					=	0; //for loop get parent store category 
				$count2 				=	0; //for loop get parent store category, count product
				$count3 				=	0; //for loop get child store category, count product
				$data['b_count']		=	0; // == $count for view
				$data['b_count2']		=	0; // == $count2 for view
				$data['b_count3']		=	0; // == $count3 for view
				$data['b_active']		=	0;
				$stcatgory['numpparent']=	array();
				$stcatgory['numpchild'] =	array();
				$stcatgory['child']		=	array();
				$temp 					=	$stcatgory['parent'];
				foreach ($temp as $row) {
					$id_parent 			=	$row->id;
					$stcatgory['numpparent'][$count2]	=	count($this->Product_model->getListBySTCategoryPR($id_parent));

					//Child store category
					$stcatgory['child'][$count] 		=	$this->Store_category_model->getChild($id_parent);

					foreach ($stcatgory['child'][$count]  as $key) {
						$id 			=	$key->id;
						$stcatgory['numpchild'][$count3]		= count($this->Product_model->getListBySTCategory1($id));
						$count3++;
					}	
					$count++;
					$count2++;
				}
				$data['b_category']		=	$stcatgory;


				$data['b_hotline']			=	$hotline;
				$data['b_index']			=	0;
				$data['b_liststore']		=	$this->Store_list_model->getList($rel);
				//$data['b_event']			=	$this->Store_event_model->getEvent($rel);
				$this->load->view("themes/".$themes."/head_view",$data);
				$this->load->view("themes/".$themes."/header_view",$data);
				$this->load->view("themes/".$themes."/stores_view",$data);
				$this->load->view("themes/".$themes."/footer_view",$data);
			}
		}
	}

	public function addContact()
	{
		$stt  	=	"";
		$msg 	=	"";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtName','Name','trim|required|xss_clean');
		$this->form_validation->set_rules('txtPhone','Phone','trim|required|numeric|min_length[8]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('txtEmail', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('txtComments', 'Coments','trim|required|xss_clean');
		if($this->form_validation->run() == FALSE) {
			$stt = "1";
			$msg = "Dữ liệu không hợp lệ";
		}
		else
		{
			$datestring         =   "%Y/%m/%d %h:%i:%s";
			$date_added			=	mdate($datestring, time() - 60*60);
			$id_store 	=	$this->input->post('hd_id_store');
			$name 		=	$this->input->post('txtName');
			$company 	=	$this->input->post('txtCompany');
			$phone 		=	$this->input->post('txtPhone');
			$email 		=	$this->input->post('txtEmail');
			$comments 	=	$this->input->post('txtComments');
			$arrayName 	= 	array(
							'id_store' 	=> 	$id_store, 
							'name'		=>	$name,
							'company'	=>	$company,
							'phone'		=>	$phone,
							'email'		=>	$email,
							'comments'	=>	$comments,
							'date_added'=>	$date_added
						);
			$stt 	=	"1";
			$msg 	=	"Gửi thắt bại";
			if($this->Store_contact_model->insert($arrayName))
			{
				$stt 	=	"0";
				$msg 	=	"Gửi thành công";
			}
		}
		echo json_encode(array('status' => $stt, 'msg' => $msg));
	}
}