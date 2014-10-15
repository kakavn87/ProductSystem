<script type="text/javascript">
var listModules = <?php echo !isset($listModules) ? '[]' : json_encode($listModules); ?>;
var listModuleForCustomers = <?php echo !isset($listModuleCustomers) ? '[]' : json_encode($listModuleCustomers); ?>;
var typePattern = '<?php echo $type; ?>';
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/comment.css" media="screen, projection" />
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
					<a class="service-standard" href="javascript:void(0)" data-href="<?php echo base_url(); ?>service/get_standard/<?php echo $standard->id; ?>">
					<?php echo $standard->name; ?>
					</a>
				</div>
				<?php endforeach; ?>
				</div>
			</div>
				<div class="bottomBox2">
					<h1>DL</h1>
					<div class="clear"></div>

					<div class="modulList" id="sortableDev" ></div>
					<div class="clear"></div>
					<div class="modulList second" id="sortableCus" ></div>
				</div>
				<div class="clear"></div>

			</div>
			<div class="filter">
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
			            if(isset($service_role)) :
			            	foreach($service_role as $serviceRole) :
				            	if($serviceRole->role_id == $role->id) :
				            		$selected="selected='selected'";
			            			break;
				            	endif;
			            	endforeach;
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
					<input type="checkbox" name="standard" id="standard" value="1" /> Save as Service Standard
				</div>
				<input type="hidden" name="order_id" id="order_id" value="<?php echo $orderId?$orderId:''; ?>" />
				<input type="hidden" name="id" id="serviceid" value="<?php echo isset($service)?$service[0]->id:''; ?>" />
				<input type="button" value="Save Service" name="save"
					id="saveService" />
			</div>

	</form>
	<div class="clear"></div>
	<?php if(isset($comments)) : ?>
	<div class="comments">
		<h3>Comments</h3>
		<div>
			<textarea name="comment" id="comment-text" rows="8" cols="60"></textarea>
		</div>
		<button id="addComment">Add Comment</button>

		<div class="comments-list">
		<?php
			foreach($comments as $comment) : ?>
			<div class="list">
			<div class="avatar"><img src="<?php echo base_url(); ?>css/images/avatar.png" /></div>
			<div class="comment-user"><?php echo $comment->comment; ?></div>
			</div><div class="clear"></div>
		<?php
			endforeach;
		?>
		</div>
	</div>
	<?php endif; ?>
</div>

<div class="list-modul" style="display: none">
	<div class="modulLeft">
		<h3>Standard</h3>
		<div class="searchbox" style="padding: 4px">
			<span>Search: </span> <input type="text" class="search-modul-standard"
				id="search-modul-standard" value="" />
		</div>
		<div id="scroller" class="scrollerNav">
		<?php foreach($modul_standards as $modul):
		$data = array(
				'id' => $modul->id,
				'modul' => $modul->name,
				'type' => 'standard',
				'color' => $modul->color
		);
		?>
			<div class="modul-standard-name modul<?php echo $modul->id; ?>">
				<input type="checkbox" id="modul" class="modul"
				data-modulname='<?php echo json_encode($data); ?>' />
				<?php echo $modul->name; ?>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
	<div class="modulRight">
		<h3>Normal</h3>
		<div class="searchbox" style="padding: 4px">
			<span>Search: </span> <input type="text" class="search-modul-normal"
				id="search-modul-normal" value="" />
				<button class="add-module">+ Modul</button>
		</div>
		<div id="scroller" class="scrollerNav">

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
				$data = array(
						'id' => $modul->id,
						'modul' => $modul->name,
						'type' => 'normal',
						'color' => $modul->color
				);
			?>
			<div class="modulesList">
				<div class="modul-normal-name modul<?php echo $modul->id; ?>">
					<input type="checkbox" id="modul" class="modul"
					data-modulname='<?php echo json_encode($data); ?>' />
					<?php echo $modul->name; ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	<input type="hidden" name="position" id="position" class="position" value="" />
	<input type="hidden" name="number" id="number" value="" />
	</div>

	<button class="addToService">Add To Service</button>
</div>
<div class="modul-normal-list" style="display: none">
	<div class="modul-normal-container">
		<form class="create-modul">
		<h3>Add Normal Module</h3>
		<input type="hidden" name="data[Modul][id]" id="id" value="" />
		<input type="hidden" name="data[old_type]" value="" />
		<input type="hidden" name="data[normal]" value="normal" />
		<button class="save-modul" type="button">Save Modul</button>
		<div class="info">
			<div class="info">
			<label class="user" for="modulname">Modul Name:</label> <input
				type="text" id="modulname" name="data[Modul][name]"
				value="">
			</div>
			<div class="clear"></div>

			<div class="info">
			<label class="user" for="moduldescription">Description:</label>
			<textarea rows="4" class="moduldescription" cols="47"
				name="data[Modul][description]"></textarea>
			</div>
			<div class="clear"></div>

			<div class="info">
			<?php
			$user = $this->session->userdata ( 'user' );
			if($user->roleName = 'developer') : ?>
				<label class="user" for="moduletype" >Type:</label>
				<select class="chosen-select" id="selectType" name="data[Modul][type]">
					<option value="main">Main</option>
					<option value="sub">Sub</option>
					<option value="support">Support</option>
					<option value="child">Child</option>
				</select>
			<?php endif; ?>
			</div>
			<div class="clear"></div>
			
			<div id="addDocument">+ Add Document</div>
			<div class="list-document">
			</div>
		</div>
		</form>
	</div>
	<div class="documents">
	<div class="item">
		<label class="user" for="link">Link:</label> <input type="text"
			id="link" name="data[Document][link][]" value="">
		<div class="clear"></div>

		<label class="user" for="documentdescription">Description:</label>
		<textarea rows="4" class="documentdescription" cols="50"
			name="data[Document][description][]"></textarea>
		<div class="clear"></div>

		<label class="user" for="type">Type:</label> <select
			name="data[Document][type][]" id="type">
			<option value='PDF'>Pdf</option>
			<option value='VIDEO'>Video</option>
		</select>
		<div class="clear"></div>

		<img src="<?php echo base_url(); ?>css/images/deleteIcon.png"
			class="remove-document" />
		<div class="clear"></div>
	</div>
</div>
</div>

<script src="<?=base_url();?>js/service/show.js"></script>
<script src="<?=base_url();?>js/service/comment.js"></script>