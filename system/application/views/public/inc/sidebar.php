<ul id="navTop">
<?php $navstate = $this->uri->segment(1); ?>
<img src="<?=base_url();?>css/images/logo_small.jpg" alt="Revierkönig" />
<li <?php if ($navstate == 'service') { echo 'class="active"'; }?>><a href="<?=base_url();?>service/show">Service</a></li>
  <li <?php if ($navstate == 'moduls') { echo 'class="active"'; }?>><a href="<?=base_url();?>moduls/overview">Module</a></li>
  <li <?php if ($navstate == 'orders') { echo 'class="active"'; }?>><a href="<?=base_url();?>orders/lists">Order</a></li>
  <li <?php if ($navstate == 'branch') { echo 'class="active"'; }?>><a href="<?=base_url();?>branch/show">Requirement</a></li>
  <li <?php if ($navstate == 'group') { echo 'class="active"'; }?>><a href="<?=base_url();?>group/show">Product</a></li>
  <li <?php if ($navstate == 'search') { echo 'class="active"'; }?>><a href="<?=base_url();?>search/show">Organisation</a></li>
  <div class="clear"></div>
</ul>
