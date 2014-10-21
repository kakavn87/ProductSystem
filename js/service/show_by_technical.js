$(function() {
	if(roleName == 'customer') {
		$('#customer_view').parent().hide();
		$('#standard').parent().hide();
	}
	
	$("#products, #roles, #orders, #requirments, #report_id").chosen();

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
	
	$('#search-modul-standard').search('.modul-standard-name', function(on) {

		on.all(function(results) {
			var size = results ? results.size() : 0
		});

		on.reset(function() {
			$('.modul-standard-name').show();
		});

		on.empty(function() {
			$('.modul-standard-name').hide();
		});

		on.results(function(results) {
			$('.modul-standard-name').hide();
			results.show();
		});
	});
	
	$('#search-modul-normal').search('.modul-normal-name', function(on) {

		on.all(function(results) {
			var size = results ? results.size() : 0
		});

		on.reset(function() {
			$('.modul-normal-name').show();
		});

		on.empty(function() {
			$('.modul-normal-name').hide();
		});

		on.results(function(results) {
			$('.modul-normal-name').hide();
			results.show();
		});
	});

	$('#saveService').live('click', saveService);
	
	doService({
		allowEdit : true
	});
});

function saveService(e) {
	e.preventDefault();

	var formData = {};
	formData.id = $('#serviceid').val();
	formData.files = $('.files').files;
	console.log(formData.files);
	return false;

	if (!formData.name.trim().length) {
		showDialog('Error', 'Please enter service name');
		return false;
	}

	if (!formData.modul.length) {
		showDialog('Error', 'Please add a modul');
		return false;
	}

	if (!parseInt(formData.requirement_id)) {
		showDialog('Error', 'Please select a requirement');
		return false;
	}

	if (!parseInt(formData.role_id)) {
		showDialog('Error', 'Please select a role');
		return false;
	}

	if (!parseInt(formData.product_id)) {
		showDialog('Error', 'Please select a product');
		return false;
	}

	if (e.handled !== true) {
		$.ajax({
			url : BASE_URL + 'service/save',
			type : 'post',
			data : formData,
			beforeSend : function(xhr) {

			}
		}).done(function(data) {
			var obj = $.parseJSON(data);
			if(obj.status) {
				showDialog("Error", 'Can not create new service');
			} else {
				showDialog("Success", 'Create new service successful');
				location.href = location.href;
			}
		});

		// this next line *must* be within this if statement
		e.handled = true;
	}

}

function doService(params) {
	var modulList = $('.modulList');
	var modulListSecond = $('.second');

	$('ul#navLeft li').live('click', loadService);
	$('.containerBox').live('click', openModulDetail);
	
	draw();

	function draw() {
		modulList.html('');
		$.each(listModules, function(index, value) {
			var containerBox = createBox(value);
			modulList.append(containerBox);
		});
		
		modulListSecond.html('');
		$.each(listModuleForCustomers, function(index, value) {
			var containerBox = createBox(value);
			modulListSecond.append(containerBox);
		});
	}

	function openModulDetail(e) {
		if (e.target == this) {
			var modulId = $(this).data('modulid');
			var modulType = $(this).data('modultype');

			$.ajax({
				url : BASE_URL + 'service/show_modul_detail',
				type : 'post',
				data : {
					modul_id : modulId,
					modul_type: modulType
				},
			}).done(function(data) {
				$.fancybox({
					content : data
				});
			});
		}
	}

	function createBox(value) {
		var color = 'style="background-color: ' + value.color + ' !important; background-image: none !important; "';
		var html = '<div ' + color + ' class="containerBox ui-state-default" id=\''
				+ JSON.stringify(value) + '\' data-modulid="' + value.id
				+ '" data-modultype="' +  value.type + '">' + value.modul
				+ '</div>';
		return html;
	}
	
	return false;
}
