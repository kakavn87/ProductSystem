<div class="searchbox">
	<span>Search: </span> <input type="text" class="searchword"
		id="searchword" value="" />
</div>

<div id="scroller" class="scrollerNav">
	<ul id="navLeft">
           <?php foreach ($services as $service) :?>
              <li
			data-href="<?php echo base_url(); ?>service/show/Normal/<?php echo $service->id; ?>/<?php echo $service->order_id; ?>"><p><?= $service->name; ?></p>
			<span class="navArrow"></span>
			<div class="clear"></div></li>
           <?php endforeach; ?>
          </ul>
</div>
