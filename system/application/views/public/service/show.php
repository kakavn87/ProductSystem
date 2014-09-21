<div class="grey">
	<form action="" method="post">
		<h1>
			<input placeholder="Service Name" type="text" id="name"
				name="name" value="">
		</h1>
		<div id="left">
			<div class="bottomBox">
				<h1>Modules</h1>

				<div class="clear"></div>

				<div class="searchbox" style="padding: 4px">
					<span>Search: </span> <input type="text" class="searchmodul"
						id="searchmodul" value="" />
				</div>
				<div id="scroller" class="scrollerNav modulesNav">
<?php foreach($modules as $modul): ?>
<div class="modul-name">
						<input type="checkbox" id="modul" class="modul"
							data-modulname='{"id": <?php echo $modul->id; ?>, "modul":"<?php echo $modul->name; ?>"}' /> 
	<?php echo $modul->name; ?>
</div>
<?php endforeach; ?>
</div>
				<button class="addToService">Add To Service</button>
			</div>
				<div class="bottomBox2">
					<h1>DL</h1>
					<div class="clear"></div>
					
					<div class="modulList"></div>
				</div>
				<div class="clear"></div>
				
			</div>
			<div class="filter">
				<div>
					<label>Order</label> <select id="roles"
						data-placeholder="Choose a order ..." style="width: 350px;"
						class="chosen-select">
						<option value=""></option>
	            <?php foreach($orders as $order) : ?>
	            	<option value="<?php echo $order->id; ?>"><?php echo $order->number; ?></option>
	            <?php endforeach;?>
	          </select>
				</div>
				<div>
					<label>Requirement</label> <select id="roles"
						data-placeholder="Choose a requirment ..." style="width: 350px;"
						class="chosen-select">
						<option value=""></option>
            <?php foreach($requirements as $re) : ?>
            	<option value="<?php echo $re->id; ?>"><?php echo $re->description; ?></option>
            <?php endforeach;?>
          </select>
				</div>
				<div>
					<label>Role</label> <select id="roles"
						data-placeholder="Choose a role ..." style="width: 350px;"
						class="chosen-select">
						<option value=""></option>
		            <?php foreach($roles as $role) : ?>
		            	<option value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
		            <?php endforeach;?>
		          </select>
				</div>
				<div>
					<label>Products</label> <select id="products"
						data-placeholder="Choose a role ..." style="width: 350px;"
						class="chosen-select">
						<option value=""></option>
	            <?php foreach($products as $product) : ?>
	            	<option value="<?php echo $product->id; ?>"><?php echo $product->name; ?></option>
	            <?php endforeach;?>
	          </select>
				</div>

				<input type="button" value="Save Service" name="save"
					class="saveService" />
			</div>
	
	</form>
</div>
<script src="<?=base_url();?>js/service/show.js"></script>