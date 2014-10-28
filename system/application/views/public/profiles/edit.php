<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/orders/list-order.css" media="screen, projection" />
<div class="grey">
<form action="<?php echo base_url(); ?>profiles/save" method="post">
	<div id="left">
		<h1>Profiles</h1>
		<div class="orderBox">
			<h1>Edit</h1>
			<div class="clear"></div>
			<div class="info">
				<label>Name:</label>
				<input type="text" name="data[name]" value="<?php echo isset($profile)?$profile->name:'';?>" />
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