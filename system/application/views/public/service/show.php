<div class="grey">
<form class="data" action="" method="post">
	<h1>Service Name</h1><div class="bottomBox">
<div class="addButton">
								<a class="newWindow"
									href="#"><span
									class="greenFont">+</span> Notiz hinzufügen</a>
							</div></div>
	<div id="left"></div>
	<div id="right">
	</div>
	<div>
	<label>Order</label>
	<select id="roles" data-placeholder="Choose a order ..."
			style="width: 350px;" class="chosen-select">
			<option value=""></option>
            <?php foreach($roles as $role) : ?>
            	<option value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
            <?php endforeach;?>
          </select>
          <div class="clear"></div>
    <label>Requirement</label>
	<select id="roles" data-placeholder="Choose a requirment ..."
			style="width: 350px;" class="chosen-select">
			<option value=""></option>
            <?php foreach($roles as $role) : ?>
            	<option value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
            <?php endforeach;?>
          </select>
          <div class="clear"></div>
          <label>Role</label>
	<select id="roles" data-placeholder="Choose a role ..."
			style="width: 350px;" class="chosen-select">
			<option value=""></option>
            <?php foreach($roles as $role) : ?>
            	<option value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
            <?php endforeach;?>
          </select>
          <div class="clear"></div>
	</div>
</div>
</form>
<script src="<?=base_url();?>js/service/show.js"></script>