$(function() {
	$('.apply').live('click', function(e) {
		var appId = $(this).data('appId');
		
		$.ajax({
			url : BASE_URL + 'applications/apply',
			type : 'post',
			data : {'app_id': appId},
		}).done(function(data) {
			console.log(data);return false;
			var obj = $.parseJSON(data);
			if(!obj.status) {
				// TODO abc
			} else {
				showDialog('Error', obj.message);
			}
		});
	});
});
