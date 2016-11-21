<!-- Header Begin -->
<header class="header"> 
  <!-- Section user-menu: login, logon, cart Begin -->
  <div class="span-26 user-menu"> 
    <script language="javascript" type="text/javascript">
	    $(document).ready(function() {
	        $(document).click(function(e) {
	            if ($(e.target).closest('.divbox').length <= 0
	            && $(e.target).closest('.showbox').length <= 0) {
	                $('.showbox').hide();
	                $('.divbox').parent().removeClass('active');
	                $('.divbox').find('i').removeClass('up');
	            }
	        });


	        $('.divbox').click(function() {
	            $('.divbox').parent().removeClass('active');
	            $('.divbox').find('i').removeClass('up');
	            if ($(this).siblings('.showbox').is(':hidden')) {

	                $(this).parent().addClass('active');
	                $(this).find('i').addClass('up');
	                $(this).siblings('.showbox').show();
	            }
	            else {

	                $(this).parent().removeClass('active');
	                $(this).find('i').removeClass('up');
	                $(this).siblings('.showbox').hide();
	            }
	        });

	    });

	</script>
    <div class="user-inner"> 
      <!-- Loading login Begin -->
      <div style="float:right;position: absolute;right:242px;top:10px"> <span id="loading_login" style="display: none;"><img src="<?php echo base_url('themes/default'); ?>/images/loading2.gif"></span> </div>
      <!-- Loading login End --> 
      
      <!-- NonLogin Begin --> 
      <script type="text/javascript" src="<?php echo base_url('themes/default'); ?>/js/LoginStatus.js"></script>
      <div id="nonLogin" style="display:block">
        <ul>
          <!-- Login Normal Begin -->
          <li class="lg-normal">
            <div class="pao divbox"> <a href="javascript:void(0)"> <span>Đăng Nhập</span> <i class="down"></i> </a> </div>
            <div class="box_login showbox" style="display: none;">
              <div class="box_login1">
                <form action="" method="post" name="frmLogin" id="frmLogin">
                  <div class="loginUser">
                    <label>Email hoặc username</label>
                    <span>
                    <input type="text" value="" id="loginUser" name="loginUser">
                    </span> </div>
                  <div class="loginPass">
                    <label>Mật mã</label>
                    <span>
                    <input type="password" value="" id="loginPass" name="loginPass">
                    </span> </div>
                  <div class="fotgetPass"> <a href=""><span>Quên mật mã</span></a> <a href="javascript:void(0)" onclick=""><span>Đăng ký</span></a> </div>
                  <div class="btnEnter"> <a href="javascript:void(0)" rel="nofollow" onclick="FuncLogin()">Đăng Nhập</a> </div>
                </form>
              </div>
              <!-- Login Messessage Waring Begin -->
              <div id="loginmessage" style="text-align: center;clear: both;padding-top: 10px;color:#c00; display: none;">Mật mã truy cập hoặc tên tài khoản không đúng! Vui lòng thử lại.</div>
              <!-- Login Messessage Waring End -->
              <div class="box_login2"> <span class="line"></span> <span class="line1"></span> <span class="title">hoặc</span> <a href="javascript:void(0)" rel="nofollow" onclick="OnPopupFuncLogin()" class="img_login-fb"><img src="<?php echo base_url('themes/default'); ?>/images/icon/img-facebook.png" alt="login facebook" title="login facebook" border="0"></a> </div>
            </div>
          </li>
          <!-- Login Normal End --> 
          
          <!-- Login Facebook Begin -->
          <li class="lg-facebook"><a href="javascript:void(0)" rel="nofollow" onclick="OnPopupFuncLogin()"><img src="<?php echo base_url('themes/default'); ?>/images/icon/login-fb.jpg" alt="login facebook" title="login facebook" border="0"></a></li>
          <!-- Login Facebook End-->
        </ul>
      </div>
      
      <!-- NonLogin End --> 
      
      <!-- LoginOn Begin -->
      
      <div id="logon" style="display:none">
        <ul>
          <li class="lg-success">
            <div class="pao1 divbox"> <a href="javascript:void(0)"> <span id="lblLoginName"></span> <i class="down"></i> </a> <a href="javascript:void(0)" class="postActor"> <img id="avatarUrlsmall" src="" alt="" title="" border="0" width="22"> </a> </div>
            <div class="box_login_success showbox" style="display: none;">
              <div class="box_info">
                <div class="rowspan"> <a href="" class="title">Đơn hàng</a> <span id="lblTotalOrders" class="num"></span> </div>
                <div class="rowspan"> <a href="" class="title">Yêu thích</a> <span id="lblTotalFavouriteProducts" class="num"></span> </div>
              </div>
              <div class="box_info">
                <div class="rowspan"> <a href="" class="title">Điểm thưởng</a> <span id="lblTotalPoints" class="num"></span> </div>
              </div>
              <div class="box_info">
                <div class="rowspan"> <a href="" class="title">Thông tin cá nhân</a> </div>
                <div id="linkacc" class="rowspan" style="display:none"></div>
                <div class="rowspan"> <a href="" class="title">Đổi mật mã</a> </div>
              </div>
              <div class="btnlogout"> <a href="" rel="nofollow">Thoát</a> </div>
            </div>
          </li>
        </ul>
      </div>
      <!-- LoginOn End --> 
      
      <!-- Basket Begin -->
      <div class="Basket">
        <div id="cart_menu" class="s_nav"> <a class="bk_cart" href="" rel="nofollow"><span class="grand_total">
          <label id="lblTotalQuantity" class="qproduct">0</label>
          </span> </a>
          <div class="s_submenu"> <a>Giỏ hàng</a>
            <div class="s_mb_0"> <span class="img-loading"><img src="<?php echo base_url('themes/default'); ?>/images/loading2.gif"></span>
              <div class="cart-contpopup"> 
                
                <!-- Ajax Loading cart--> 
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Basket End --> 
    </div>
  </div>
  <!-- Section user-menu: login, logon, cart End --> 
  
  <!-- Section hdchon: logo, search, info numberphone, share Begin-->
  <div class="span-26 hdchon">
    <div class="logo" > <a href="<?php echo base_url(); ?>" <?php echo ($h_logo != "")? 'style="background: url('.base_url("public")."/".$h_logo.') no-repeat center center;"' : ''; ?>> <span>Trung tâm thời trang</span> </a> </div>
    <div class="search"> 
      
      <!-- Key tag Begin -->
      <div class="common_keyword">
        <ul>
          <li><span>Từ khoá thông dụng</span>
            <div class="tooltip" style="display: none;"> <a class="topKeyword_link" href="+nam+tron" title="ao thun nam tron">ao thun nam tron (246)</a>&nbsp; <a class="topKeyword_link" href="/tim-kiem.aspx?q=Vi+nu+mau+cam" title="Vi nu mau cam">Vi nu mau cam (46)</a>&nbsp; <a class="topKeyword_link" href="/tim-kiem.aspx?q=so+mi+trang+nu" title="so mi trang nu">so mi trang nu (297)</a>&nbsp; <a class="topKeyword_link" href="/tim-kiem.aspx?q=giay+valentino" title="giay valentino">giay valentino (36)</a>&nbsp; <a class="topKeyword_link" href="/tim-kiem.aspx?q=v%c3%ad+nam+da" title="ví nam da">ví nam da (103)</a>&nbsp; <a class="topKeyword_link" href="/tim-kiem.aspx?q=marc+jacobs+t%c3%bai+x%c3%a1ch" title="marc jacobs túi xách">marc jacobs túi xách (78)</a>&nbsp; </div>
          </li>
        </ul>
      </div>
      <!-- Key tag End --> 
      
      <!-- Box search -->
      <div class="searchbox">
        <form action="" name="" id="" method="post">
          <p class="isearch" onclick=""></p>
          <p class="iconsearch">
            <input type="text" id="txtQuery" maxlength="100" placeholder="Nhập tên thương hiệu, mã hoặc đặc điểm sản phẩm" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
          </p>
          <p class="iconbutton" onclick=""> </p>
        </form>
      </div>
    </div>
    <div class="hotline">
      <p> Hotline:</p>
      <p class="num"> <?php echo $h_hotline; ?></p>
    </div>
    <div class="Share">
      <p> Chia sẻ:</p>
      <p> <a title="Đăng lên Facebook" style="cursor: pointer;" onclick="window.open('http://www.facebook.com/share.php?u='+document.location,'_blank');" class="facebook" rel="nofollow"></a> <a title="Đăng lên Twitter" style="cursor: pointer;" onclick="window.open('http://twitter.com/home?status='+document.location,'_blank');" class="twitter" rel="nofollow"> </a> <a title="Đăng lên googleplus" class="googleplus" onclick="window.open('https://plus.google.com/share?url='+document.location,'_blank');" rel="nofollow"></a> <a id="ShowMailBox999" title="" class="email" href="/nguoi-dung/Moi-ban-be.aspx?iframe=true&amp;width=735&amp;height=645" rel="nofollow" style="display:block"> </a> </p>
    </div>
  </div>
  <!-- Section hdchon: logo, search, info numberphone, share End--> 
  
  <!-- Section nav: container menu, navbar, Begin-->
  
  <div class="span-26 nav"> 
    <!-- Menu Begin -->
    <ul id="menu" class="sf-menu sf-navbar">
      <div class="home"> <a href="<?php echo base_url(); ?>"></a> </div>
      <?php
        foreach ($menu['parent'] as $row) {
        
      ?>
      <!-- Menu Item 1 Begin-->
      <li class="current sfHover"> <a href="<?php echo $row->link; ?>" title="<?php echo $row->name; ?>"><?php echo $row->name; ?></a> 
        
        <?php if($row->code == "ms") { 

        ?>
        <!-- Submenu Begin-->
        <div class="subl_1"> 
          
          <!-- ul#CateListMenu Begin-->
          <ul id="CateListMenu">
            <?php 
            foreach ($category['parent'] as $row1) {
             
            ?>
            <!-- ul#CateListMenu Item 1 li.parentcatid0 Begin-->
            <li class="parentcatid0"><a href=""> <?php echo $row1->name; ?></a> 
              <!-- div.chon_2columns.chon-megamenu store all column Begin-->
              <div class="chon_2columns chon-megamenu"> 
                <!-- div store category (DANH MỤC) Begin-->
                <div class="col_2">
                  <div class="drawer">Danh mục <a class="readmore" href="">Xem tất cả &gt;&gt; </a></div>
                  
                  <!-- col left Begin-->
                  <ul class="navgray">
                    <?php 
                    foreach ($category['children'][$categorycount] as $row2) {                     
                    ?>
                    <li> 
                      <a class="dm_a" href="" title="<?php echo $row2->name; ?>" target="_self"> 
                        <span> <img src="<?php echo base_url('public').'/'.$row2->images; ?>" alt="<?php echo $row2->name; ?>" title="<?php echo $row2->name; ?>"></span> <?php echo $row2->name; ?> </a> 
                    </li>  
                    <?php          
                      $category['countchildren2'][$categorycount]++;
                      if($category['countchildren2'][$categorycount] > 10) {
                        break;
                      }
                    } 
                    //End loop children category?>                  
                  </ul>
                  <!-- col left End--> 
                  <!-- col right Begin-->
                  <?php 
                    if($category['countchildren'][$categorycount] > 10) {
                  ?>
                  <ul class="navgray">
                    <?php 
                    foreach ($category['children'][$categorycount] as $row2) {   
                      if($category['countchildren3'][$categorycount] > 10) {              
                    ?>
                    <li> 
                      <a class="dm_a" href="" title="<?php echo $row2->name; ?>" target="_self"> 
                        <span> <img src="<?php echo base_url('public').'/'.$row2->images; ?>" alt="<?php echo $row2->name; ?>" title="<?php echo $row2->name; ?>"></span> <?php echo $row2->name; ?> </a> 
                    </li>  
                    <?php  
                      }        
                      $category['countchildren3'][$categorycount]++;
                      if($category['countchildren3'][$categorycount] == $category['countchildren'][$categorycount]) {
                        break;
                      }
                    } 
                    //End loop children category?>
                  </ul>
                  <?php }?>
                  <!-- col right End-->                   
                </div>
                <!-- div store category (DANH MỤC) End--> 
                <!-- div.col_3 store brand (THƯƠNG HIỆU) Begin-->
                <div class="col_3">
                  <div class="drawer">Tất cả thương hiệu<a class="readmore" href="">Xem tất cả &gt;&gt; </a></div>                  
                  
                  <ul class="navgray2">
                  </ul>
                </div>
                <!-- div.col_3 store brand (THƯƠNG HIỆU) End--> 
                <!-- div.col_1 store sort ,use product Begin  -->
                <div class="col_1"> 
                  <!-- Sort Begin-->
                  <div class="drawer">Loại sản phẩm</div>
                  <ul class="navgray1">
                    <li><a href="" title="<?php echo $row1->name; ?>" target="_self">Mới nhất</a></li>
                    <li><a href="" title="<?php echo $row1->name; ?>" target="_self">Giá thấp nhất </a></li>
                    <li><a href="" title="<?php echo $row1->name; ?>" target="_self">Khuyến mãi lớn nhất </a></li>
                    <li><a href="" title="<?php echo $row1->name; ?>" target="_self">Nổi bật nhất </a></li>
                    <li><a href="" title="<?php echo $row1->name; ?>" target="_self">Yêu thích nhất </a></li>
                  </ul>
                  <!-- Sort End--> 
                  <!-- Use Begin-->
                  <div class="drawer" style="display:none;"> Mục đích sử dụng </div>
                  <ul class="navgray1" style="display:none;">
                    <li><a href="">Dạo phố</a></li>
                    <li><a href="">Công sở</a></li>
                    <li><a href="">Đi tiệc</a></li>
                    <li><a href="">Du lịch</a></li>
                    <li><a href="">Đi học</a></li>
                    <li><a href="">Khác</a></li>
                  </ul>
                  <!-- Use End--> 
                </div>
                <!-- div.col_1 store sort ,use product End  --> 
                <!-- div.col_1 store sort price of product Begin -->
                <div class="col_1">
                  <div class="drawer">Giá bán</div>
                  <ul class="navgray1">
                    <li><a href=""> Dưới 200 ngàn</a></li>
                    <li><a href=""> 200 ngàn                                -                                400 ngàn</a></li>
                    <li><a href=""> 400 ngàn                                -                                600 ngàn</a></li>
                    <li><a href=""> 600 ngàn                                -                                800 ngàn</a></li>
                    <li><a href=""> Trên 800 ngàn</a></li>
                  </ul>
                  <div class="nav-adv"> 
                    <a href="<?php echo $row1->link; ?>" target="_blank"> 
                      <img alt="banner 0612-02" src="<?php echo base_url('public').'/'.$row1->images; ?>" width="165" height="209"> 
                    </a> 
                  </div>
                </div>
                <!-- div.col_1 store sort price of product Begin --> 
              </div>
              <!-- div.chon_2columns.chon-megamenu store all column End--> 
            </li>
            <!-- ul#CateListMenu Item 1 li.parentcatid0 End-->
            <?php 
              $categorycount++;
              }//end foreach parent category
            ?>
          </ul>
          <!-- ul#CateListMenu End--> 
        </div>
        <!-- Submenu End--> 
        <?php             
          } //end if
        ?>
      
      <!-- Menu Item 1 End--> 
            
      <!-- Menu Item 5 Begin-->
        <?php if($row->code == "ch") { 

        ?>
        <div id="popupmerchantlist" class="lever01">
          <div class="col_1">
            <h2>Cửa hàng nổi bật nhất</h2>
            <ul>
              <?php 
                foreach ($storehighlights as $rowhighlights) {                  
              ?>
              <li><a title="<?php echo $rowhighlights->name; ?>" target="_self" href="<?php echo base_url('cua-hang')."/".$rowhighlights->name."/trang-chu"; ?>?rel=<?php echo $rowhighlights->id;?>"> <?php echo $rowhighlights->name; ?></a></li>
              <?php }?>
            </ul>
            <div class="col-foot"> <a href="" style="text-align: right;">Tất cả &gt;&gt;</a></div>
          </div>
          <div class="col_1">
            <h2> Cửa hàng Diamond</h2>
            <ul>
              <?php 
                foreach ($storediamond as $rowdiamond) {                  
              ?>
              <li><a title="<?php echo $rowdiamond->name; ?>" target="_self" href="<?php echo base_url('cua-hang')."/".$rowdiamond->name."/trang-chu"; ?>?rel=<?php echo $rowdiamond->id;?>"> <?php echo $rowdiamond->name; ?></a></li>
              <?php }?>
            </ul>
            <div class="col-foot"> <a href="" style="text-align: right;">Tất cả &gt;&gt;</a></div>
          </div>
          <div class="col_2">
            <div class="col_2c2">
              <h2> Tất cả cửa hàng</h2>
              <div class="col_2c2_inner" id="col_2c2_inner">
                <?php 
                  for(; $countstore < $group; ) {
                  ?>
                  <ul class="ul-store">
                    <?php 
                      foreach ($store[$countstore] as $rowstore) {
                    ?>
                      <li><a title="<?php echo $rowstore->name; ?>" target="_self" href="<?php echo base_url('cua-hang')."/".$rowstore->name."/trang-chu"; ?>?rel=<?php echo $rowstore->id;?>"> <?php echo $rowstore->name; ?></a></li>
                    
                    <?php 
                      }
                    ?>
                  </ul>
                  <?php                    
                    $countstore++;
                  } //End for get store?>                
              </div>
            </div>
            <div class="ch_arr"> <a href="#" onclick="PrevPagging();" id="pre"><em>Trước</em><img src="<?php echo base_url('themes/default'); ?>/images/icon/prev-slide-list.gif"></a> <a href="#" id="next" onclick="NextPagging();"><em>Sau</em><img src="<?php echo base_url('themes/default'); ?>/images/icon/index_opt6_17.jpg"></a></div>
            <div class="col-foot"> <a href="" style="text-align: right;">Tất cả &gt;&gt;</a></div>
          </div>
        </div>
        <?php }?>
      <!-- Menu Item 5 End--> 
      
      
      <!-- Menu Item 9 Begin-->
      <?php 
        if($menu['children'][$menucount] != "") {
      ?>
        <div class="lever02">
          <ul>
            <?php 
              foreach ($menu['children'][$menucount] as $row3) {              
            ?>
            <li><a href="<?php echo $row3->link; ?>" title="<?php echo $row3->name; ?>"><?php echo $row3->name; ?></a></li>  
            <?php  
              }
            ?>          
          </ul>
        </div>
      <?php }?>
      <!-- Menu Item 9 End--> 
      </li>
      <?php 
        $menucount++;
      }?>
    </ul>
    <!-- Menu End --> 
  </div>
  <!-- Section nav: container menu, navbar, Begin--> 
