<div class="modul_details">
	<H3><?php echo $modul->name; ?>
	</H3>
	<div>
		<?php echo $modul->description; ?>
	</div>
	<?php if(empty($app)) : ?>
		
		<div class="documents-content">
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
	</div>
	</form>
	<br />
</div>
