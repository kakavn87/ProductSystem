<div class="modul_details">
	<H3><?php echo $modul->name; ?>
	<?php if(empty($app)) : ?>
	<div class="outsourcing"><input type="checkbox" id="cbOutsourcing" />Outsourcing</div>
	<?php endif; ?>
	</H3>
	<div>
		<?php echo $modul->description; ?>
	</div>
	<?php if(empty($app)) : ?>
		
		<div class="documents-content">
			<h4>Documents: </h4>
			<?php if(!empty($documents)): ?>
				<?php foreach($documents as $doc)  : ?>
					<div>- <a target="_blank" href="<?php echo $doc->link; ?>"><?php echo $doc->link; ?></a></div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		
		<form id="documentForm" method="post" enctype="multipart/form-data">
		<div id="addDocumentModul">+ Add Document</div>
		<div class="list-document-modul-detail">
		</div>
		<button type="button" class="update-modul-detail" data-modultype="<?php echo $modul_type; ?>" data-id="<?php echo $modul->id; ?>">Update</button>
		</form>
		<div class="documents-modul-detail">
			<div class="item">
				<label class="user" for="link">Link:</label> 
				<input type="text" class="link"
					id="link" name="data[Document][link][]" value="">
				<input class="fileupload" type="file" name="files" style="display: none">
				<div class="clear"></div>
		
				<label class="user" for="documentdescription">Description:</label>
				<textarea rows="4" class="documentdescription" cols="50"
					name="data[Document][description][]"></textarea>
				<div class="clear"></div>
		
				<label class="user" for="type">Type:</label> <select
					name="data[Document][type][]" class="type-modul-detail">
					<option value='PDF'>Pdf</option>
					<option value='VIDEO'>Video</option>
				</select>
				<div class="clear"></div>
		
				<img src="<?php echo base_url(); ?>css/images/deleteIcon.png"
					class="remove-document" />
				<div class="clear"></div>
			</div>
		</div>
	<?php endif; ?>

	<form id="outsourceForm">
	<input type="hidden" name="modulId" value="<?php echo $modul->id; ?>" />
	<div class="outsourcing-content" style="<?php echo empty($app)?'display: none':''; ?>">
		<label class="title">Requirement: </label>
		<table width="100%" class="tbl-requirement-detail">
			<tr class="first">
				<th>Name</th>
				<th>TYPE</th>
				<th>Organization</th>
				<th></th>
			</tr>
			<?php foreach($app as $key => $item) :
				$name = $item->name;
				if($item->type == 'modul') :
					$name = $item->name . ' ' . $item->operator . ' ' . $item->value;
				endif;
			?>
				<tr class="tr-second">
					<td><?php echo $name; ?></td>
					<td><?php echo $item->type; ?></td>
					<td><?php echo $item->organization; ?></td>
					<td class="td-remove-detail" data-id="<?php echo $item->id; ?>">Delete</td>
				</tr>
			<?php endforeach; ?>
		</table>
		<div class="info-container">
			<div class="info-input">
				<div>
					<label>Name</label>
					<input type="text" name="data[ModulRequirement][name]" class="mr_name2"/>
				</div>
				<div class="info">
					<label>Type</label>
					<select name="data[ModulRequirement][type]" class="mr_type2">
						<option value="organization">Organization</option>
						<option value="modul">Modul</option>
						<option value="provider">Provider</option>
					</select>
				</div>
				<div class="info operator2" style="display: none">
					<select name="data[ModulRequirement][operator]" class="mr_operator2">
						<option value="=">=</option>
						<option value="<"><</option>
						<option value=">">></option>
						<option value=">=">>=</option>
						<option value="<="><=</option>
					</select>
					<input type="text" name="data[ModulRequirement][value]" class="mr_value2" value="" />
				</div>
				<div class="info">
					<label>Description</label>
					<textarea name="data[ModulRequirement][organization]" class="mr_desc2"></textarea>
				</div>
			</div>
		</div>
		<div>
			<button type="button" class="update-outsource">Update</button>
		</div>
	</div>
	</form>
	<br />
	<br />
</div>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?=base_url();?>js/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?=base_url();?>js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?=base_url();?>js/jquery.fileupload.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>js/service/show_modul_detail.js"></script>
