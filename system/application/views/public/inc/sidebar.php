<?php 
$CI =& get_instance();
$CI->load->library('roleComponent');
$roleComponent = new RoleComponent();
$sidebars = $roleComponent->getSidebars();
?>
<ul id="navTop">
<?php $navstate = $this->uri->segment(1); ?>
<img src="<?=base_url();?>css/images/logo_small.jpg" alt="Revierkönig" />
	<?php foreach($sidebars as $sidebar): ?>
  <li <?php if ($navstate == $sidebar['id']) { echo 'class="active"'; }?>><a href="<?=base_url() . $sidebar['url'];?>"><?php echo $sidebar['name']; ?></a></li>
  <?php endforeach; ?>
  <div class="clear"></div>
</ul>
