$(function() {
	$('ul#navLeft li').live('click', loadService);
});

function loadService() {
	location.href = $(this).data('href');
}