  <form action="<?=base_url();?>customer/bookbranch/<?=$customer_id;?>" method="post">
    <label for="attendant">Branche hinzufügen:</label><br />
   	<select class="chooseProduct" name="chooseBranch" size="1">
   	<?php foreach ($branchs as $branch) :?>
      <option value="<?=$branch->id;?>"><?=$branch->name;?></option>
    <?php endforeach; ?> 
    </select>
    <div class="clear"></div> 

    <input type="submit" value="Speichern" id="saveButton" name="save" />
    <div class="clear"></div>

  </form>
