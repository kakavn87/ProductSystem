<div class="modul_details">
	<H3>Keys</H3>
	<table width="100%">
		<tr>
		<?php
		$i = 0;
		foreach($listModulRequiment as $item) : 
			if($i > 0 && $i % 4 == 0) :
				echo '</tr><tr>';
			endif;
		?>
			<td><?php echo $item->name; ?></td>
		<?php $i++; endforeach; ?>
		</tr>
	</table>
	<H3>Your Profiles</H3>
	<table width="100%">
		<tr>
		<?php
		$i = 0;
		foreach($profiles as $profile) : 
			if($i > 0 && $i % 4 == 0) :
				echo '</tr><tr>';
			endif;
			$color = '';
			if(isset($profile->flag) && $profile->flag) :
				$color = 'style="color: green";';
			endif;
		?>
			<td <?php echo $color; ?>><?php echo $profile->name; ?></td>
		<?php $i++; endforeach; ?>
		</tr>
	</table>
</div>

