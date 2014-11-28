<?= $this->load->view('_template/public_header.html'); ?>
<script type="text/javascript">
var BASE_URL = '<?php echo base_url(); ?>';
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/popup-order.css" media="screen, projection" />
<div id="topline">
  <img src="<?=base_url();?>css/images/logo.jpg" alt="Logo" />
</div> 
<div id="login">
  <h1>Zum Adminbereich</h1>
  <form id="loginForm" class="data login" action="<?=base_url();?>login/check" method="post">
  
    <?php if (isset($errorMail)) { echo $errorMail; } ?>
    <label for="mail">Ihre E-Mail Adresse:</label><br/>
    <input type="text" id="mail" name="mail" value="" /><br/>
    <label for="mail">Ihr Passwort:</label><br/>
    <input type="password" id="password" name="password" value="" /><br/>
    <input type="submit" value="Abschicken" />
    <a class="registration" href="<?=base_url();?>users/edit">Registration</a>
  </form>

</div>
<script src="<?=base_url();?>js/common.js"></script>
<script src="<?=base_url();?>js/order_popup.js"></script>