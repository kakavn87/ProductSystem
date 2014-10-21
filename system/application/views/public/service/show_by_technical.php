<?php if($showDetail): ?>
<script type="text/javascript">
var listModules = <?php echo !isset($listModules) ? '[]' : json_encode($listModules); ?>;
var listModuleForCustomers = <?php echo !isset($listModuleCustomers) ? '[]' : json_encode($listModuleCustomers); ?>;
var typePattern = '<?php echo $type; ?>';
var roleName = '<?php echo $user->roleName; ?>';
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/comment.css" media="screen, projection" />
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
					<?php foreach($reports as $report) :?>
					<div class="report-item">
						<input type="hidden" name="data[ReportDetail][id][]" value="<?php echo $report->rddId; ?>" />
						<em>+ <?php echo $report->rdName; ?></em>
						<input type="file" name="file[]" class="file" />
					</div>
					<?php endforeach; ?>
		          </select>
				</div>
				<input type="hidden" name="order_id" id="order_id" value="<?php echo $orderId?$orderId:''; ?>" />
				<input type="hidden" name="id" id="serviceid" value="<?php echo isset($service)?$service[0]->id:''; ?>" />
				<input type="button" value="Update Service" name="save"
					id="saveService" />
			</div>

	</form>
	<div class="clear"></div>
	<?php if(isset($comments)) : ?>
	<div class="comments">
		<h3>Comments</h3>
		<div>
			<textarea name="comment" id="comment-text" rows="8" cols="60"></textarea>
		</div>
		<button id="addComment">Add Comment</button>

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