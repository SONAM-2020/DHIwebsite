<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
    $this->load->view('web/include/header.php');
?> 
<div id="mainpublicContent">
  <?php
    $this->load->view('web/include/nav.php');
  ?>
  <?php
    $this->load->view('web/include/slider.php');
  ?>
  <?php
    $this->load->view('web/include/web.php');
  ?>
  <?php
    $this->load->view('web/include/footer.php');
  ?> 
</div>
<script type="text/javascript">
  function removeerr(errid){
    $('#'+errid).html('');  
  }
  function user_login(){
    if(validateloginform()){
      $.blockUI
          ({ 
            css: 
            { 
                  border: 'none', 
                  padding: '15px', 
                  backgroundColor: '#000', 
                  '-webkit-border-radius': '10px', 
                  '-moz-border-radius': '10px', 
                  opacity: .5, 
                  color: '#fff' 
            } 
          });
         $('#loginform').submit();
         
    }
  }
  function validateloginform(){
    var retuva=true;
    if($('#EmailId').val()==""){
      $('#EmailId_err').html('* Email Id/Username is required');  
      retuva=false;
    }
    if($('#password').val()==""){
      $('#password_err').html('* Password is required');  
      retuva=false;
    }
    return retuva;
  }
</script>
 
