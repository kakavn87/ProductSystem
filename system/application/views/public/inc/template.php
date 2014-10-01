<?php echo $header; ?>
<div id="wrapper">
	<div id="greyTop">
		<div id="innerWrapper">
			<div id="leftBox">
		      <?php $this->load->view('public/inc/sidebar');?>
		      
		      <?php 
		      if(isset($contentModule)) {
				echo $contentModule;
			 } ?>
		      <script src="<?=base_url();?>js/module.js"></script>
		      </div>
			<div id="rightBox">
				<div id="headTop">
					<h1>Product Service System</h1>
					<div class="logout">
						<a href="<?=base_url();?>login/logout">&raquo; Logout</a>
					</div>
					<div class="info-user">
					<?php 
						$user = $this->session->userdata ( 'user' );
						echo $user->name;  
						?>
					</div>
					<div class="clear"></div>
				</div>
				<div id="content">
				      <?php echo $content; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $footer; ?>
