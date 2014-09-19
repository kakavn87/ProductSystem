  <form action="<?=base_url();?>attendant/bookGroup/<?=$attendant_id;?>" method="post">
    <label for="group">Etikett auswählen:</label><br />
   	<select class="chooseGroup" name="chooseGroup" size="1">
   	<?php foreach ($groups as $group) :?>
      <option value="<?=$group->id;?>"><?=$group->name;?></option>
    <?php endforeach; ?> 
    </select>
    <div class="clear"></div> 

    <input type="submit" value="Speichern" id="saveButton" name="save" />
    <div class="clear"></div>

  </form>

</body>