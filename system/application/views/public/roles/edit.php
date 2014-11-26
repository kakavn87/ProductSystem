<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/orders/list-order.css" media="screen, projection" />
<div class="grey">
<form class="frm-update-role-requirement" action="" method="post">
	<div id="left">
		<h1>Edit Requirement</h1>
		<div class="orderBox">
			<h1>Edit</h1>
			<div class="clear"></div>
			<div class="info">
				<label>Type</label>
				<select class="type" name="data[type]">
					<option value="organization" <?php echo isset($role_requirement) && $role_requirement->type == 'organization'?'selected="selected"':'';?>>Organization</option>
					<option value="modul" <?php echo isset($role_requirement) && $role_requirement->type == 'modul'?'selected="selected"':'';?>>Modul</option>
					<option value="provider" <?php echo isset($role_requirement) && $role_requirement->type == 'provider'?'selected="selected"':'';?>>Provider</option>
				</select>
			</div>
			<div class="info ui-widget">
				<label>Name:</label>
				<input type="text" name="data[name]" class="name-role_requirement" value="<?php echo isset($role_requirement)?$role_requirement->name:'';?>" />
				<select name="data[operator]" class="operator" style="<?php echo isset($role_requirement) && $role_requirement->type != 'modul'?'display: none"':'';?>">
					<option value="=" <?php echo isset($role_requirement) && $role_requirement->operator == '='?'selected="selected"':'';?>>=</option>
				</select>
				<input style="<?php echo isset($role_requirement) && $role_requirement->type != 'modul'?'display: none"':'';?>" class="value" type="text" name="data[value]" value="<?php echo isset($role_requirement)?$role_requirement->value:'';?>" />
			</div>
			<div class="info">
				<label>Organization: </label>
				<input type="text" name="data[organization]" value="<?php echo isset($role_requirement)?$role_requirement->organization:'';?>" />
			</div>
			<button class="update-role-requirement" type="button">Save</button>
			<input class="id_role_requirement" type="hidden" name="data[id]" value="<?php echo isset($role_requirement)?$role_requirement->id:'';?>" />
			<input class="role_id"  name="data[role_id]" value="<?php echo isset($role_id)?$role_id:'';?>" />
			<input class="service_id"  name="data[service_id]" value="<?php echo isset($service_id)?$service_id:'';?>" />
		</div>
		<div class="clear"></div>
	</div>
</form>
</div>
<script src="<?=base_url();?>js/service/action_role.js"></script>