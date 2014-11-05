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
			$name = $item->name;
			if($item->type == 'modul') :
				$name = $name . ' ' . $item->operator . ' '. $item->value;
			endif;
		?>
			<td><?php echo $name; ?></td>
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
			$color = 'style="color: red";';
			if(isset($profile->flag) && $profile->flag) :
				$color = 'style="color: green";';
			endif;

			$name = $profile->name;
			if($profile->operator) :
				$name = $name . ' ' . $profile->operator . ' '. $profile->value;
			endif;
		?>
			<td <?php echo $color; ?>><?php echo $name; ?></td>
		<?php $i++; endforeach; ?>
		</tr>
	</table>
</div>

