<script type="text/javascript">
var listModules = <?php echo !isset($listModules) ? '[]' : json_encode($listModules); ?>;
</script>
<div class="grey">
	<form action="" method="post">
		<h1>
			<input placeholder="Service Name" type="text" id="name"
				name="name" value="<?php echo isset($service)?$service[0]->name:''; ?>">
		</h1>
		<div id="left">
			<div class="bottomBox">
				<h1>Standard Services</h1>

				<div class="clear"></div>

				<div class="searchbox" style="padding: 4px">
					<span>Search: </span> <input type="text" class="searchmodul"
						id="searchmodul" value="" />
				</div>
				<div id="scroller" class="scrollerNav modulesNav">
				<?php foreach($service_standards as $standard): ?>
				<div class="modul-name">
					<a href="<?php echo base_url(); ?>service/show/<?php echo $standard->id; ?>">
					<?php echo $standard->name; ?>
					</a>
				</div>
				<?php endforeach; ?>
				</div>
<!-- 				<button class="addToService">+</button> -->
			</div>
				<div class="bottomBox2">
					<h1>DL</h1>
					<div class="clear"></div>
					
					<div class="modulList" id="sortable" ></div>
				</div>
				<div class="clear"></div>
				
			</div>
			<div class="filter">
				<div>
					<label>Order</label> <select id="orders" name="order_id"
						data-placeholder="Choose a order ..." style="width: 350px;"
						class="chosen-select">
						<option value=""></option>
	            <?php foreach($orders as $order) : 
	            	$selected = '';
	            	if(isset($service)) :
	            		if($service[0]->order_id == $order->id) :
	            			$selected="selected='selected'";
	            		endif;
	            	endif; 
	            ?>
	            	<option <?php echo $selected; ?>value="<?php echo $order->id; ?>"><?php echo $order->number; ?></option>
	            <?php endforeach;?>
	          </select>
				</div>
				<div>
					<label>Requirement</label> <select id="requirments" name="requirment_id"
						data-placeholder="Choose a requirment ..." style="width: 350px;"
						class="chosen-select">
						<option value=""></option>
            <?php foreach($requirements as $re) : 
	            $selected = '';
	            if(isset($service)) :
		            if($service[0]->requirement_id == $re->id) :
		            	$selected="selected='selected'";
		            endif;
	            endif;
            ?>
            	<option <?php echo $selected; ?> value="<?php echo $re->id; ?>"><?php echo $re->description; ?></option>
            <?php endforeach;?>
          </select>
				</div>
				<div>
					<label>Role</label> <select id="roles" name="role_id" multiple
						data-placeholder="Choose a role ..." style="width: 350px;"
						class="chosen-select">
						<option value=""></option>
		            <?php foreach($roles as $role) : 
			            $selected = '';
			            if(isset($service)) :
			            	if($service[0]->role_id == $role->id) :
			            		$selected="selected='selected'";
			            	endif;
			            endif;
		            ?>
		            	<option <?php echo $selected; ?> value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
		            <?php endforeach;?>
		          </select>
				</div>
				<div>
					<label>Products</label> <select id="products" name="product_id"
						data-placeholder="Choose a role ..." style="width: 350px;"
						class="chosen-select">
						<option value=""></option>
	            <?php foreach($products as $product) : 
		            $selected = '';
		            if(isset($service)) :
		            	if($service[0]->product_id == $product->id) :
		            		$selected="selected='selected'";
		           		endif;
		            endif;
	            ?>
	            	<option <?php echo $selected; ?> value="<?php echo $product->id; ?>"><?php echo $product->name; ?></option>
	            <?php endforeach;?>
	          </select>
				</div>
				<div>
					<input <?php echo (isset($service) && $service[0]->customer_view == Dl::CUSTOMER_ALLOW) ? 'checked="checked"': ''; ?> type="checkbox" name="customer_view" id="customer_view" value="1" /> Customer View
				</div>
				<div>
					<input <?php echo (isset($service) && $service[0]->type == Dl::TYPE_STANDARD) ? 'checked="checked"': ''; ?>type="checkbox" name="standard" id="standard" value="1" /> Save as Service Standard
				</div>
				<input type="hidden" name="id" id="serviceid" value="<?php echo isset($service)?$service[0]->id:''; ?>" />
				<input type="button" value="Save Service" name="save"
					id="saveService" />
			</div>
	
	</form>
	<div class="clear"></div>
	<div class="comments">
		<h3>Comments</h3>
		<div class="comments-list"></div>
		<div>
			<textarea name="comment" class="comment-text" rows="8" cols="60"></textarea>
		</div>
		<button id="addComment">Add Comment</button>
	</div>
</div>

<div class="list-modul" style="display: none">
	<div class="modulesList">
	<?php foreach($modules as $modul) : 
		if(isset($service)) :
			$flag = false;
			foreach($listModules as $key => $m) :
				if($m['id'] == $modul->id) :
					$flag= true;
					break;
				endif;
			endforeach;
			if($flag) :
				continue;
			endif;
		endif;
	?>
		<div class="modul-name modul<?php echo $modul->id; ?>">
			<input type="checkbox" id="modul" class="modul"
			data-modulname='{"id": <?php echo $modul->id; ?>, "modul":"<?php echo $modul->name; ?>"}' />
			<?php echo $modul->name; ?>
		</div>
		<?php endforeach; ?>
	</div>
	<input type="hidden" name="position" id="position" value="" />
	<button class="addToService">Add Modul</button>
</div>
<script src="<?=base_url();?>js/service/show.js"></script>
<script src="<?=base_url();?>js/service/comment.js"></script>