<div class="container">
	<div class="clearfix">
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<h1 id="navbar">Project Service System</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Panel primary</h3>
					</div>
					<div class="panel-body">Panel content</div>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Panel primary</h3>
					</div>
					<div class="panel-body">
					<select id="roles" data-placeholder="Choose a role ..." style="width:350px;" class="chosen-select">
            <option value=""></option>
            <?php foreach($roles as $role) : ?>
            	<option value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
            <?php endforeach;?>
          </select>
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?=base_url();?>js/service/show.js"></script>