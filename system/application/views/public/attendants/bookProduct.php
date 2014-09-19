   <script>
      $(document).ready(function() { 
        $("#datepicker2").datepicker(
          {dateFormat: 'dd.mm.yy'}
        );
      }); 
   </script>
  <form action="<?=base_url();?>attendant/bookProduct/<?=$attendant_id;?>" method="post">

    <label for="product">Datum auswählen:</label><br />
    <input type="text" name="datepicker2" id="datepicker2" /><br/><br/>

    <label for="product">Projekt auswählen:</label><br />
   	<select class="chooseProduct" name="chooseProduct" size="1">
   	<?php foreach ($products as $prod) :?>
      <option value="<?=$prod->id;?>"><?=$prod->name;?></option>
    <?php endforeach; ?> 
    </select><br/><br/>
    <div class="clear"></div> 

    <label for="product">Unternehmen auswählen:</label><br />
    <select class="chooseCompany" name="chooseCompany" size="1">
    <?php foreach ($customers as $customer) :?>
      <option value="<?=$customer->customer_id;?>"><?=$customer->name;?></option>
    <?php endforeach; ?> 
    </select><br/><br/>
    <div class="clear"></div> 

    <input type="submit" value="Speichern" id="saveButton" name="save" />
    <div class="clear"></div>

  </form>
