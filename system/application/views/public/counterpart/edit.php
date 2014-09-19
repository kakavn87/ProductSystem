 <form class="data" action="<?=base_url();?>customer/saveCounterpart/<?=$data->id;?>/<?=$customer_id;?>" method="post">
      <label class="user" for="firstName">Vorname:</label>
      <input type="text" id="firstName" name="firstName" value="<?=$data->firstname;?>">
      <div class="clear"></div> 
      
      <label class="user" for="lastName">Nachname:</label>
      <input type="text" id="lastName" name="lastName" value="<?=$data->lastname;?>">
      <div class="clear"></div> 

      <label class="user" for="mobile">Mobil:</label>
      <input type="text" id="mobile" name="mobile" value="<?=$data->mobile;?>">
      <div class="clear"></div>        
      
      <label class="user" for="phone">Telefon:</label>
      <input type="text" id="phone" name="phone" value="<?=$data->phone;?>">
      <div class="clear"></div>

      <label class="user" for="mail">E-Mail:</label>
      <input type="text" id="mail" name="mail" value="<?=$data->email;?>">
      <div class="clear"></div> 

      <label class="user" for="comment">Kommentar:</label><br/>
      <textarea id="comment" name="comment"><?=$data->comment;?></textarea>
      <div class="clear"></div> 

    <input type="submit" value="Speichern" id="saveButton" name="save" />
    <div class="clear"></div>

  </form>
