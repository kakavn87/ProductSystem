<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/orders/list-order.css" media="screen, projection" />
<div class="grey">
<form action="" method="post">
	<div id="left">
		<h1>Users</h1>
		<div class="orderBox">
			<h1>User Lists<button type="button" class="add-user" style="float: right" data-href="<?php echo base_url(); ?>users/add">Add</button></h1>
			<div class="clear"></div>
				<table>
					<tr>
						<th align="left">Name</th>
						<th align="left">Mail</th>
						<th>Role</th>
						<th>Block</th>
					</tr>
					<?php foreach($users as $user): ?>
					<tr>
						<td><a href="<?php echo base_url(); ?>users/edit/<?php echo $user->id; ?>"><?php echo $user->name; ?></a></td>
						<td><a href="mailto:<?php echo $user->mail; ?>"><?php echo $user->mail; ?></a></td>
						<td><?php echo $user->roleName; ?></td>
						<td>
						<?php if(!$user->deleted) : ?>
							<a href="<?php echo base_url(); ?>users/block/<?php echo $user->id; ?>">Block</a>
						<?php else: ?>
							<a href="<?php echo base_url(); ?>users/unblock/<?php echo $user->id; ?>">Unblock</a>
						<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
		</div>
		<div class="clear"></div>
	</div>
</form>
</div>
<script src="<?=base_url();?>js/users/lists.js"></script>