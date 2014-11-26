	<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/orders/list-order.css" media="screen, projection" />
<div class="grey">
<form action="" method="post">
	<div id="left">
		<h1>Requirement</h1>
		<div class="orderBox">
			<h1>Lists<button type="button" class="add-role-requirement" style="float: right" >Add</button></h1>
			<div class="clear"></div>
				<table width="100%" style="border-color: #CCC; border-collapse:collapse" border="1">
					<tr><th align="left">Name</th><th></th></tr>
					<?php foreach($role_requirements as $role_requirement):
					$name = '';
					if(isset($role_requirement)) :
						$name = $role_requirement->name;
						if($role_requirement->type == 'modul') :
							$name = $name . ' ' . $role_requirement->operator . ' '. $role_requirement->value;
						endif;
					endif;
					?>
					<tr>
						<td class="profile-lists"><?php echo $name; ?></td>
						<td>
						<a class="edit-role-requirement" data-id="<?php echo $role_requirement->id; ?>"> Edit</a>&nbsp;
						<a  class="delete-role-requirement" data-id="<?php echo $role_requirement->id; ?>" >Delete</a>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
		</div>
		<div class="clear"></div>
	</div>
	<input class="role_id"  name="data[role_id]" value="<?php echo isset($role_id)?$role_id:'';?>" />
	<input class="service_id"  name="data[service_id]" value="<?php echo isset($service_id)?$service_id:'';?>" />
</form>
</div>
<script src="<?=base_url();?>js/service/action_role.js"></script>