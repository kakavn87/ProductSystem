$(function() {
	
	$("#products, #roles, #orders, #requirments").chosen();
	
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

function saveService() {
	var formData = {};
	formData.id = $('#serviceid').val();
	formData.name = $('#name').val();
	formData.modul = [];
	$.each(listModules, function(index, value) {
		formData.modul.push(value.id);
	});
	formData.order_id = $("#orders").val();
	formData.requirement_id = $('#requirments').val();
	formData.role_id = $('#roles').val();
	formData.product_id = $('#products').val();
	
	if(!formData.name.trim().length) {
		showDialog('Error', 'Please enter service name');
		return false;
	}
	
	if(!formData.modul.length) {
		showDialog('Error', 'Please add a modul');
		return false;
	}
	
	if(!parseInt(formData.order_id)) {
		showDialog('Error', 'Please select an order');
		return false;
	}
	
	if(!parseInt(formData.requirement_id)) {
		showDialog('Error', 'Please select a requirement');
		return false;
	}
	
	if(!parseInt(formData.role_id)) {
		showDialog('Error', 'Please select a role');
		return false;
	}
	
	if(!parseInt(formData.product_id)) {
		showDialog('Error', 'Please select a product');
		return false;
	}
	
	$.ajax({
		url : BASE_URL + 'service/save',
		type: 'post',
		data : formData,
		beforeSend : function(xhr) {

		}
	}).done(function(data) {
		showDialog("Success", 'Create new service successful');
		var obj = $.parseJSON(data);
		if(!parseInt($('#serviceid').val())) {
			$('#serviceid').val(obj.serviceId);
			
			var html = '<li data-href="' + BASE_URL + 'service/show/' + obj.serviceId + '"><p>' + formData.name + '</p>';
			html += '<span class="navArrow"></span>';
			html += '<div class="clear"></div></li>';
			$('ul#navLeft').prepend(html);
		}
	});
}

function doService(params) {
	var modulList = $('.modulList');
	
	$('.addToService').live('click', addToService);
	
	$('ul#navLeft li').live('click', loadService);
	
	$('.containerBox').live('click', openModulDetail);
	
	draw();
	
	$( "#sortable" ).sortable({
		start : function() {
			$('.containerBox').css('margin-right', '5px');
			$('.arrowBox').hide();
		},
		update: function(event, ui) {
			var data = $("#sortable").sortable('toArray');
			listModules = [];
			$.each(data, function (i, val){
				if(val) {
					var json = JSON.stringify(eval("(" + val + ")"));
					listModules.push($.parseJSON(json));
				}
			});
		},
		stop: function() {
			draw();
		}
	});
    $( "#sortable" ).disableSelection();
	
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
	
	function openModulDetail(e) {
		if( e.target == this ) {
			var modulId = $(this).data('modulid');
			
			$.ajax({
				url : BASE_URL + 'service/show_modul_detail',
				type: 'post',
				data : {modul_id: modulId},
			}).done(function(data) {
				$.fancybox({
					content : data
				});
			});
		}
	}
	
	function createInput(id, modul) {
		var html = '<div class="modul-name">';
		html += '<input type="checkbox" id="modul" class="modul" data-modulname=\'{"id": ' + id + ', "modul":"' + modul + '"}\' /> ';
		html += modul;
		html += '</div>';
		return html;
	}
	
	function createBox(value) {
		var html = '<div class="containerBox ui-state-default" id=\'{"id": ' + value.id + ', "modul":"' + value.modul + '"}\' data-modulid="' + value.id + '"><div class="closeBox"><img data-modulname="' + value.modul + '" data-modulid="' + value.id + '" src="' + BASE_URL + 'css/images/deleteIcon.png" /></div>' + value.modul + '</div>';
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
