<style type="text/css">
  .err{
    color:red;
    text-align:center;
  }
  .hide{
    display: none;
  }
  .show{
    display: block;
  }
</style>
<div class="contact_us">
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 form">
          <div class="row form-row">
            <div class="col-12">
              <h2 class="mt-5 mb-5">Contact Us</h2>
              <div class="row">
                <div class="col-md-12 text-center alert alert-success hide">

                </div>
                <div class="col-12">
                  <form role="role" class="mb-5" id="contact-form" onsubmit="contactFormSubmit(event)" method="POST">
                    <div class="form-group">
                      <input type="name" class="form-control" name="name" id="name" placeholder="Name">
                      <div class="err hide" id="name-err"></div>
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                      <div class="err hide" id="email-err"></div>
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" placeholder="Message" id="message" name="message" rows="4"></textarea>
                      <div class="err hide" id="message-err"></div>
                    </div>
                    <button id="contact-btn" type="submit" class="btn btn-light rounded-0" >Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>

      <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-0 social_info" style="background: white">
        <div class="d-flex justify-content-center social_info pt-3 pb-3">
          <div class="text-white social_links">
            <a href="#">
              <i class="fab fa-facebook-f fa-2x"></i>
            </a>
          </div>
          <div class="text-white social_links">
            <a href="#">
              <i class="fab fa-twitter fa-2x"></i>
            </a>
          </div>
          <div class="text-white social_links">
            <a href="#">
              <i class="fab fa-linkedin fa-2x"></i>
            </a>
          </div>
        </div>

        <div class="d-flex justify-content-center info">
          <ul>
            <li>
              <i class="fas fa-map-marker-alt fa-lg"></i>
              <b class="ml-3">
                <a href="#"> Some where in the world </a>
              </b>
            </li>
            <li>
              <i class="fas fa-envelope"></i>
              <b class="ml-3">
                <a href="#"> Some where in the world </a>
              </b>
            </li>
            <li>
              <i class="fas fa-phone fa-rotate-90"></i>
              <b class="ml-3">
                <a href="#"> Some where in the world </a>
              </b>
            </li>
          </ul>
        </div>
      </div>


    </div>

  </div>
</div>
<script type="text/javascript">
  var validateForm;
  function contactFormSubmit(e){
    e.preventDefault();
    validateForm();
    console.log(validate);
    if(validate == false){
      return false;
    }
    $('.err').hide().text('');
    var url = "<?php echo url('contact-form'); ?>";
    var token ="<?php echo csrf_token(); ?>";
    var formData = $('form').serialize()+'&_token='+token;
    console.log(formData);
    var xhr = submitFormAjax(url, formData);
    xhr.done(function(resp){
      resetForm($('form'));
      $('.alert.alert-success').show().text(resp.message);
    }).fail(function(reason){
        var resp = reason.responseJSON;
        for(var i in resp.message){
          $('#'+i+'-err').show();
          $('#'+i+'-err').text('*' +resp.message[i][0] + '*');
          $('#'+i).css('border','1px solid red');
        }
    });
  }
  function validateForm(){
    validate = true;
    $('.form-control').each(function(e){
      if(this.value==''){
        $(this).first().focus();
        $(this).css('border','2px solid red');
        validate= false;
      }else{
        $(this).css('border','1px solid green');     
        validate = true;   
      }
    })
  }
  
</script>