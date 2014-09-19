  
 <script>
  $("textarea").jqte();
  </script>
  <form class="data" action="<?=base_url();?>note/add/attendant/<?=$attendant;?>/customer/<?=$customer;?>" method="post">
    <label for="notice">Notiz:</label><br />
    <textarea cols="100" rows="20" id="notice" name="notice" value=""></textarea>
    <div class="clear"></div> 

    <input type="submit" value="Speichern" id="saveButton" name="save" />
    <div class="clear"></div>




