<script type="text/javascript">
var listModules = <?php echo !isset($listModules) ? '[]' : json_encode($listModules); ?>;
var listModuleForCustomers = <?php echo !isset($listModuleCustomers) ? '[]' : json_encode($listModuleCustomers); ?>;
var typePattern = '<?php echo $type; ?>';
var roleName = '<?php echo $user->roleName; ?>';
var formDataModulDetail = {};
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/comment.css" media="screen, projection" />
<div class="grey">
	<form action="" method="post" enctype="multipart/form-data">
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
			<div class="contain-modul-detail"></div>
			<div class="filter">
			<br />
				<div id="tabs">
					 <ul>
						<li><a href="#tabs-1">Requirements</a></li>
						<li><a href="#tabs-2">Role</a></li>
						<li><a href="#tabs-3">Report documents</a></li>
						<li><a href="#tabs-4">Products</a></li>
						<li><a href="#tabs-5">Documents</a>
					</ul>
					<div id="tabs-1">
						<div class="info">
							<label>Description</label>
							<input type="text" name="data[description]" class="name-requirement" />
						</div>
						<div class="info">
							<button type="button" class="add-requirement">Add Requirement</button>
						</div>
						<table>
							<tr>
								<th>Description</th>
								<th></th>
								<th></th>
							</tr>
							<?php $value = ''; foreach($requirements as $re) :
								$selected = '';
								if(isset($service)) :
									if($service[0]->requirement_id == $re->id) :
										$selected="selected";
										$value = $re->id;
									endif;
								endif;
							?>
								<tr>
									<td class="edit edit-requirement" data-id="<?php echo $re->id; ?>"><?php echo $re->description; ?></td>
									<td class="delete delete-requirement" data-id="<?php echo $re->id; ?>">Delete</td>
									<td class="select select-requirement <?php echo $selected; ?>" data-id="<?php echo $re->id; ?>"><?php echo empty($selected)?'Select':''; ?></td>
								</tr>
							<?php endforeach; ?>
						</table>
						<input type="hidden" name="data[id]" class="id-requirement" />
			          	<input type="hidden" name="requirement_id" id="requirments" value="<?php echo $value; ?>" />
					</div>
					<div id="tabs-2">
						<label class="label">Role</label>
						<select id="roles" name="role_id" multiple
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
					<div id="tabs-3">
						<div class="info">
							<label>Name</label>
							<input type="text" name="data[name]" class="name-report" />
						</div>
		          		<div class="info">
							<label>Description</label>
							<textarea rows="5" name="data[description]" cols="58" class="desc-report"></textarea>
						</div>
						<div class="info">
							<button type="button" class="add-report">Add Report</button>
						</div>
						<table>
							<tr>
								<th>Name</th>
								<th></th>
								<th></th>
							</tr>
							<?php
							$value = array();
							foreach($report_documents as $report) :
								$selected = '';
								
								if(isset($service_report)) :
									foreach($service_report as $serviceReport) :
										if($serviceReport->report_id == $report->id) :
											$selected="selected";
											$value[] = $serviceReport->report_id;
											break;
										endif;
									endforeach;
								endif;
							?>
								<tr>
									<td class="edit edit-report" data-id="<?php echo $report->id; ?>" data-desc="<?php echo $report->description; ?>"><?php echo $report->name; ?></td>
									<?php if($report->user_id) :?>
									<td class="delete delete-report" data-id="<?php echo $report->id; ?>">Delete</td>
									<?php else : ?>
									<td></td>
									<?php endif; ?>
									<td class="select select-report <?php echo $selected; ?>" data-id="<?php echo $report->id; ?>"><?php echo empty($selected)?'Select':''; ?></td>
								</tr>
							<?php endforeach; ?>
						</table>
						<input type="hidden" name="data[id]" class="id-report" />
			          	<input type="hidden" name="report_id" id="report_id" value="<?php echo implode(',', $value); ?>" />
					</div>
					<div id="tabs-4">
						<div class="info">
							<label>Name</label>
							<input type="text" name="data[name]" class="name-product" />
						</div>
		          		<div class="info">
							<label>Description</label>
							<textarea rows="5" name="data[description]" cols="58" class="desc-product"></textarea>
						</div>
						<div class="info">
							<button type="button" class="add-product">Add Product</button>
						</div>
						<table>
							<tr>
								<th>Name</th>
								<th></th>
								<th></th>
							</tr>
							<?php $value = '';foreach($products as $product) :
								$selected = '';
								if(isset($service)) :
									if($service[0]->product_id == $product->id) :
										$selected="selected";
										$value = $product->id;
									endif;
								endif;
							?>
								<tr>
									<td class="edit edit-product" data-id="<?php echo $product->id; ?>" data-desc="<?php echo $product->description; ?>"><?php echo $product->name; ?></td>
									<td class="delete delete-product" data-id="<?php echo $product->id; ?>">Delete</td>
									<td class="select select-product <?php echo $selected; ?>" data-id="<?php echo $product->id; ?>"><?php echo empty($selected)?'Select':''; ?></td>
								</tr>
							<?php endforeach; ?>
						</table>
						<input type="hidden" name="data[id]" class="id-product" />
			          	<input type="hidden" name="product_id" id="products" value="<?php echo $value; ?>" />
					</div>
					<div id="tabs-5">
						<div class="documents-content-service">
							<h4>Documents: </h4>
							<div class="content">
								<?php if(!empty($documents)): ?>
									<?php foreach($documents as $doc)  : 
										if($doc->type == 'PDF') :
											$link = base_url() . $doc->link;
										else :
											$link = $doc->link;
										endif; 
									?>
										<div>- <a target="_blank" href="<?php echo $link; ?>"><?php echo $doc->link; ?></a></div>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
							<div id="addDocumentService">+ Add Document</div>
							<div class="list-document-service">
							</div>
						</div>
						<div class="documents-service">
							<div class="item">
								<label class="user" for="link">Link:</label> 
								<input type="text" class="link document-link"
									id="link" name="data[Document][link][]" value="" style="display: none">
								<input class="fileupload" type="file" name="files" id="fileuploadService0" >
								<div class="clear"></div>
						
								<label class="user" for="documentdescription">Description:</label>
								<textarea rows="4" class="document-description-service" cols="50"
									name="data[Document][description][]"></textarea>
								<div class="clear"></div>
						
								<label class="user" for="type">Type:</label> <select
									name="data[Document][type][]" class="type-service">
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
			<div class="comment-user"><div class="name-user"><?php echo $comment->name; ?></div><div class="comment-content"><?php echo $comment->comment; ?></div></div>
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
	<div class="toolbar-modul">
		<input type="checkbox" class="cbOutsourcing" /> OutSourcing
	</div>
	<div class="re-box" style="display: none"></div>
	<div class="requirement-container" style="display: none">
		<h3>Add Requirement</h3>
		<div class="info">
			<label>Name</label>
			<input type="text" name="data[ModulRequirement][name]" class="mr_name" value="" />
		</div>
		<div class="info">
			<label>Type</label>
			<select name="data[ModulRequirement][type]" class="mr_type">
				<option value="organization">Organization</option>
				<option value="modul">Modul</option>
				<option value="provider">Provider</option>
			</select>
		</div>
		<div class="info operator" style="display: none">
			<select name="data[ModulRequirement][operator]" class="mr_operator">
				<option value="=">=</option>
				<option value="<"><</option>
				<option value=">">></option>
				<option value=">=">>=</option>
				<option value="<="><=</option>
			</select>
			<input type="text" name="data[ModulRequirement][value]" class="mr_value" value="" />
		</div>
		<div class="info">
			<label>Description</label>
			<textarea name="data[ModulRequirement][description]" class="mr_desc"></textarea>
		</div>
		<button type="button" class="re-add">Add</button>
		<button type="button" class="re-cancel">Cancel</button>
	</div>
	<div class="modul-outsourcing"  style="display: none">
		<form class="create-modul-outsourcing">
		<h3>Add Module</h3>
		<input type="hidden" name="data[Modul][id]" id="id" value="" />
		<input type="hidden" name="data[old_type]" value="" />
		<input type="hidden" name="data[normal]" value="normal" />
		<button class="save-modul-outsourcing" type="button">Save Modul</button>
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
				<span class="add-requirement">+ Add Requirement</span>
				<table width="100%" class="tbl-requirement">
					<tr class="first">
						<th>Name</th>
						<th>TYPE</th>
						<th>Organization</th>
						<th></th>
					</tr>
				</table>
			</div>
		</div>
		</form>
	</div>
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
<div class="report-document" style="display: none">
	<form class="report-form">
	<div class="report-content">
		<h3>Add Report Document: </h3>
		<div class="info">
			<label>Name:</label>
			<input type="text" name="data[Report][name]" id="reportName" />
		</div>
		<div class="info">
			<label>Description:</label>
			<textarea rows="5" name="data[Report][description]" cols="58" id="reportDescription"></textarea>
		</div>
		<button class="add-report">Add Report</button>
	</div>
	</form>
</div>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?=base_url();?>js/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?=base_url();?>js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?=base_url();?>js/jquery.fileupload.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script src="<?=base_url();?>js/service/show.js"></script>
<script src="<?=base_url();?>js/service/action_requirement.js"></script>
<script src="<?=base_url();?>js/service/action_product.js"></script>
<script src="<?=base_url();?>js/service/action_report.js"></script>
<script src="<?=base_url();?>js/service/comment.js"></script>