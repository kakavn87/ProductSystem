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
	formData.name = $('#name').val();
	formData.modul = [];
	$.each(listModules, function(index, value) {
		formData.modul.push(value);
	});
	formData.modul_customer = [];
	$.each(listModuleForCustomers, function(index, value) {
		formData.modul_customer.push(value);
	});
	formData.order_id = $("#order_id").val();
	formData.requirement_id = $('#requirments').val();
	formData.role_id = $('#roles').val();
	formData.product_id = $('#products').val();
	formData.type = $('#standard').is(':checked');
	formData.customer_view = $('#customer_view').is(':checked');

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

	$('.addToService').live('click', addToService);
	$('ul#navLeft li').live('click', loadService);
	$('.containerBox').live('click', openModulDetail);
	$('.addBox').live('click', openListModul);
	$('.service-standard').live('click', showStandard);
	$(".add-module").live('click', showAddModule);
	$('#addDocument').live('click', addDocument);
	$('.remove-document').live('click', removeDocument);
	$('.save-modul').live('click', saveModul);
	
	function saveModul(e) {
		e.preventDefault();
		
		if (e.handled !== true) {
			$.ajax({
				url : BASE_URL + 'moduls/saveAjax',
				type : 'post',
				data : $('form.create-modul').serialize(),
				beforeSend : function(xhr) {

				}
			}).done(function(data) {
				var obj = $.parseJSON(data);
				if(!obj.status) {
					var modulObj = $.parseJSON(obj.modul);
					if($('#number').val() == 1) {
						if($('#position').val() == 'right') {
							listModules.push(modulObj);
						} else {
							listModules.splice(0, 0, modulObj);
						}
					} else {
						if($('#position').val() == 'right') {
							listModuleForCustomers.push(modulObj);
						} else {
							listModuleForCustomers.splice(0, 0, modulObj);
						}
					}
					$.fancybox.close();
					draw();
				} else {
					alert(obj.message);
				}
			});

			// this next line *must* be within this if statement
			e.handled = true;
		}
	}
	
	function addDocument() {
		var html = $('.documents').html();
		$('.list-document').append(html);
	}

	function removeDocument() {
		$(this).parent().remove();
	}

	draw();

	$("#sortableDev, #sortableCus").sortable({
		start : function() {
		},
		update : function(event, ui) {
			var data = $(this).sortable('toArray');
			
			var thisId = $(this).attr('id');
			if(thisId == 'sortableDev') {
				listModules = [];
				$.each(data, function(i, val) {
					if (val && val != "left" && val != "right") {
						var json = JSON.stringify(eval("(" + val + ")"));
						listModules.push($.parseJSON(json));
					}
				});
			} else if(thisId == 'sortableCus') {
				listModuleForCustomers = [];
				$.each(data, function(i, val) {
					if (val && val != "left" && val != "right") {
						var json = JSON.stringify(eval("(" + val + ")"));
						listModuleForCustomers.push($.parseJSON(json));
					}
				});
			}
		},
		stop : function() {
			draw();
		}
	});
	$("#sortableDev, #sortableCus").disableSelection();

	if (params.allowEdit) {
		$('.closeBox img').live(
				'click',
				function() {
					var parentId = $(this).parent().parent().parent().attr('id');
					var removeItem = $(this).data('modulid');
					var type = $(this).data('modultype');
					if(parentId == 'sortableDev') {
						listModules = jQuery.grep(listModules, function(value) {
							return value.id != removeItem;
						});
					} else if(parentId == 'sortableCus') {
						listModuleForCustomers = jQuery.grep(listModuleForCustomers, function(value) {
							return value.id != removeItem;
						});
					}
					// re-draw
					draw();
				});
	}
	
	if(roleName == 'developer') {
		$('.status-box img').live('click', function(e){
			var id = $(this).parent().parent().attr('id');
			var parent = $(this).parent();
			$.ajax({
				url : BASE_URL + 'service/allowServiceModul',
				type : 'post',
				data: JSON.parse(id)
			}).done(function(data) {
				parent.remove();
			});
		});
	}
	
	function showAddModule(e) {
		e.preventDefault();
		if (e.handled !== true) {
			$.fancybox({
				content : $('.modul-normal-list').html(),
			});
			e.handled = true;
		}
	}

	function openListModul(e) {
		e.preventDefault();
		if (e.handled !== true) {
			$('#position').val($(this).attr('id'));
			$('#number').val($(this).data('number'));
			
			$.fancybox({
				content : $('.list-modul').html(),
			});
			
			e.handled = true;
		}
	}
	
	function showStandard(event) {
//		console.log($(this).data('href'));
		$.ajax({
			url : $(this).data('href'),
			type : 'post',
		}).done(function(data) {
			var obj = $.parseJSON(data);
			
			listModules = obj.listModules;
			listModuleForCustomers = obj.listModuleCustomers;
			
			draw();
		});
	}

	function addToService(e) {
		e.preventDefault();
		if (e.handled !== true) {
			$('.modul:checked').each(function(index, value) {
				var data = $(this).data('modulname');
				data.status = 'allow';
				if($('#number').val() == 1) {
					if(roleName == 'customer') {
						data.status = 'deny';
					}
					
					if($('#position').val() == 'right') {
						listModules.push(data);
					} else {
						listModules.splice(0, 0, data);
					}
				} else {
					if($('#position').val() == 'right') {
						listModuleForCustomers.push(data);
					} else {
						listModuleForCustomers.splice(0, 0, data);
					}
				}
//				$('.modul' + $(this).data('modulname').id).remove();
			});
			$.fancybox.close();
			draw();
			// this next line *must* be within this if statement
			e.handled = true;
		}

		return false;
	}

	function draw() {
		modulList.html('');
		modulList.append(createAddModul('left', 1));
		$.each(listModules, function(index, value) {
			var containerBox = createBox(value);
			modulList.append(containerBox);
		});
		modulList.append(createAddModul('right', 1));
		
		modulListSecond.html('');
		modulListSecond.append(createAddModul('left', 2));
		$.each(listModuleForCustomers, function(index, value) {
			var containerBox = createBox(value);
			modulListSecond.append(containerBox);
		});
		modulListSecond.append(createAddModul('right', 2));
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

	function createInput(id, modul) {
		var html = '<div class="modul-name">';
		html += '<input type="checkbox" id="modul" class="modul" data-modulname=\'{"id": '
				+ id + ', "modul":"' + modul + '"}\' /> ';
		html += modul;
		html += '</div>';
		return html;
	}

	function createBox(value) {
		var status = '';
		if(value.status == 'deny') {
			status = '<div class="status-box"><img src="' + BASE_URL + 'css/images/danger.png" /></div>';
		}
		var color = 'style="background-color: ' + value.color + ' !important; background-image: none !important; "';
		var html = '<div ' + color + ' class="containerBox ui-state-default" id=\''
				+ JSON.stringify(value) + '\' data-modulid="' + value.id
				+ '" data-modultype="' +  value.type + '"><div class="closeBox"><img data-modultype="' +  value.type + '" data-modulname="' + value.modul
				+ '" data-modulid="' + value.id + '" src="' + BASE_URL
				+ 'css/images/deleteIcon.png" /></div>' + status + value.modul
				+ '</div>';
		return html;
	}

	function createAddModul(position, number) {
		var html = '<div id="' + position + '" data-number="' + number + '" class="addBox ui-state-default">+</div>';
		return html;
	}
	
	return false;
}
