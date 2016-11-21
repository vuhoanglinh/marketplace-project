<!-- BEGIN: SLIDER -->

<div id="ch_wrapper">
  <div id="ch_features">
    <div id="features_panes_container">
      <div id="slider" class="nivoSlider">
        <?php 
        if(count($b_banner) > 0) {
          foreach ($b_banner as $row) {          
          ?>
          <a href='<?php echo $row->link; ?>' target="_blank"> <img alt='' src='<?php echo $row->image; ?>'  /> </a> 
          <?php 
          } 
        } 
        ?>
      </div>
    </div>
    <div class="liner"></div>
  </div>
  <!--END: SLIDER --> 
  <!-- BEGIN: BODY -->
  <div id="ch_body">
    <div id="ch_wrapper">
      <div id="ch_mainbody">
        <div id="ch_submenu">
          <div class="sub_left">
            <div class="sub_left_c">
              <h2> SẢN PHẨM</h2>
              <!-- BEGIN: CATEGORY -->
              <ul class="tabs" id="products_selection">
                <?php
                foreach($b_category['parent'] as $row)
                {
                ?>
                <li <?php echo ($b_count2 == 0) ? 'class="active"': '';?>><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&c=<?php echo $row->id; ?>" tablink="#tab<?php echo $row->id; ?>"> <em> <?php echo $row->name; ?><span class="txt_red">(<?php echo $b_category['numpparent'][$b_count2]; ?>)</span></em> </a></li>
                <?php 
                  $b_count2++;
                } ?>
              </ul>
              <!-- END: CATEGORY --> 
            </div>
            <!-- BEGIN: CATEGORY CHILDREN -->
            <div id="product_list_container">
              <div class="tab_container">
                <?php
                foreach($b_category['parent'] as $row)
                {
                ?>
                <div class="tab_content" id="tab<?php echo $row->id; ?>" style="display: <?php echo ($b_count == 0)? 'block' : ''; ?>;">
                  <div class="sub_right">
                    <div class="sub_right_r">
                      <div style="display: block" class="hnav" id="panel">
                        <ul class="Nav_sub_slide">
                          <?php 
                            foreach ($b_category['child'][$b_count] as $value) { 
                          ?>
                          <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/san-pham"; ?>?rel=<?php echo $hr_rel;?>&c=<?php echo $value->id; ?>"> <?php echo $value->name;?> <span class="txt_red">(<?php echo $b_category['numpchild'][$b_count3] ?>)</span></a></li>                          
                          <?php 
                            $b_count3++;
                            } // end foreach loop 2
                          ?>
                        </ul>
                      </div>
                      <p class="slide"> <a class="btn-slide active" href="javascript:void(0)">&nbsp;</a></p>
                    </div>
                  </div>
                </div>  
                <?php 
                    $b_count++;
                }  // end foreach loop 1
                ?>
              </div>
            </div>
            <!-- END: CATEGORY CHILDREN --> 
          </div>
        </div>
        <!-- BEGIN :BREADCRUMB -->
        <div id="ch_breadcrumbs" class="cleaner">
          <ol class="breadcrumbs">
            <li class="first-child"><a href="/" class="home" name="content"></a></li>
            <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/trang-chu"; ?>?rel=<?php echo $hr_rel;?>">Trang chủ</a></li>
            <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/lien-he"; ?>?rel=<?php echo $hr_rel;?>">Liên hệ</a></li>
          </ol>
        </div>
        <!-- END: BREADCRUMB --> 
        <!-- BEGIN: COTACT -->
        <div class="box">
          <div id="ch_products">
            <div id="introduction">
              <div class="right_pages">
              <div class="container">
                <div id="p3" style="display: block;">
                  <div id="ctl00_ctl00_cphContent_ContactMerchantForm1_udpMerchantContact">
                    <div id="ch_containt">
                      <div class="left_contact">
                        <h2><span>Liên hệ</span></h2>
                        <a href="#"><img align="left" style="margin-right:10px;" width="149" src="<?php echo $hr_logo; ?>" alt="<?php echo $h_name; ?>"></a> </div>
                      <div class="comments-form">
                        <div class="addressFrom">
                          <?php echo $b_detail; ?>
                        </div>
                        <div class="ouiForm oi">
                          <?php echo form_open('stores/merchant/addContact',array('id' => 'frmcontact')); ?>
                            <fieldset class="twocols">
                              <div class="field_holder field_gutter field_required ">
                                <label for="firstName">Họ và Tên:<span>*</span></label>
                                <span class="input_holder input_text">
                                <input name="txtName" type="text" id="txtName" class="text" size="45" placeholder="">
                                </span> <br/><span id="spanName" style="color:Red;display:none;">Vui lòng nhập họ tên</span> </div>
                              <div class="field_holder field_required ">
                                <label for="lastName">Công ty:<span class="required">*</span></label>
                                <span class="input_holder input_text">
                                <input name="txtCompany" type="text" id="txtCompany" class="text" size="45" placeholder="">
                                </span> </div>
                              <div class="field_holder field_gutter field_required ">
                                <label for="phone">Điện thoại:<span>*</span></label>
                                <span class="input_holder input_text">
                                <input name="txtPhone" type="text" id="txtPhone" class="text" size="45" placeholder="">
                                </span> <br/><span id="spanPhone1" style="color:Red;display:none;">*</span> <span id="spanPhone" style="color:Red;display:none;"><br>
                                Vui lòng nhập 8-12 số</span> </div>
                              <div class="field_holder field_gutter field_require">
                                <label for="email">Email:<span class="required">*</span></label>
                                <span class="input_holder input_text">
                                <input name="txtEmail" type="text" id="txtEmail" class="text" size="45" placeholder="">
                                </span> <br><span id="spanEmail1" style="color:Red;display:none;">Vui lòng nhập email</span><span id="spanEmail" style="color:Red;display:none;"><br>
                                Email không hợp lệ</span> </div>
                            </fieldset>
                            <fieldset class="message">
                              <div class="field_holder field_required ">
                                <label for="subject">Nội dung:<span>*</span></label>
                                <span class="input_holder input_textarea">
                                <textarea name="txtComments" rows="10" cols="47" id="txtComments" class="text"></textarea>
                                </span>
                                <p> <span id="spanComments" style="color:Red;display:none;">Vui lòng nhập nội dung liên hệ</span> </p>
                              </div>
                            </fieldset>
                            <fieldset class="twocols">
                              <div class="field_holder field_gutter field_required ">
                                <label for="verification">&nbsp;</label>
                                <span>( * ) Thông tin bắt buộc phải nhập</span> </div>
                            </fieldset>
                            <fieldset class="twocols">
                              <div class="field_holder field_gutter field_required ">
                                <label for="verification">&nbsp;</label>
                                <input type="hidden" name="hd_id_store" id="hd_id_store" value="<?php echo $id_store; ?>">
                                <button id="btnSubmit" class="submit btn" type="submit"><span>Gửi đi</span></button> <button type="reset" id="btnCancel" class="submit btn">Xóa hết</button> </div>
                            </fieldset>
                            <div id="success" style="color:Red;font-style:italic;display:none;">Gửi thành công </div>
                            <div id="error" style="color:Red;font-style:italic;display:none;">Gửi thất bại </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <script type="text/javascript">
                $(document).ready(function(){

                  function checkname()
                  {
                    var name = $('#txtName').val();
                    var bool = false;
                    if(name == "")
                    {
                      $('#spanName').show();
                      $('#txtName').focus();
                    }
                    else
                    {
                      bool = true;
                    }
                    return bool;
                  }

                  function checkphone()
                  {
                    var bool = false;
                    var phone = $('#txtPhone').val();
                    if(phone == "")
                    {
                      $('#spanPhone').show();
                      $('#txtPhone').focus();
                    }
                    else
                    {
                      if(isNaN(phone))
                      {
                       
                      }
                      else
                      {
                        if($('#txtPhone').size() < 8 && $('#txtPhone').size() > 12) {
                           $('#spanPhone').show();
                          $('#txtPhone').focus();
                        }
                        else 
                        {
                          $('#spanPhone').hide();
                          bool = true;
                        }                        
                      }                      
                    }
                    return bool;
                  }

                  function checkemail()
                  {
                    var email = $("#txtEmail").val();
                    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    var bool = false;
                    if(email =="")
                    {
                      $('#spanEmail1').show();
                      $('#txtEmail').focus();
                    }
                    else
                    {
                      if(!regex.test(email))
                      {
                        $('#spanEmail').show();
                        $('#txtEmail').focus();
                      }
                      else
                      {
                        bool = true;
                      }
                    }   
                    return bool;                
                  }

                  function checkcoments()
                  {
                    var coment = $('#txtComments').val();
                    var bool = false;
                    if(coment == "")
                    {
                      $('#spanComments').show();
                      $('#txtComments').focus();
                    }
                    else
                    {
                      bool = true;
                    }
                    return bool;
                  }

                  $('form#frmcontact').on('submit', function(){
                    $('#error').hide();
                    $('#success').hide();
                    $('#spanEmail').hide();
                    $('#spanEmail1').hide();
                    $('#spanComments').hide();
                    $('#spanPhone').hide();
                    $('#spanName').hide();
                    var from = $(this);                      
                    if(checkname() && checkphone() && checkemail() && checkcoments() ) {              
                      $.ajax({
                          url: from.attr('action'),
                          type: from.attr('method'),
                          dataType: "json",
                          data: $(from).serialize(),
                          success: function(data) {
                              if(data.status == 0) {                                
                                $("#success").show(); 
                              }       
                              else {
                                $("#error").show();
                              }                      
                          }
                      });
                    }
                    return false;
                  });
                  $('#btnCancel').click(function(){
                    $('#error').hide();
                    $('#success').hide();
                    $('#spanEmail').hide();
                    $('#spanEmail1').hide();
                    $('#spanComments').hide();
                    $('#spanPhone').hide();
                    $('#spanName').hide();
                  });

                });
                </script>
                <div id="p4" style="visibility:hidden;position:absolute;"> </div>
              </div>
            </div>
            <br clear="all">
          </div>
        </div>
      </div>
    </div>
    <!-- END: CONTACT --> 
  </div>
  <!-- END: BODY --> 
</div>