</header>
<!-- Header End --> 

<!-- Header Responsive Begin -->
<header id="h" class="">
  <h1 id="logo"> <a href="<?php echo base_url(); ?>">Chọn.vn</a> </h1>
  <div id="h_i"> <a id="h_seach_i" class="h_i" href="javascript:void(0)"> <span class="i"></span> <i class="small_arrow"></i> </a> <a id="h_menu_i" class="h_i" href="javascript:void(0)"> <span class="i"></span> </a> <a id="h_cart_i" class="h_i" href="javascript:void(0)"> <span class="i"></span> <i class="small_arrow"></i> <span id="totalcartitem" class="h_cart_bagget ra10">0</span> </a> </div>
</header>

<!--Menu Begin-->
<div class="header_menu_outter menu_pop" id="wrapper" style="display: none;">
  <div class="pop_menu" id="header_menu">
    <ul class="sub_accordion">
      <?php 
        foreach ($category['parent'] as $row1) {             
      ?> 
      <li class=""> <a href="javascript:void(0)"><?php echo $row1->name; ?></a>
        <ul style="display: none;">
          <?php 
            foreach ($category['children'][$categoryrpecount] as $row2) {                     
          ?>
          <li> <a href=""><?php echo $row2->name; ?></a> </li>    
          <?php }?>      
        </ul>
      </li>   
      <?php 
        $categoryrpecount++;
      } ?>
    </ul>
    <div class="clearfix"></div>
  </div>
