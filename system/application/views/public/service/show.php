<div class="grey">
<form class="data" action="" method="post">
	<h1><input placeholder="Service Name"
										type="text" id="company" name="company"
										value=""></h1>
	<div id="left">
	<div class="bottomBox">
									<h1>Projekte</h1>
									
								<div class="clear"></div>


								<a class="newWindow"
									href="<?=base_url();?>notification/newMessage/customer/">
									<div class="greenBox">
										<img src="<?=base_url();?>css/images/mailIcon.png" alt="Mail" />
										<p>Nachricht senden</p>
										<div class="clear"></div>
									</div>
								</a>
	</div>
	<div id="right">
	
	 <div class="bottomBox">
									<h1>Projekte</h1>
									
								<div class="clear"></div>


								<a class="newWindow"
									href="<?=base_url();?>notification/newMessage/customer/">
									<div class="greenBox">
										<img src="<?=base_url();?>css/images/mailIcon.png" alt="Mail" />
										<p>Nachricht senden</p>
										<div class="clear"></div>
									</div>
								</a>
       
          
        </div>
<div class="clear"></div>
	
	</div>
	<div class="filter">
		<div>
		<label>Order</label>
		<select id="roles" data-placeholder="Choose a order ..."
				style="width: 350px;" class="chosen-select">
				<option value=""></option>
	            <?php foreach($orders as $order) : ?>
	            	<option value="<?php echo $order->id; ?>"><?php echo $order->number; ?></option>
	            <?php endforeach;?>
	          </select>
	    </div>
	    <div>
    <label>Requirement</label>
	<select id="roles" data-placeholder="Choose a requirment ..."
			style="width: 350px;" class="chosen-select">
			<option value=""></option>
            <?php foreach($requirements as $re) : ?>
            	<option value="<?php echo $re->id; ?>"><?php echo $re->description; ?></option>
            <?php endforeach;?>
          </select>
      </div>
	    <div>
          <label>Role</label>
			<select id="roles" data-placeholder="Choose a role ..."
					style="width: 350px;" class="chosen-select">
					<option value=""></option>
		            <?php foreach($roles as $role) : ?>
		            	<option value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
		            <?php endforeach;?>
		          </select>
      </div>
	    <div>
	      <label>Products</label>    
	    <select id="products" data-placeholder="Choose a role ..."
				style="width: 350px;" class="chosen-select">
				<option value=""></option>
	            <?php foreach($products as $product) : ?>
	            	<option value="<?php echo $product->id; ?>"><?php echo $product->name; ?></option>
	            <?php endforeach;?>
	          </select>
       </div>
       
      <input type="submit" value="Save Service" name="save"
										class="saveService" />
	</div>
</div>
</form>
<script src="<?=base_url();?>js/service/show.js"></script>