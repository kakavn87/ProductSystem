<div class="modul_details">
	<H3><?php echo $modul->name; ?></H3>
	<div>
		<h4>Documents: </h4>
		<?php foreach($documents as $doc)  : ?>
			<div>- <a target="_blank" href="<?php echo $doc->link; ?>"><?php echo $doc->link; ?></a></div>
		<?php endforeach; ?>
	</div>
</div>