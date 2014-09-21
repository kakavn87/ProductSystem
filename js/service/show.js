var listModules = [];
$(function() {
	
	$("#products, #roles").chosen();

	$('.addButtonTop a').live('click', addService);

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
	
	$('.saveService').live('click', saveService);

	doService({
		allowEdit: true
	});
});

function addService() {
	
}

function saveService() {
	var formData = {};
	formData.name = $('#name').val();
	formData.modul = [];
	$.each(listModules, function(index, value) {
		formData.modul.push(value.id);
	});
	
	$.ajax({
		url : BASE_URL + 'service/save',
		type: 'post',
		data : formData,
		beforeSend : function(xhr) {

		}
	}).done(function(data) {
		console.log(data);
	});
}

function doService(params) {
	var modulList = $('.modulList');
	
	$('.addToService').live('click', addToService);
	
	if(params.allowEdit) {
		$('.closeBox img').live('click', function() {
			var removeItem = $(this).data('modulid');
			listModules = jQuery.grep(listModules, function(value) {
			  return value.id != removeItem;
			});
			// re-draw
			draw();
			
			var $input = createInput($(this).data('modulid'), $(this).data('modulname'));
			
			$('.modulesNav').append($input);
		});
	}
	
	function addToService() {
		$('.modul:checked').each(function() {
			listModules.push($(this).data('modulname'));
			$(this).parent().remove();
		});
		
		draw();
		return false;
	}
	
	function draw() {
		modulList.html('');
		$.each(listModules, function(index, value) {
			var containerBox = createBox(value);
			modulList.append(containerBox);
			if(index + 1 < listModules.length) {
				modulList.append(createArrow());
			}
		});
		
	}
	
	function createInput(id, modul) {
		var html = '<div class="modul-name">';
		html += '<input type="checkbox" id="modul" class="modul" data-modulname=\'{"id": ' + id + ', "modul":"' + modul + '"}\' /> ';
		html += modul;
		html += '</div>';
		return html;
	}
	
	function createBox(value) {
		var html = '<div class="containerBox"><div class="closeBox"><img data-modulname="' + value.modul + '" data-modulid="' + value.id + '" src="' + BASE_URL + 'css/images/deleteIcon.png" /></div>' + value.modul + '</div>';
		return html;
	}
	
	function createArrow() {
		var html = '<div class="arrowBox">';
		html += '<img class="arrow" src="' + BASE_URL + 'css/images/arrow32x32.png" />';
		html += '</div>';
		return html;
	}
	return false;
}
