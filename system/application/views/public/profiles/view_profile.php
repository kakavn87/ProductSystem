<div class="modul_details">
	<H3>Profiles</H3>
	<table width="100%">
		<tr>
		<?php
		$i = 0;
		foreach($profiles as $profile) : 
			if($i > 0 && $i % 4 == 0) :
				echo '</tr><tr>';
			endif;
		?>
			<td><?php echo $profile->name; ?></td>
		<?php $i++; endforeach; ?>
		</tr>
	</table>
</div>

