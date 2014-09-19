  <form action="<?=base_url();?>customer/bookAttendant/<?=$customer_id;?>" method="post">
    <label for="attendant">Person hinzufügen:</label><br />
   	<select class="chooseProduct" name="chooseAttendant" size="1">
   	<?php foreach ($attendants as $attendant) :?>
      <option value="<?=$attendant->id;?>"><?=$attendant->firstname;?> <?=$attendant->lastname;?></option>
    <?php endforeach; ?> 
    </select>
    <div class="clear"></div> 

    <input type="submit" value="Speichern" id="saveButton" name="save" />
    <div class="clear"></div>

  </form>
