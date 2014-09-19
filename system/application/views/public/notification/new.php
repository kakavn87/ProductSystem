
  <form action="<?=base_url();?>notification/sendMessage/<?= $site;?>/<?= $id;?>" method="post">
    <label for="message">Neue Nachricht senden:</label><br />
    <textarea cols="100" rows="20" id="message" name="message" value=""></textarea>
    <div class="clear"></div> 

    <input type="submit" value="Senden" id="saveButton" name="save" />
    <div class="clear"></div>
  </form>
