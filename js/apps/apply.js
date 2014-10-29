$(function() {
	$('.apply').live('click', function(e) {
		var appId = $(this).data('appid');
		var $this = $(this);
		$.ajax({
			url : BASE_URL + 'applications/apply',
			type : 'post',
			data : {'app_id': appId},
		}).done(function(data) {
			var obj = $.parseJSON(data);
			if(!obj.status) {
				$this.hide();
				$this.parent().find('.view').show();
				
				$.fancybox({
					content : obj.view,
				});
			} else {
				$.fancybox({
					content : obj.view,
				});
				alert(obj.message);
			}
		});
	});
	
	$('.view').live('click', function(e) {
		var appId = $(this).data('appid');
		var $this = $(this);
		$.ajax({
			url : BASE_URL + 'applications/view',
			type : 'post',
			data : {'app_id': appId},
		}).done(function(response) {
			$.fancybox({
				content : response,
			});
		});
	});
	
	$('.view-develop').live('click', function(e) {
		var appId = $(this).data('appid');
		var $this = $(this);
		if($this.hasClass('close')) {
			$this.parent('tr').next().hide();
			$this.removeClass('close');
		} else {
			$this.parent('tr').next().hide();
			$this.addClass('close');
			$.ajax({
				url : BASE_URL + 'applications/getPartnerApply',
				type : 'post',
				data : {'app_id': appId},
			}).done(function(response) {
				$this.parent('tr').next().show();
				$this.parent('tr').next().find('td').html(response);
			});
		}
	});
	
	$('.view-develop-done').live('click', function(e) {
		var appId = $(this).data('appid');
		var $this = $(this);
		if($this.hasClass('close')) {
			$this.parent('tr').next().hide();
			$this.removeClass('close');
		} else {
			$this.parent('tr').next().hide();
			$this.addClass('close');
			$.ajax({
				url : BASE_URL + 'applications/viewPartnerApply',
				type : 'post',
				data : {'app_id': appId},
			}).done(function(response) {
				$this.parent('tr').next().show();
				$this.parent('tr').next().find('td').html(response);
			});
		}
	});
	
	$('.partner-name').live('click', function(e) {
		var user_id = $(this).data('userid');
		var $this = $(this);
		
		$.ajax({
			url : BASE_URL + 'profiles/view_profile',
			type : 'post',
			data : {'user_id': user_id},
		}).done(function(response) {
			$.fancybox({
				content : response,
			});
		});
	});
	
	$('.partner-selected').live('click', function(e) {
		var appId = $(this).data('appid');
		var id = $(this).data('id');
		var $this = $(this);
		
		$.ajax({
			url : BASE_URL + 'applications/selected',
			type : 'post',
			data : {'app_id': appId, 'id': id},
		}).done(function(data) {
		});
	});
	
});
