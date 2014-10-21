<?php if($showDetail): ?>
<script type="text/javascript">
var listModules = <?php echo !isset($listModules) ? '[]' : json_encode($listModules); ?>;
var listModuleForCustomers = <?php echo !isset($listModuleCustomers) ? '[]' : json_encode($listModuleCustomers); ?>;
var typePattern = '<?php echo $type; ?>';
var roleName = '<?php echo $user->roleName; ?>';
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/comment.css" media="screen, projection" />
<!-- Bootstrap styles -->
<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> -->
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="<?=base_url();?>css/jquery.fileupload.css">
<div class="grey">
	<form action="" method="post" enctype="multipart/form-data">
		<h1>
			Service name: <span><?php echo $serviceInfo->name; ?></span>
		</h1>
		<div id="left">
				<div class="bottomBox2" style="width: 100%; height: auto; ">
					<h1>DL</h1>
					<div class="clear"></div>

					<div class="modulList" id="sortableDev" ></div>
					<div class="clear"></div>
					<div class="modulList second" id="sortableCus" ></div>
				</div>
				<div class="clear"></div>

			</div>
			<div class="filter">
				<div>
					<label>Requirement</label>: <em><?php echo $serviceInfo->rDescription; ?></em>
				</div>
				<div>
					<label>Role</label>: <em><?php echo $serviceInfo->roleName; ?></em>
				</div>
				<div>
					<label>Products</label>: <em><?php echo $serviceInfo->pName; ?></em>
				</div>
				<div>
					<label>Report documents</label>:
					<?php $i = 1; foreach($reports as $report) :?>
					<div class="report-item">
						<input type="hidden" name="data[ReportDetail][id][]" value="<?php echo $report->rddId; ?>" />
						<em>+ <?php echo $report->rdName; ?></em>
						<?php if($serviceInfo->status != 'DONE') : ?>
						<!-- The fileinput-button span is used to style the file input field as button -->
					    <span class="btn btn-success fileinput-button">
					        <i class="glyphicon glyphicon-plus"></i>
					        <span>Select files...</span>
					        <!-- The file input field used as target for the file upload widget -->
					        <input class="fileupload" data-id="<?php echo $report->rddId; ?>" data-index="<?php echo $i; ?>" id="fileupload<?php echo $i++;?>" type="file" name="files">
					    </span>
					    <?php endif; ?>
					    <span class="files">
					    <?php if($serviceInfo->status == 'DONE') : ?>
					    	<a href="<?php echo $report->rddUrl; ?>" target="_blank">Download</a>
					    <?php endif; ?>
					    </span>
					</div>
					<?php endforeach; ?>
				</div>
				<?php if($serviceInfo->status != 'DONE') : ?>
				<input type="hidden" name="order_id" id="order_id" value="<?php echo $orderId?$orderId:''; ?>" />
				<input type="hidden" name="id" id="serviceid" value="<?php echo isset($service)?$service[0]->id:''; ?>" />
				<input type="button" value="Update Service" name="save"
					id="saveService" />
				<?php endif; ?>
			</div>

	</form>
	<div class="clear"></div>
	<?php if(isset($comments)) : ?>
	<div class="comments">
		<h3>Comments</h3>
		<?php if($serviceInfo->status != 'DONE') : ?>
		<div>
			<textarea name="comment" id="comment-text" rows="8" cols="60"></textarea>
		</div>
		<button id="addComment">Add Comment</button>
		<?php endif; ?>
		<div class="comments-list">
		<?php
			foreach($comments as $comment) : ?>
			<div class="list">
			<div class="avatar"><img src="<?php echo base_url(); ?>css/images/avatar.png" /></div>
			<div class="comment-user"><div class="name-user"><?php echo $comment->name; ?></div><div class="comment-content"><?php echo $comment->comment; ?></div></div>
			</div><div class="clear"></div>
		<?php
			endforeach;
		?>
		</div>
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>
<script src="<?=base_url();?>js/service/show_by_technical.js"></script>
<script src="<?=base_url();?>js/service/comment.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?=base_url();?>js/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?=base_url();?>js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?=base_url();?>js/jquery.fileupload.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>