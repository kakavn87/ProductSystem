<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/orders/list-order.css" media="screen, projection" />
<div class="grey">
<form action="" method="post">
	<div id="left">
		<h1>Profiles</h1>
		<div class="orderBox">
			<h1>Lists<button type="button" class="add-profile" style="float: right" data-href="<?php echo base_url(); ?>profiles/edit">Add</button></h1>
			<div class="clear"></div>
				<table width="100%" style="border-color: #CCC; border-collapse:collapse" border="1">
					<tr><th align="left">Name</th><th></th></tr>
					<?php foreach($profiles as $profile): ?>
					<tr>
						<td class="profile-lists"><?php echo $profile->name; ?></td>
						<td>
						<a href="<?php echo base_url(); ?>profiles/edit/<?php echo $profile->id; ?>">Edit</a>&nbsp;
						<a href="javascript:void(0);" class="profile-delete" data-href="<?php echo base_url(); ?>profiles/delete/<?php echo $profile->id; ?>">Delete</a>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
		</div>
		<div class="clear"></div>
	</div>
</form>
</div>
<script src="<?=base_url();?>js/profiles/edit.js"></script>