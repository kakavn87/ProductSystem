   <script>
      $(document).ready(function() { 
        $("#datepicker2").datepicker(
          {dateFormat: 'dd.mm.yy'}
        );
      }); 
   </script>

  <form action="<?=base_url();?>attendant/saveProductDate/<?=$attendants_id;?>/<?=$product_id;?>" method="post">
    <label for="product">Datum auswählen:</label><br />
    <input type="text" name="datepicker2" id="datepicker2" value="<?=$product_date;?>"/><br/><br/>

    <input type="submit" value="Speichern" id="saveButton" name="save" />
    <div class="clear"></div>

  </form>