</div>
<!-- Menu End --> 

	<!-- Card Begin-->
<div class="header_cart_outter menu_pop" style="display: none;">
  <div id="header_cart">
    <p id="totalamount" class="aright white">Tổng thanh toán: 
      0đ </p>
    <a href="/cart/CartProduct.aspx" class="red_btn">Thanh toán</a><br>
    <a href="javascript:void(0)" id="btnclosepopup" class="blue_btn">Tiếp tục mua sắm</a>
    <div class="clearfix"></div>
  </div>
</div>
<!-- Card End --> 
<!-- SearchBox Begin-->
<div style="display:none" class="header_search clearfix">
  <div class="row" id="search_box2" style="display: none;">
    <input type="text" placeholder="Từ khóa" id="querySearch2">
    <a onclick="ClickSearch()" id="search_btn2" class="black_btn fltlft">Tìm</a> </div>
  <div style="display:none" class="autoSearch">
    <ul id="autocomplete">
    </ul>
  </div>
</div>
<div class="gridContainer">
  <div class="row" id="search_box">
    <input type="text" placeholder="Từ khóa" id="querySearch">
    <a onclick="ClickSearch()" id="search_btn" class="black_btn fltlft">Tìm</a> </div>
  <div style="display:none" class="autoSearch2">
    <ul id="autocomplete2">
    </ul>
  </div>
