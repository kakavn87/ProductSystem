<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/orders/list-order.css" media="screen, projection" />
<div class="grey">
<form action="" method="post">
	<div id="left">
		<h1>Applications</h1>
		<div class="orderBox">
			<h1>Modul Lists</h1>
			<div class="clear"></div>
				<table>
					<tr>
						<th align="left">Modul</th>
						<th align="left">Service</th>
						<th></th>
					</tr>
					<?php foreach($apps as $app): ?>
					<tr>
						<td class="profile-lists"><?php echo $app->modulName; ?></td>
						<td class="profile-lists"><?php echo $app->serviceName; ?></td>
						<?php 
						if(empty($app->mrId)) :
							$apply = '';
							$view = 'style="display: none"';
						else :
							$view = '';
							$apply = 'style="display: none"';
						endif;  
						?>
						<td class="apply" <?php echo $apply; ?> data-appId="<?php echo $app->id; ?>">Apply</td>
						<td class="view" <?php echo $view; ?> data-appId="<?php echo $app->id; ?>">View</td>
					</tr>
					<?php endforeach; ?>
				</table>
		</div>
		<div class="clear"></div>
	</div>
</form>
</div>
<script src="<?=base_url();?>js/apps/apply.js"></script>