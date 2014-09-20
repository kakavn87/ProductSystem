<ul id="navTop">
<?php $navstate = 'service'; ?>
<img src="<?=base_url();?>css/images/logo_small.jpg" alt="Revierkönig" />
<li <?php if ($navstate == 'service') { echo 'class="active"'; }?>><a href="<?=base_url();?>service/show">Service</a></li>
  <li <?php if ($navstate == 'attendant') { echo 'class="active"'; }?>><a href="<?=base_url();?>attendant/show">Module</a></li>
  <li <?php if ($navstate == 'product') { echo 'class="active"'; }?>><a href="<?=base_url();?>product/show">Order</a></li>
  <li <?php if ($navstate == 'branch') { echo 'class="active"'; }?>><a href="<?=base_url();?>branch/show">Requirement</a></li>
  <li <?php if ($navstate == 'group') { echo 'class="active"'; }?>><a href="<?=base_url();?>group/show">Product</a></li>
  <li <?php if ($navstate == 'search') { echo 'class="active"'; }?>><a href="<?=base_url();?>search/show">Organisation</a></li>
  <div class="clear"></div>
</ul>
