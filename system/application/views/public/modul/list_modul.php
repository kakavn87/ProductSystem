<div class="searchbox">
	<span>Search: </span>  <input type="text" class="searchword" id="searchword" value="" />
</div>

<div class="addButtonTop">
							<a href="<?php echo base_url(); ?>moduls/add/"><span class="greenFont">+</span>
								Add new modul</a>
						</div>
<div id="scroller" class="scrollerNav">
          <ul id="navLeft">
          
           <?php foreach ($modules as $module) :?>
              <li data-href="<?php echo base_url(); ?>moduls/edit/<?php echo $module->id; ?>"><p><?= $module->name; ?></p>
								<span class="navArrow"></span>
								<div class="clear"></div></li>
           <?php endforeach; ?>
          </ul>

					</div>
