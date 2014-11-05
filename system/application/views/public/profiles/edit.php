<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/orders/list-order.css" media="screen, projection" />
<div class="grey">
<form action="<?php echo base_url(); ?>profiles/save" method="post">
	<div id="left">
		<h1>Profiles</h1>
		<div class="orderBox">
			<h1>Edit</h1>
			<div class="clear"></div>
			<div class="info">
				<label>Type</label>
				<select class="type" name="data[type]">
					<option value="organization" <?php echo isset($profile) && $profile->type == 'organization'?'selected="selected"':'';?>>Organization</option>
					<option value="modul" <?php echo isset($profile) && $profile->type == 'modul'?'selected="selected"':'';?>>Modul</option>
					<option value="provider" <?php echo isset($profile) && $profile->type == 'provider'?'selected="selected"':'';?>>Provider</option>
				</select>
			</div>
			<div class="info ui-widget">
				<label>Name:</label>
				<input type="text" name="data[name]" class="name-profile" value="<?php echo isset($profile)?$profile->name:'';?>" />
				<select name="data[operator]" class="operator" style="<?php echo isset($profile) && $profile->type != 'modul'?'display: none"':'';?>">
					<option value="=" <?php echo isset($profile) && $profile->operator == '='?'selected="selected"':'';?>>=</option>
				</select>
				<input style="<?php echo isset($profile) && $profile->type != 'modul'?'display: none"':'';?>" class="value" type="text" name="data[value]" value="<?php echo isset($profile)?$profile->value:'';?>" />
			</div>
			<div class="info">
				<label>Organization: </label>
				<input type="text" name="data[organization]" value="<?php echo isset($profile)?$profile->organization:'';?>" />
			</div>
			<button type="submit">Save</button>
			<input type="hidden" name="data[id]" value="<?php echo isset($profile)?$profile->id:'';?>" />
		</div>
		<div class="clear"></div>
	</div>
</form>
</div>
<script src="<?=base_url();?>js/profiles/edit.js"></script>