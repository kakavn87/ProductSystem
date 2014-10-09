$(function() {
	$('.containerBox').live('click', function(e) {
		location.href = $(this).data('href');
	});
});