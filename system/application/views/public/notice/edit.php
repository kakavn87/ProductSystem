
<script>
  $("textarea").jqte();
  </script>
 <form class="data" action="<?=base_url();?>note/save/<?=$notice->id;?>" method="post">
    <label for="notice">Notiz:</label><br />
    <textarea cols="100" rows="20" id="notice" name="notice" value=""><?=$notice->notice;?></textarea>
    <div class="clear"></div> 

    <input type="hidden" name="attendants_id" value="<?=$notice->attendants_id;?>" />
    <input type="hidden" name="customers_id" value="<?=$customer;?>" />

    <input type="submit" value="Speichern" id="saveButton" name="save" />
    <div class="clear"></div>

  </form>