<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/orders/list-order.css" media="screen, projection" />
<div class="grey">
<form action="<?php echo base_url(); ?>users/save" method="post">
	<div id="left">
		<h1>User</h1>
		<div class="orderBox">
			<h1>Edit</h1>
			<div class="clear"></div>
			<div class="info">
				<label>Name:</label>
				<input type="text" name="data[name]" value="<?php echo isset($user)?$user->name:'';?>" />
			</div>
			<div class="info">
				<label>Email:</label>
				<input type="text" name="data[mail]" value="<?php echo isset($user)?$user->mail:'';?>" />
			</div>
			<div class="info">
				<label>Role</label>
				<select name="data[role_id]">
					<?php 
					foreach($roles as $role) :
						$selected = '';
						if(isset($user) && $user->role_id == $role->id) :
							$selected = 'selected="selected"';
						endif;  
					?>
					<option <?php echo $selected; ?> value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<button type="submit">Save</button>
			<input type="hidden" name="data[id]" value="<?php echo isset($user)?$user->id:'';?>" />
		</div>
		<div class="clear"></div>
	</div>
</form>
</div>