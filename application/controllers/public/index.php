<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
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
	
	public function a($a,$b)
	{
		echo $a;
		echo $b;
		echo anchor_popup('public/index', 'Click Me!', array());
	}

	public function index()
	{
		$data['titlepage']	=	"Thời trang quần áo phụ kiện chính hãng tại Chon.vn";
		$query 				=	$this->Config_model->getSystem();

		$charset 			=	"";
		$hotline 			=	"";
		$keyword 			=	"";
		$description 		=	"";
		$copyright	 		=	"";
		$logo 				=	"";
		$fav 				=	"";
		foreach ($query  as $row) {
			$charset 		=	$row->name;
			$hotline		=	phone_format($row->hotline);
			$keyword 		=	$row->keyword;
			$description	=	$row->description;
			$copyright 		=	$row->extention;
			$logo			=	$row->images;
			$fav 			=	$row->favicon;
		}

		//Load menu
		$menucount 			=	0;
		$menu 				=	array();

		$menu['parent']		=	$this->Menu_model->getMenu1();
		foreach ($menu['parent'] as $row) {
			$keyword 		.= " ".$row->keyword;
			$description 	.= " ".$row->description;
			$menu['children'][$menucount]	=	"";
			if(count($this->Menu_model->getMenu1($row->id)) > 0) {
				$menu['children'][$menucount]	=	$this->Menu_model->getMenu1($row->id);
			}
			$menucount++;
		}


		$data['menucount']	=	0;
		$data['menu']		=	$menu;

		//Get name menu footer responsive
		$query 				=	$this->Menu_model->getMenuByCode1('ms');
		$temp 				=	"";
		foreach ($query as $row) {
			$temp			=	$row->name;
		}
		$data['f_muasam']	=	$temp;

		$query 				=	$this->Menu_model->getMenuByCode1('km');
		$temp 				=	"";
		foreach ($query as $row) {
			$temp			=	$row->name;
		}
		$data['f_khuyenmai']	=	$temp;
		$query 				=	$this->Menu_model->getMenuByCode1('oe');
		$temp 				=	"";
		foreach ($query as $row) {
			$temp			=	$row->name;
		}
		$data['f_outlet']	=	$temp;
		$query 				=	$this->Menu_model->getMenuByCode1('wk');
		$temp 				=	"";
		foreach ($query as $row) {
			$temp			=	$row->name;
		}
		$data['f_deal']	=	$temp;
		$query 				=	$this->Menu_model->getMenuByCode1('ttt');
		$temp 				=	"";
		foreach ($query as $row) {
			$temp			=	$row->name;
		}
		$data['f_tinthoitrang']	=	$temp;

		//Load Category
		$categorycount 			=	0;
		$category 				=	array();

		$category['parent']		=	$this->Category_model->getCategory();
		foreach ($category['parent'] as $row) {
			$category['children'][$categorycount]		=	$this->Category_model->getCategory($row->id);
			$category['countchildren'][$categorycount]	=	count($this->Category_model->getCategory($row->id));
			$category['countchildren2'][$categorycount]	=	0;
			$category['countchildren3'][$categorycount]	=	0;
			$categorycount++;
		}
		$data['categorycount']		=	0;
		$data['category2count']		=	0;
		$data['categoryrpecount']	=	0;
		$data['category']			=	$category;

		//Load Store
		$countstore 			=	0;
		$store 					=	array();
		$store 					=	$this->Store_model->getALLStore();		
		$limit 					=	12;
		$group					=	ceil(count($this->Store_model->getALLStore()) / $limit);
		
		for(; $countstore < $group; $countstore++) {			
			$_perpage 			=	$countstore * $limit;  // vị trí lấy dữ liệu
			$store[$countstore]	=	$this->Store_model->getLimitStore($_perpage,$limit);
		}
		$data['group']			=	$group;
		$data['countstore']		=	0;
		$data['store']			=	$store;

		$data['storefooter']	=	$this->Store_model->getLimitStore(0,5);

		//Cửa hàng nổi bật
		$data['storehighlights']	=	$this->Store_model->getLimitStore(0,5);
		//Cửa hàng kim cương
		$data['storediamond']		=	$this->Store_model->getLimitStore(0,12);


		$slideshow 				=	$this->Slideshow_model->getSlide();
		$data['slideshow']		=	$slideshow;


		//Load future product 
		$product 				=	array();
		$product['view']		=	$this->Product_model->getHomeList(0,6);

		$count 			=	1;
		//Get View Product
			//Get images for Product
			foreach ($product['view']  as $row) {
				$query 							=	$this->Product_images_model->getImage1($row->id);
				$product['image'][$count] 		= 	"";
				foreach ($query as $key) {
					$product['image'][$count] 	= $key->image;
					if($key->image != "") {								
						break;
					}
				}

				$query 								=	$this->Store_model->getStoreById($row->id_store);
				$product['namestore'][$count] 		= 	"";
				$product['idstore'][$count] 		= 	"";
				foreach ($query as $key) {
					$product['namestore'][$count] 	= $key->name;
					$product['idstore'][$count] 	= $key->id;
					break;
				}
				$count++;							
			}
		$data['product'] 		=	$product;
		$data['countproduct']	=	1;

		$data['h_charset']		=	$charset;
		$data['m_fav']			=	$fav;
		$data['h_description']	=	$description;
		$data['h_keyword']		=	$keyword;
		$data['f_copyright']	=	$copyright;
		$data['h_hotline']		=	$hotline;
		$data['h_logo']			=	$logo;

		$this->load->view('themes/default/head_view',$data);
		$this->load->view('themes/default/extent/home_view');
		$this->load->view('themes/default/endhead_view');
		$this->load->view('themes/default/header_view',$data);
		$this->load->view('themes/default/index_view',$data);
		$this->load->view('themes/default/footer_cotent_view',$data);
		$this->load->view('themes/default/footer_view',$data);
	}	
	
	public function search()
	{
		$key 			=	"";
		$catid 			=	"";
		$sale 			=	"";

		if($this->input->get('catid')) {
		}
			$data['titlepage']	=	"Thời trang quần áo phụ kiện chính hãng tại Chon.vn";
			$query 				=	$this->Config_model->getSystem();

			$charset 			=	"";
			$hotline 			=	"";
			$keyword 			=	"";
			$description 		=	"";
			$copyright	 		=	"";
			$logo 				=	"";
			$fav 				=	"";
			foreach ($query  as $row) {
				$charset 		=	$row->name;
				$hotline		=	phone_format($row->hotline);
				$keyword 		=	$row->keyword;
				$description	=	$row->description;
				$copyright 		=	$row->extention;
				$logo			=	$row->images;
				$fav 			=	$row->favicon;
			}

			//Load menu
			$menucount 			=	0;
			$menu 				=	array();

			$menu['parent']		=	$this->Menu_model->getMenu1();
			foreach ($menu['parent'] as $row) {
				$keyword 		.= " ".$row->keyword;
				$description 	.= " ".$row->description;
				$menu['children'][$menucount]	=	"";
				if(count($this->Menu_model->getMenu1($row->id)) > 0) {
					$menu['children'][$menucount]	=	$this->Menu_model->getMenu1($row->id);
				}
				$menucount++;
			}


			$data['menucount']	=	0;
			$data['menu']		=	$menu;

			//Get name menu footer responsive
			$query 				=	$this->Menu_model->getMenuByCode1('ms');
			$temp 				=	"";
			foreach ($query as $row) {
				$temp			=	$row->name;
			}
			$data['f_muasam']	=	$temp;

			$query 				=	$this->Menu_model->getMenuByCode1('km');
			$temp 				=	"";
			foreach ($query as $row) {
				$temp			=	$row->name;
			}
			$data['f_khuyenmai']	=	$temp;
			$query 				=	$this->Menu_model->getMenuByCode1('oe');
			$temp 				=	"";
			foreach ($query as $row) {
				$temp			=	$row->name;
			}
			$data['f_outlet']	=	$temp;
			$query 				=	$this->Menu_model->getMenuByCode1('wk');
			$temp 				=	"";
			foreach ($query as $row) {
				$temp			=	$row->name;
			}
			$data['f_deal']	=	$temp;
			$query 				=	$this->Menu_model->getMenuByCode1('ttt');
			$temp 				=	"";
			foreach ($query as $row) {
				$temp			=	$row->name;
			}
			$data['f_tinthoitrang']	=	$temp;

			//Load Category
			$categorycount 			=	0;
			$category 				=	array();
			$countproduct			=	0;
			$category['parent']		=	$this->Category_model->getCategory();
			foreach ($category['parent'] as $row) {
				$category['children'][$categorycount]		=	$this->Category_model->getCategory($row->id);
				$category['countchildren'][$categorycount]	=	count($this->Category_model->getCategory($row->id));
				$category['countproduct'][$countproduct]	=	0;
				foreach ($category['children'][$categorycount] as $value) {
					$category['countproduct'][$countproduct]	=	count($this->Product_model->getActive(0,0,0,$value->id));
					$countproduct++;
				}				
				$category['countchildren2'][$categorycount]	=	0;
				$category['countchildren3'][$categorycount]	=	0;
				$categorycount++;
			}
			$data['categorycount']		=	0;
			$data['category2count']		=	0;
			$data['categoryrpecount']	=	0;
			$data['countproduct']		=	0;
			$data['countproduct2']		=	0;
			$data['category']			=	$category;

			//Load Store
			$countstore 			=	0;
			$store 					=	array();
			$store 					=	$this->Store_model->getALLStore();		
			$limit 					=	12;
			$group					=	ceil(count($this->Store_model->getALLStore()) / $limit);
			
			for(; $countstore < $group; $countstore++) {			
				$_perpage 			=	$countstore * $limit;  // vị trí lấy dữ liệu
				$store[$countstore]	=	$this->Store_model->getLimitStore($_perpage,$limit);
			}
			$data['group']			=	$group;
			$data['countstore']		=	0;
			$data['store']			=	$store;

			$data['storefooter']	=	$this->Store_model->getLimitStore(0,5);

			//Cửa hàng nổi bật
			$data['storehighlights']	=	$this->Store_model->getLimitStore(0,5);
			//Cửa hàng kim cương
			$data['storediamond']		=	$this->Store_model->getLimitStore(0,12);

			$data['limitcategory']	=	3;

			$query 					=	$this->Config_model->getSystem();
			foreach ($query as $row) {
				$this->_limit 		=	$row->title;
			}
			$num_row 				=	count($this->Product_model->getActive());
			$data['num_result']		=	$num_row;
			$data['total_page']		=	ceil($num_row/$this->_limit);

			$data['h_charset']		=	$charset;
			$data['m_fav']			=	$fav;
			$data['h_description']	=	$description;
			$data['h_keyword']		=	$keyword;
			$data['f_copyright']	=	$copyright;
			$data['h_hotline']		=	$hotline;
			$data['h_logo']			=	$logo;

			$this->load->view('themes/default/head_view',$data);
			$this->load->view('themes/default/extent/promotion_view');
			$this->load->view('themes/default/endhead_view');
			$this->load->view('themes/default/header_view',$data);
			$this->load->view('themes/default/breadcrumb_view',$data);
			$this->load->view('themes/default/search_view',$data);
			$this->load->view('themes/default/left_view',$data);
			$this->load->view('themes/default/content_view',$data);
			$this->load->view('themes/default/footer_cotent_view',$data);
			$this->load->view('themes/default/footer_view',$data);
	}

	public function paggingproduct()
	{
		$query 					=	$this->Config_model->getSystem();
			foreach ($query as $row) {
				$this->_limit 		=	$row->title;
			}

		$start 					=	$this->input->post('page');
		$per_page				=	$start * $this->_limit;
		$data['datestring'] 	= 	"%d/%m/%Y %h:%i";
		$data['index']			=	1;
		$key 			=	"";

		

		$product 		= 	array();

		$type = 9;

		if($this->input->post('key'))
		{
			$key 			=	trim($this->input->post('key'));
			$product['view']=	$this->Product_model->getActiveLimit($type,0,$per_page,$this->_limit,0,0,$key);		
		}
		else
		{
			$product['view']=	$this->Product_model->getActiveLimit($type,0,$per_page,$this->_limit);
		}
		$count 			=	1;
		//Get View Product
		//Get images for Product
		foreach ($product['view']  as $row) {
			$product['size'][$count]		=	$this->Product_attribute_model->getAttr1($row->id,0);
			$product['color'][$count] 		=	$this->Product_attribute_model->getAttr1($row->id);
			$product['id_store'][$count] 	=	$row->id_store;
			$product['name_store'][$count] 	=	"";
			$query 							=	$this->Store_model->getStoreById($row->id_store);
			foreach ($query as $value) {
				$product['name_store'][$count] 	=	$value->name;
			}


			$query 							=	$this->Product_images_model->getImage1($row->id);
			$product['image'][$count] 		= 	"";
			foreach ($query as $key) {				
				$product['image'][$count] 	= 	$key->image;
				if($key->image != "") {								
					break;
				}
			}	
			$count++;					
		}
		$data['product'] = $product;
		$this->load->view('themes/default/listproduct_view',$data);
	}

	public function detail()
	{
		if($this->input->get('id')){
			$id_product 	=	$this->input->get('id');
			$query 			=	$this->Product_model->getListById($id_product);			

			if(count($query) > 0) {
				foreach ($query as $row) {
					$nameproduct=	$row->name;
					$view 		=	$row->view;
					$title 		=	$row->title; //tên không dấu
					$code 		=	$row->code; //mã sản phẩm
					$oldprice 	=	$row->price; //giá sản phẩm
					$newprice 	=	$row->s_price; //giá khuyến mãi
					$detail 	=	$row->detail; //mô tả sản phẩm
					$content 	=	$row->content;
					$idct 		=	$row->id_category;
					$idsct 		=	$row->id_store_category;
					$thumb 		=	$this->Product_images_model->getImage1($id_product);
					
					$image 		=	"";
					foreach ($thumb as $row1) {
						$image 	=	$row1->image;
						break;
					}

					$size 										=	$this->Product_attribute_model->getAttr1($id_product,0);
					$color 										=	$this->Product_attribute_model->getAttr1($id_product);

					$id_store 		=	$row->id_store;
					$name_store 	=	"";
					$detail_brand 	=	"";
					//Get attribute of store
					$result 		=	$this->Store_model->getStoreById($row->id_store);	
					
					foreach ($result as $row) {					
							$name_store		=	$row->name;
							$detail_brand	=	$row->descript_brand;
					}
				}

				$pmin 			=	($newprice - 1000000 > 0) ? ($newprice - 1000000) : 0;
				$pmax 			=	$newprice + 1000000;

				$limit 			=	20;
				$arrayName = array('view' => ($view+1));
				$this->Product_model->update($arrayName,$id_product);
						
				$result 	=	$this->Category_model->getCategoryById($idct);
				$namectparent=	"";
				$idctparent =	0;
				$namect 	=	"";

				foreach ($result as $row) {
					$namect = $row->name; //Name category
					if($row->id_parent != 0) {
						$idctparent =	$row->id_parent;
						$query 		=	$this->Category_model->getCategoryById($row->id_parent);
						foreach ($query as $value) {
							$namectparent=	$value->name; //Name parent category
						}
					}
				}
					

				$_likecount 		=	0;
				$likebrand			=	array();
				//Get Future List Product
				$likebrand['view'] 		=	$this->Product_model->getLike2(0,$idsct,0,0,$limit);
				//Get images for Product
				foreach ($likebrand['view']  as $row) {
					$likebrand['id_store'][$_likecount] 	=	$row->id_store;
					$likebrand['name_store'][$_likecount] 	=	"";
					$query 									=	$this->Store_model->getStoreById($row->id_store);
					foreach ($query as $value) {
						$likebrand['name_store'][$_likecount] 	=	$value->name;
					}
					$query 				=	$this->Product_images_model->getImage1($row->id);
					$likebrand['image'][$_likecount] 		= 	"";
					foreach ($query as $key) {
						$likebrand['image'][$_likecount] 	= $key->image;
						break;
					}
					$_likecount++;							
				}

				$_likecount2 		=	0;
				//Get Future List Product
				$likeprice			=	array();
				$likeprice['view'] 		=	$this->Product_model->getLike2($idct,0,$pmin,$pmax,$limit);
				//Get images for Product
				foreach ($likeprice['view']  as $row) {
					$likeprice['id_store'][$_likecount2] 	=	$row->id_store;
					$likeprice['name_store'][$_likecount2] 	=	"";
					$query 									=	$this->Store_model->getStoreById($row->id_store);
					foreach ($query as $value) {
						$likeprice['name_store'][$_likecount2] 	=	$value->name;
					}
					$query 				=	$this->Product_images_model->getImage1($row->id);
					$likeprice['image'][$_likecount2] 		= 	"";
					foreach ($query as $key) {
						$likeprice['image'][$_likecount2] 	= $key->image;
						break;
					}
					$_likecount2++;							
				}


				$data['nameproduct']	=	$nameproduct;
				$data['titleproduct']	=	$title;
				$data['code']			=	$code;
				$data['oldprice']		=	$oldprice;
				$data['newprice']		=	$newprice;
				$data['detail']			=	$detail;
				$data['content']		=	$content;
				$data['image']			=	$image;
				$data['thumb']			=	$thumb;
				$data['size']			=	$size;
				$data['color']			=	$color;
				
				$data['id_store']		=	$id_store;
				$data['name_store']		=	$name_store;
				$data['detail_brand']	=	$detail_brand;
				$data['id_category']	=	$idct;
				$data['name_category']	=	$namect;
				$data['id_parent_category']		=	$idctparent;
				$data['name_parent_category']	=	$namectparent;

				$data['_likecount']		=	0;
				$data['likebrand']		=	$likebrand;
				$data['_likecount2']	=	0;
				$data['likeprice']		=	$likeprice;



				$data['titlepage']	=	"Sản phẩm ".$nameproduct. " tại Chon.vn";
				$query 				=	$this->Config_model->getSystem();

				$charset 			=	"";
				$hotline 			=	"";
				$keyword 			=	"";
				$description 		=	"";
				$copyright	 		=	"";
				$logo 				=	"";
				$fav 				=	"";
				foreach ($query  as $row) {
					$charset 		=	$row->name;
					$hotline		=	phone_format($row->hotline);
					$keyword 		=	$row->keyword;
					$description	=	$row->description;
					$copyright 		=	$row->extention;
					$logo			=	$row->images;
					$fav 			=	$row->favicon;
				}

				//Load menu
				$menucount 			=	0;
				$menu 				=	array();

				$menu['parent']		=	$this->Menu_model->getMenu1();
				foreach ($menu['parent'] as $row) {
					$keyword 		.= " ".$row->keyword;
					$description 	.= " ".$row->description;
					$menu['children'][$menucount]	=	"";
					if(count($this->Menu_model->getMenu1($row->id)) > 0) {
						$menu['children'][$menucount]	=	$this->Menu_model->getMenu1($row->id);
					}
					$menucount++;
				}


				$data['menucount']	=	0;
				$data['menu']		=	$menu;

				//Get name menu footer responsive
				$query 				=	$this->Menu_model->getMenuByCode1('ms');
				$temp 				=	"";
				foreach ($query as $row) {
					$temp			=	$row->name;
				}
				$data['f_muasam']	=	$temp;

				$query 				=	$this->Menu_model->getMenuByCode1('km');
				$temp 				=	"";
				foreach ($query as $row) {
					$temp			=	$row->name;
				}
				$data['f_khuyenmai']	=	$temp;
				$query 				=	$this->Menu_model->getMenuByCode1('oe');
				$temp 				=	"";
				foreach ($query as $row) {
					$temp			=	$row->name;
				}
				$data['f_outlet']	=	$temp;
				$query 				=	$this->Menu_model->getMenuByCode1('wk');
				$temp 				=	"";
				foreach ($query as $row) {
					$temp			=	$row->name;
				}
				$data['f_deal']	=	$temp;
				$query 				=	$this->Menu_model->getMenuByCode1('ttt');
				$temp 				=	"";
				foreach ($query as $row) {
					$temp			=	$row->name;
				}
				$data['f_tinthoitrang']	=	$temp;

				//Load Category
				$categorycount 			=	0;
				$category 				=	array();

				$category['parent']		=	$this->Category_model->getCategory();
				foreach ($category['parent'] as $row) {
					$category['children'][$categorycount]		=	$this->Category_model->getCategory($row->id);
					$category['countchildren'][$categorycount]	=	count($this->Category_model->getCategory($row->id));
					$category['countchildren2'][$categorycount]	=	0;
					$category['countchildren3'][$categorycount]	=	0;
					$categorycount++;
				}
				$data['categorycount']		=	0;
				$data['category2count']		=	0;
				$data['categoryrpecount']	=	0;
				$data['category']			=	$category;

				//Load Store
				$countstore 			=	0;
				$store 					=	array();
				$store 					=	$this->Store_model->getALLStore();		
				$limit 					=	12;
				$group					=	ceil(count($this->Store_model->getALLStore()) / $limit);
				
				for(; $countstore < $group; $countstore++) {			
					$_perpage 			=	$countstore * $limit;  // vị trí lấy dữ liệu
					$store[$countstore]	=	$this->Store_model->getLimitStore($_perpage,$limit);
				}
				$data['group']			=	$group;
				$data['countstore']		=	0;
				$data['store']			=	$store;

				$data['storefooter']	=	$this->Store_model->getLimitStore(0,5);

				//Cửa hàng nổi bật
				$data['storehighlights']	=	$this->Store_model->getLimitStore(0,5);
				//Cửa hàng kim cương
				$data['storediamond']		=	$this->Store_model->getLimitStore(0,12);


				

				$data['h_charset']		=	$charset;
				$data['m_fav']			=	$fav;
				$data['h_description']	=	$description;
				$data['h_keyword']		=	$keyword;
				$data['f_copyright']	=	$copyright;
				$data['h_hotline']		=	$hotline;
				$data['h_logo']			=	$logo;

				$this->load->view('themes/default/head_view',$data);
				$this->load->view('themes/default/extent/product_view');
				$this->load->view('themes/default/endhead_view');
				$this->load->view('themes/default/header_view',$data);
				$this->load->view('themes/default/detail_view',$data);
				$this->load->view('themes/default/footer_cotent_view',$data);
				$this->load->view('themes/default/footer_view',$data);
			}

			else
			{
				redirect(base_url(), "location");
			}
		}
	}



	//Trang tin tức
	public function news()
	{
		$data['titlepage']	=	"Tư vấn làm đẹp, chăm sóc da và cập nhật xu hướng thời trang tại Chon.vn";
		$query 				=	$this->Config_model->getSystem();

		$charset 			=	"";
		$hotline 			=	"";
		$keyword 			=	"";
		$description 		=	"";
		$copyright	 		=	"";
		$logo 				=	"";
		$fav 				=	"";
		foreach ($query  as $row) {
			$charset 		=	$row->name;
			$hotline		=	phone_format($row->hotline);
			$keyword 		=	$row->keyword;
			$description	=	$row->description;
			$copyright 		=	$row->extention;
			$logo			=	$row->images;
			$fav 			=	$row->favicon;
		}

		//Load menu
		$menucount 			=	0;
		$menu 				=	array();

		$menu['parent']		=	$this->Menu_model->getMenu1();
		foreach ($menu['parent'] as $row) {
			$keyword 		.= " ".$row->keyword;
			$description 	.= " ".$row->description;
			$menu['children'][$menucount]	=	"";
			if(count($this->Menu_model->getMenu1($row->id)) > 0) {
				$menu['children'][$menucount]	=	$this->Menu_model->getMenu1($row->id);
			}
			$menucount++;
		}


		$data['menucount']	=	0;
		$data['menu']		=	$menu;

		//Get name menu footer responsive
		$query 				=	$this->Menu_model->getMenuByCode1('ms');
		$temp 				=	"";
		foreach ($query as $row) {
			$temp			=	$row->name;
		}
		$data['f_muasam']	=	$temp;

		$query 				=	$this->Menu_model->getMenuByCode1('km');
		$temp 				=	"";
		foreach ($query as $row) {
			$temp			=	$row->name;
		}
		$data['f_khuyenmai']	=	$temp;
		$query 				=	$this->Menu_model->getMenuByCode1('oe');
		$temp 				=	"";
		foreach ($query as $row) {
			$temp			=	$row->name;
		}
		$data['f_outlet']	=	$temp;
		$query 				=	$this->Menu_model->getMenuByCode1('wk');
		$temp 				=	"";
		foreach ($query as $row) {
			$temp			=	$row->name;
		}
		$data['f_deal']	=	$temp;
		$query 				=	$this->Menu_model->getMenuByCode1('ttt');
		$temp 				=	"";
		foreach ($query as $row) {
			$temp			=	$row->name;
		}
		$data['f_tinthoitrang']	=	$temp;

		//Load Category
		$categorycount 			=	0;
		$category 				=	array();

		$category['parent']		=	$this->Category_model->getCategory();
		foreach ($category['parent'] as $row) {
			$category['children'][$categorycount]		=	$this->Category_model->getCategory($row->id);
			$category['countchildren'][$categorycount]	=	count($this->Category_model->getCategory($row->id));
			$category['countchildren2'][$categorycount]	=	0;
			$category['countchildren3'][$categorycount]	=	0;
			$categorycount++;
		}
		$data['categorycount']		=	0;
		$data['category2count']		=	0;
		$data['categoryrpecount']	=	0;
		$data['category']			=	$category;

		//Load Store
		$countstore 			=	0;
		$store 					=	array();
		$store 					=	$this->Store_model->getALLStore();		
		$limit 					=	12;
		$group					=	ceil(count($this->Store_model->getALLStore()) / $limit);
		
		for(; $countstore < $group; $countstore++) {			
			$_perpage 			=	$countstore * $limit;  // vị trí lấy dữ liệu
			$store[$countstore]	=	$this->Store_model->getLimitStore($_perpage,$limit);
		}
		$data['group']			=	$group;
		$data['countstore']		=	0;
		$data['store']			=	$store;

		$data['storefooter']	=	$this->Store_model->getLimitStore(0,5);

		//Cửa hàng nổi bật
		$data['storehighlights']	=	$this->Store_model->getLimitStore(0,5);
		//Cửa hàng kim cương
		$data['storediamond']		=	$this->Store_model->getLimitStore(0,12);

		//Xu hướng thời trang
		$query			=	$this->News_model->getID(1);
		foreach ($query as $row) {
			$data['xhtt']		=	$row->name;
			$data['xhtttitle']	=	$row->title;
		}

		//Tin tức thời trang
		$query			=	$this->News_model->getID(2);
		foreach ($query as $row) {
			$data['ttt']		=	$row->name;
			$data['ttttitle']	=	$row->title;
		}

		//360 video
		$query			=	$this->News_model->getID(3);
		foreach ($query as $row) {
			$data['video']		=	$row->name;
			$data['videotitle']	=	$row->title;
		}

		//Feature news
		$_featurenews			=	$this->News_detail_model->getNewsLimit(1,"",1,0,3);


		$data['datestring']		=	"%d/%m/%Y";
		$data['_featurenews']	=	$_featurenews;
		$data['h_charset']		=	$charset;
		$data['m_fav']			=	$fav;
		$data['h_description']	=	$description;
		$data['h_keyword']		=	$keyword;
		$data['f_copyright']	=	$copyright;
		$data['h_hotline']		=	$hotline;
		$data['h_logo']			=	$logo;

		$this->load->view('themes/default/head_view',$data);
		$this->load->view('themes/default/extent/news_view');
		$this->load->view('themes/default/endhead_view');
		$this->load->view('themes/default/header_view',$data);
		$this->load->view('themes/default/news_view',$data);
		$this->load->view('themes/default/footer_cotent_view',$data);
		$this->load->view('themes/default/footer_view',$data);
	}
}

/* End of file index.php */
/* Location: ./application/controllers/admincp/index.php */