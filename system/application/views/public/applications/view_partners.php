<table width="100%">
	<?php foreach($partners as $partner) : ?>
	<tr>
		<td class="partner-name" data-userid="<?php echo $partner->partner_id; ?>"><?php echo $partner->uName; ?></td>
		<td><?php echo $partner->status == 'selected'?'Selected':''; ?></td>
	</tr>
	<?php endforeach; ?>
</table>
