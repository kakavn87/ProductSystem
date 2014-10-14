<div class="grey">
	<h1>
			<?php echo $title; ?>
		</h1>
	<div>
		<form method="post" action="<?php echo current_url(); ?>">
			<div id="left">
				<div class="bottomBox2" style="width: 100%; height: auto;">
					<h1>Edit modul</h1>
					
					<div class="info">
					<label class="user" for="modulname">Modul Name:</label> <input
						type="text" id="modulname" name="data[Modul][name]"
						value="<?php echo isset($modul)?$modul->name:''; ?>">
					</div>
					<div class="clear"></div>

					<div class="info">
					<label class="user" for="moduldescription">Description:</label>
					<textarea rows="4" class="moduldescription" cols="47"
						name="data[Modul][description]"><?php echo isset($modul)?$modul->description:''; ?></textarea>
					</div>
					<div class="clear"></div>
					
					<div class="info">
					<?php if($user->roleName = 'developer') : ?>
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

					<div class="save-as-normal">
						<input class="saveas-normal"
							type="checkbox" name="data[normal]" id="normal" /> Save as Modul Normal
					</div>
					
					<div class="resources">
						<div id="addDocument">+ Add Document</div>
						<div class="list-document">
						<?php foreach($documents as $document) : ?>
							<div class="item">
								<label class="user" for="link">Link:</label> <input type="text"
									id="link" name="data[Document][link][]"
									value="<?php echo $document->link; ?>">
								<div class="clear"></div>
	
								<label class="user" for="documentdescription">Description:</label>
								<textarea rows="4" class="documentdescription" cols="50"
									name="data[Document][description][]"><?php echo $document->description; ?></textarea>
								<div class="clear"></div>
	
								<label class="user" for="type">Type:</label> <select
									name="data[Document][type][]" id="type">
									<option
										<?php echo $document->type == 'PDF'?'selected="selected"':''; ?>
										value='PDF'>Pdf</option>
									<option
										<?php echo $document->type == 'VIDEO'?'selected="selected"':''; ?>
										value='VIDEO'>Video</option>
								</select>
								<div class="clear"></div>
	
								<img src="<?php echo base_url(); ?>css/images/deleteIcon.png"
									class="remove-document" />
								<div class="clear"></div>
							</div>
						<?php endforeach; ?>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="filter">
				<input type="hidden" name="data[Modul][id]" id="id"
					value="<?php echo isset($modul)?$modul->id:''; ?>" />
					
				<input type="hidden" name="data[old_type]"
					value="<?php echo isset($type)?$type:''; ?>" />
				<button type="submit" class="saveModul">Save Modul</button>
			</div>

		</form>
		<div class="clear"></div>
	</div>
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
<script type="text/javascript">
var type = '<?php echo isset($type)?$type:""; ?>';
</script>
<script src="<?=base_url();?>js/modul/edit.js"></script>