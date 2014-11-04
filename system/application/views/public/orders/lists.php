<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/orders/list-order.css" media="screen, projection" />
<div class="grey">
<form action="" method="post">
	<div id="left">
		<h1>Order lists</h1>
		
		<div class="clear"></div>
		<div class="orderBox">
			<h1>To Do</h1>
			<div class="clear"></div>
			<div id="list-order">
				<?php foreach($order_unfinished as $order): ?>
					<div class="containerBox ui-state-default" data-href="<?php echo base_url(); ?>service/show/Normal/0/<?php echo $order->id; ?>"><?php echo $order->number; ?></div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="clear"></div>
		<div class="orderBox">
			<h1>finished orders</h1>
			<div class="clear"></div>
			<div id="list-order">
				<?php foreach($order_finished as $order): ?>
					<div class="containerBox ui-state-default" data-href="<?php echo base_url(); ?>service/show/Normal/0/<?php echo $order->id; ?>"><?php echo $order->number; ?></div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</form>
</div>
<script src="<?=base_url();?>js/orders/list-order.js"></script>