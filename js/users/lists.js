$(function() {
	$('.add-user').live('click', function(e) {
		location.href = $(this).data('href');
	});
});
