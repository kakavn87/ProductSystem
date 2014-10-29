<table width="100%">
	<?php foreach($partners as $partner) : ?>
	<tr>
		<td class="partner-name" data-userid="<?php echo $partner->partner_id; ?>"><?php echo $partner->uName; ?></td>
		<td class="partner-selected" data-appid="<?php echo $partner->app_id; ?>" data-id="<?php echo $partner->id; ?>">Selected</td>
	</tr>
	<?php endforeach; ?>
</table>
