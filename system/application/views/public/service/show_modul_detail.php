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
		<?php if(!empty($documents)): ?>
		<div class="documents-content">
			<h4>Documents: </h4>
			<?php foreach($documents as $doc)  : ?>
				<div>- <a target="_blank" href="<?php echo $doc->link; ?>"><?php echo $doc->link; ?></a></div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
		<form id="outsourceForm">
		<input type="hidden" name="modulId" value="<?php echo $modul->id; ?>" />
		<div class="outsourcing-content" style="display: none">
			<div class="info-container">
				<div class="info-input">
					<div>
						<label>Name</label>
						<input type="text" name="name[]" />
					</div>
					<div>
						<label>Organization</label>
						<input type="text" name="organization[]" />
					</div>
				</div>
			</div>
			<div>
				<a href="javascript:void(0)" class="add-more">+ Add more</a>
			</div>
			<div>
				<button type="button" class="update-outsource">Update</button>
			</div>
		</div>
		</form>
	<?php else: ?>
	<label class="title">Requirement: </label>
	<table width="100%" class="tbl-requirement-detail">
		<tr class="first">
			<th>Name</th>
			<th>TYPE</th>
			<th>Organization</th>
		</tr>
		<?php foreach($app as $key => $item) : ?>
			<tr>
				<td><?php echo $item->name; ?></td>
				<td><?php echo $item->type; ?></td>
				<td><?php echo $item->organization; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<br />
	<br />
</div>
<script src="<?=base_url();?>js/service/show_modul_detail.js"></script>

