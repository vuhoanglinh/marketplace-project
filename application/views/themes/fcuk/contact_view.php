<!-- CONTENT: BEGIN -->
<div id="container">
  <ul id="breadcrumb" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
    <li><a href="<?php echo base_url('cua-hang')."/".$h_name."/trang-chu"; ?>?rel=<?php echo $hr_rel;?>"> <img src="<?php echo base_url('themes') ?>/francosarto/images/home2.jpg" alt=""></a></li>
    <li>Liên hệ</li>
  </ul>
  <div class="subpage">
    <div class="spacing">&nbsp;</div>
    <div class="fullpage_content">
      <div class="big_left_title">
        <h3 class="customfont white upper">Liên hệ</h3>
        <div class="clearfloat"></div>
      </div>
      <div class="event_content">
        <div class="event_content">
          <h1 class="about_title customfont upper gray fltlft"> <img align="left" src="<?php echo $hr_logo; ?>" alt="<?php echo $h_name; ?>"> </h1>
          <div class="contact_info fltlft">
            <?php echo $b_detail; ?>
          </div>
          <div class="spacing"></div>
          <div class="contact_content">
            <div class="contact_intro fltlft">
              <h3 class="red1 customfont upper">Liên hệ với <?php echo $h_name; ?></h3>
              <p>Quý khách vui lòng điền đầy đủ thông tin vào các ô bên phải và gởi về cho chúng tôi.</p>
            </div>
            <div class="contact_form fltlft">
              <?php echo form_open('stores/merchant/addContact',array('id' => 'frmcontact')); ?>
              <div class="spacing"></div>
              <label><strong>Họ tên:*</strong></label>
              <span id="spanName" style="color:Red;font-size:7pt;font-style:italic;display:none;">Vui lòng nhập tên</span>
              <input name="txtName" type="text" id="txtName">
              <label><strong>Công ty:</strong></label>              
              <input name="txtCompany" type="text" id="txtCompany">
              <label><strong>Email:*</strong></label>
              <span id="spanEmail" style="color:Red;font-size:7pt;font-style:italic;display:none;">Email không hợp lệ</span> <span id="spanEmail1" style="color:Red;font-size:7pt;font-style:italic;display:none;">Vui lòng nhập Email</span>
              <input name="txtEmail" type="text" id="txtEmail">              
              <label><strong>Điện thoại:*</strong></label>
              <span id="spanPhone" style="color:Red;font-size:7pt;font-style:italic;display:none;">Vui lòng nhập 8-12 số</span> <span id="spanPhone1" style="color:Red;font-size:7pt;font-style:italic;display:none;">Vui lòng nhập số điện thoại</span>
              <input name="txtPhone" type="text" id="txtPhone">
              <label><strong>Thông điệp:*</strong></label>
              <span id="spanComments" style="color:Red;font-size:7pt;font-style:italic;display:none;">Vui lòng nhập thông điệp</span>
              <textarea name="txtComments" rows="5" cols="30" id="txtComments"></textarea>
              Những phần đánh dấu (*) là bắt buộc!<br>
              <div class="clearfloat"></div>
              <input type="hidden" name="hd_id_store" id="hd_id_store" value="<?php echo $id_store; ?>">
              <button id="btnSubmit" class="btn_blue fltrt" type="submit"><span>Gửi đi</span></button> <button type="reset" id="btnCancel" class="btn_gray fltrt">Nhập lại</button> </div>              
              <div id="success" style="color:Red;font-style:italic;display:none;">Gửi thành công </div>
              <div id="error" style="color:Red;font-style:italic;display:none;">Gửi thất bại </div>
              </form>
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
                      $('#spanPhone1').show();
                      $('#spanPhone').hide();
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
                          $('#spanPhone1').hide();
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
                    if(checkname() && checkemail() && checkphone()  && checkcoments() ) {              
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- CONTENT: END --> 