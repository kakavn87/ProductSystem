<div class="addButtonTop" style="border:0">
	<a href="<?php echo base_url(); ?>moduls/add/"><span class="greenFont">+</span>
		Add new modul</a>
</div>
<div class="searchbox">
	<span>Search: </span>  <input type="text" class="searchword" id="searchword" value="" />
</div>
<div class="showButtonModul">
	<div class="normal active">Normal</div>
	<div class="standard">Standard</div>
</div>
<div id="scroller" class="scrollerNav">
          <ul id="navLeft">
          
           <?php foreach ($modules as $module) :?>
              <li class="normal" data-href="<?php echo base_url(); ?>moduls/edit/<?php echo $module->id; ?>"><p><?= $module->name; ?></p>
								<span class="navArrow"></span>
								<div class="clear"></div></li>
           <?php endforeach; ?>
           
           <?php foreach ($modul_standards as $module) :?>
              <li class="standard hide"  data-href="<?php echo base_url(); ?>moduls/edit/<?php echo $module->id; ?>"><p><?= $module->name; ?></p>
								<span class="navArrow"></span>
								<div class="clear"></div></li>
           <?php endforeach; ?>
          </ul>
</div>
