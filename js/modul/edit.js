$(function() {
	$('#addDocument').live('click', addDocument);
	
	$('.remove-document').live('click', removeDocument);
	
	$('ul#navLeft li').live('click', loadService);
});

function addDocument() {
	var html = $('.documents').html();
	$('.list-document').append(html);
}

function removeDocument() {
	$(this).parent().remove();
}