<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap2/bootstrap-switch.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>
<div class="margin-bottom-10">
 <div class="bootstrap-switch-id-price_check bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-animate bootstrap-switch-on" style="width: 86px;"><div class="bootstrap-switch-container" style="width: 128px; margin-left: 0px;"><span class="bootstrap-switch-handle-on bootstrap-switch-primary" style="width: 42px;">ON</span><span class="bootstrap-switch-label" style="width: 44px;">&nbsp;</span><span class="bootstrap-switch-handle-off bootstrap-switch-info" style="width: 42px;">OFF</span><input type="checkbox" class="make-switch" id="price_check" name="pricing" data-on-color="primary" data-off-color="info" value="value"></div></div>
  </div>
  
  <script>
      $('.make-switch').bootstrapSwitch('state');
$('#price_check').click(function () {
  //alert('Test');
  var check = $(this).val();
  alert(check);
   console.log(check)
});

  </script>