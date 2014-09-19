  <form action="<?=base_url();?>attendant/bookCustomer/<?=$attendant_id;?>" method="post">
    <label for="group">Unternehmen auswählen:</label><br />
   	<select class="chooseGroup" name="chooseCustomer" size="1">
   	<?php foreach ($customers as $customer) :?>
      <option value="<?=$customer->id;?>"><?=$customer->name;?></option>
    <?php endforeach; ?> 
    </select>
    <div class="clear"></div> 

    <input type="submit" value="Speichern" id="saveButton" name="save" />
    <div class="clear"></div>

  </form>

</body>