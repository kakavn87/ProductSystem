function showDialog(status, message) {
	$.fancybox({
		title : status,
		content : message
	});
}

$(function(){
	$('.info-user').live('click', function(e) {
		var user_id = $(this).data('id');
		
		$.ajax({
			url : BASE_URL + 'users/profile/' + user_id,
		}).done(function(html) {
			$.fancybox({
				content : html,
			});
		});
	});
});

