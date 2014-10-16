<div class="addButtonTop" style="border:0">
	<a href="<?php echo base_url(); ?>moduls/add/"><span class="greenFont">+</span>
		Add new modul</a>
</div>
<div class="searchbox">
	<span>Search: </span>  <input type="text" class="searchword" id="searchword" value="" />
</div>
<div class="showButtonModul">
	<div class="standard active" <?php echo (!$show_normal)?'style="width:100%"' :''; ?>>Standard</div>
	<?php if($show_normal) : ?>
	<div class="normal">Normal</div>
	<?php endif; ?>
</div>
<div id="scroller" class="scrollerNav">
          <ul id="navLeft">
          
           <?php foreach ($modul_standards as $module) :?>
              <li class="standard"  data-href="<?php echo base_url(); ?>moduls/edit/<?php echo $module->id; ?>/standard"><p><?= $module->name; ?></p>
								<span class="navArrow"></span>
								<div class="clear"></div></li>
           <?php endforeach; ?>
           <?php if($show_normal) : ?>
	           <?php foreach ($modules as $module) :?>
	              <li class="normal hide" data-href="<?php echo base_url(); ?>moduls/edit/<?php echo $module->id; ?>/normal"><p><?= $module->name; ?></p>
									<span class="navArrow"></span>
									<div class="clear"></div></li>
	           <?php endforeach; ?>
	        <?php endif; ?>
          </ul>
         
</div>
