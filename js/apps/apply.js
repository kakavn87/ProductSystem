$(function() {
	$('.apply').live('click', function(e) {
		var appId = $(this).data('appid');
		$.ajax({
			url : BASE_URL + 'applications/apply',
			type : 'post',
			data : {'app_id': appId},
		}).done(function(data) {
			var obj = $.parseJSON(data);
			if(!obj.status) {
				$(this).hide();
				$('.view').show();
			} else {
				showDialog('Error', obj.message);
			}
		});
	});
});
