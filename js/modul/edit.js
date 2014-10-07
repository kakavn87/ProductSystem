$(function() {
	$('#addDocument').live('click', addDocument);
	
	$('.remove-document').live('click', removeDocument);
	
	$('ul#navLeft li').live('click', loadService);
	
	$('#searchmodul').search('.modul-name', function(on) {

		on.all(function(results) {
			var size = results ? results.size() : 0
		});

		on.reset(function() {
			$('.modul-name').show();
		});

		on.empty(function() {
			$('.modul-name').hide();
		});

		on.results(function(results) {
			$('.modul-name').hide();
			results.show();
		});
	});
});

function addDocument() {
	var html = $('.documents').html();
	$('.list-document').append(html);
}

function removeDocument() {
	$(this).parent().remove();
}