</div>
<!-- SearchBox End--> 
<script type="text/javascript" language="javascript">
	(function(jQuery){
		jQuery.fn.extend({
			accordion: function() {
				return this.each(function() {
					var $ul = $(this);
					if($ul.data('accordiated'))
						return false;
					$.each($ul.find('ul, li>div'), function(){
						$(this).data('accordiated', true);
						$(this).hide();
					});
					$.each($ul.find('a'), function(){
						$(this).click(function(e){
							activate(this);
							return void(0);
						});
					});
					var active = (location.hash)?$(this).find('a[href=' + location.hash + ']')[0]:'';
					if(active){
						activate(active, 'toggle');
						$(active).parents().show();
					}
					function activate(el,effect){
						$(el).parent('li').toggleClass('active').siblings().removeClass('active').children('ul, div').slideUp('fast');
						$(el).siblings('ul, div')[(effect || 'slideToggle')]((!effect)?'fast':null);
					}
				});
			}
		});
	})(jQuery);
    $(document).ready(function(e) {
	
        $('#main_menu ul').accordion();
        $('#header_menu ul').accordion();
        $('#h_cart_i').click(function() {
            // $('.menu_pop').hide();
            if ($('.header_cart_outter').is(':hidden'))
                $('.header_cart_outter').show();
            else
                $('.header_cart_outter').hide();
            $('.header_search').hide();
            $('#search_box2').hide();
            $('.header_menu_outter').hide();

        });

        $('#h_menu_i').click(function() {
            $(this).removeClass('active');
            if ($('.header_menu_outter').is(':hidden')) {
                $('.header_menu_outter').show();
                $(this).addClass('active');
            }
            else {
                $('.header_menu_outter').hide();
                $(this).removeClass('active');
            }
            $('.header_cart_outter').hide();
            $('.header_search').hide();
            $('#search_box2').hide();

        });
		
		
        //$('#h_seach_i').click(function() {
            //if (window.location.pathname != "/" &amp;&amp; window.location.pathname != "/Default.aspx") {
                //if ($('.header_search').is(':hidden')) {
                    //$(".ovl").show();
                    //$('.header_search').show();
                    //$('#search_box2').show();
                //}
                //else {
                    //$('.header_search').hide();
                    //$('#search_box2').hide();
                    //$(".ovl").hide();
                //}
                //$('.header_menu_outter').hide();
                //$('.header_cart_outter').hide();
            //}
        //});

        $("#btnclosepopup").click(function() {
            $('.header_cart_outter').hide();
        });
        
    });	
</script> 
<!-- Header Responsive End --> 