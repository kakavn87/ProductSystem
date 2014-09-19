<?= $this->load->view('_template/public_header.html'); ?>

<div id="topline">
  <img src="<?=base_url();?>css/images/logo.jpg" alt="Logo" />
</div> 
<div id="login">
  <h1>Zum Adminbereich</h1>
  <form class="data login" action="<?=base_url();?>login/check" method="post">
  
    <?php if (isset($errorMail)) { echo $errorMail; } ?>
    <label for="mail">Ihre E-Mail Adresse:</label><br/>
    <input type="text" id="mail" name="mail" value="" /><br/>
    <label for="mail">Ihr Passwort:</label><br/>
    <input type="password" id="password" name="password" value="" /><br/>
    <input type="submit" value="Abschicken" />
  
  </form>

</div>