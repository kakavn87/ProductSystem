var modulRequirement = [];
var formDataService = {};
formDataService.files = [];
$(function() {
	if(roleName == 'customer') {
		$('#customer_view').parent().hide();
		$('#standard').parent().hide();
	}
	
	$(" #roles, #orders").chosen();
	
	$('.search-choice').live('click',function(){             
		var index = $(this).find('.search-choice-close').data('option-array-index');
		$.ajax({
			url : BASE_URL + 'reports/get_report',
			type : 'post',
			data : {report_id: index},
		}).done(function(html) {
			$.fancybox({
				content : html,
			});
		});
	});
	
	$('.cbOutsourcing').live('click', function() {
		if ($(this).is(':checked')) {
			$('.modul-normal-container').hide();
			$('.modul-outsourcing').show();
        } else {
        	$('.modul-normal-container').show();
        	$('.modul-outsourcing').hide();
        }
	});

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
	$( "#tabs" ).tabs();
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
	formData.report_id = $('#report_id').val();
	formData.type = $('#standard').is(':checked');
	formData.customer_view = $('#customer_view').is(':checked');
	
	formData.document = {};
	formData.document.description = [];
	formData.document.type = [];
	formData.document.link = [];
	formData.document.files = formDataService.files;
	$(".document-description-service").each(function() {
		formData.document.description.push($(this).val());
	});
	
	$('.type-service').each(function() {
		formData.document.type.push($(this).val());
	});
	$('.document-link').each(function() {
		formData.document.link.push($(this).val());
	});
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
	$('.edit-role').live('click', openRoleRequirement);
	$('.addBox').live('click', openListModul);
	$('.service-standard').live('click', showStandard);
	$(".add-module").live('click', showAddModule);
	$('#addDocument').live('click', addDocument);
	$('.remove-document').live('click', removeDocument);
	$('.save-modul').live('click', saveModul);
	$('.save-modul-outsourcing').live('click', saveModulOutsourcing);
	
	$('.add-requirement').live('click', function(e) {
		$('.re-box, .requirement-container').toggle();
	});
	
	$('.re-cancel').live('click', function(e) {
		$('.re-box, .requirement-container').hide();
	});
	
	$('.mr_type').live('change', function(e) {
		if($(this).val() == 'modul') {
			$('.operator').show();
		} else {
			$('.operator').hide();
		}
	});
	
	$('.type-service').live('change', function() {
		if($(this).val() == 'VIDEO') {
			$(this).parent().find('.link').show();
			$(this).parent().find('.fileupload').hide();
		} else {
			$(this).parent().find('.link').hide();
			$(this).parent().find('.fileupload').show();
		}
	});
	
	$('#addDocumentService').live('click', function(e) {
		e.preventDefault();
		if (e.handled !== true) {
			var html = $('.documents-service').html();
			$('.list-document-service').append(html);
			
			var idx = $('.list-document-service').find('.item').length - 1;
			$('.documents-service').find('.fileupload').attr('id', 'fileuploadService' + (idx+1));
			
			$('#fileuploadService' + idx).fileupload({
		        url: BASE_URL + 'document_services/upload',
		        dataType: 'json',
		        done: function (e, data) {
		        	formDataService.files = jQuery.grep(formDataService.files, function(value) {
						return value.idx != idx;
					});
		        	
		            $.each(data.result.files, function (index, file) {
		            	formDataService.files.push({url: file.url, idx: idx});
		            });
		        },
		        
		    }).prop('disabled', !$.support.fileInput)
		        .parent().addClass($.support.fileInput ? undefined : 'disabled');
			e.handled = true;
		}
	});
	
	$('.td-remove').live('click', function(e) {
		var index = $(this).data('index');
		modulRequirement = jQuery.grep(modulRequirement, function(value) {
			return value.name != index;
		});
		$(this).parent().remove();
	});
	
	$('.re-add').live('click', function(e) {
		var name = $(this).parent().find('.mr_name').val();
		var type = $(this).parent().find('.mr_type').val();
		var desc = $(this).parent().find('.mr_desc').val();
		var value = $(this).parent().find('.mr_value').val();
		var operator = $(this).parent().find('.mr_operator').val();

		if(!name.trim().length) {
			alert('Name is not empty');
			return false;
		}
		
		modulRequirement.push({
			name: name, 
			type: type, 
			description: desc,
			operator: operator,
			value: value
		});
		
		var html = '<tr class="tr-second">';
		if(type != 'modul') {
			html += '<td>' + name + '</td><td>' + type + '</td><td>' + desc + '</td>';
		} else {
			html += '<td>' + name + ' ' + operator + ' ' + value + '</td><td>' + type + '</td><td>' + desc + '</td>';
		}
		
		html += '<td class="td-remove" data-index="' + name + '">Delete</td>';
		html += '</tr>';
		$('table.tbl-requirement').append(html);
		
		$(this).parent().find('.mr_name').val('');
		$(this).parent().find('.mr_desc').val('');
		
		$('.re-box, .requirement-container').hide();
		console.log(modulRequirement);
	});
	
	
	function saveModulOutsourcing(e) {
		e.preventDefault();
		
		var formData = $('form.create-modul-outsourcing').serializeArray();
		$.each(modulRequirement, function (i, e) {
			formData.push({
				name: 'data[modulRequirement][name][]',
				value: e.name
			});
			formData.push({
				name: 'data[modulRequirement][type][]',
				value: e.type
			});
			formData.push({
				name: 'data[modulRequirement][description][]',
				value: e.description
			});
			formData.push({
				name: 'data[modulRequirement][operator][]',
				value: e.operator
			});
			formData.push({
				name: 'data[modulRequirement][value][]',
				value: e.value
			});
		})
		if (e.handled !== true) {
			$.ajax({
				url : BASE_URL + 'moduls/saveOutSourcingAjax',
				type : 'post',
				data : formData,
				beforeSend : function(xhr) {
					$.fancybox.showActivity();
				}
			}).done(function(data) {
				$('table.tbl-requirement tr.tr-second').remove();
				$.fancybox.hideActivity();
				
				var obj = $.parseJSON(data);
				if(!obj.status) {
					var modulObj = $.parseJSON(obj.modul);
					modulObj.status = 'allow';
					if($('#number').val() == 1) {
						if(roleName == 'customer') {
							modulObj.status = 'deny';
						}
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
					
					modulRequirement = [];
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
					modulObj.status = 'allow';
					if($('#number').val() == 1) {
						if(roleName == 'customer') {
							modulObj.status = 'deny';
						}
						
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
							return (value.id + '_' + value.type) != removeItem;
						});
					} else if(parentId == 'sortableCus') {
						listModuleForCustomers = jQuery.grep(listModuleForCustomers, function(value) {
							return (value.id + '_' + value.type) != removeItem;
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

			if(modulType == 'normal') {
				$.ajax({
					url : BASE_URL + 'service/show_modul_detail',
					type : 'post',
					data : {
						service_id: $('#serviceid').val(),
						modul_id : modulId,
						modul_type: modulType
					},
				}).done(function(data) {
					$('.contain-modul-detail').html(data);
				});
			} else {
				alert('This modul is standard. Please saving before view detail');
			}
		}
	}

	function openRoleRequirement(e) {
		if (e.target == this) {
			var roleId = $(this).data('id');
			
				$.ajax({
					url : BASE_URL + 'service/show_role_requirement',
					type : 'post',
					data : {
						service_id: $('#serviceid').val(),
						role_id : roleId
						
					},
				}).done(function(data) {
					$('.contain-role-requirement').html(data);
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
		var color = 'style="background-image: url(\'' + BASE_URL + 'css/images/' + value.color + '\') !important; background-color: none !important; "';
		var html = '<div ' + color + ' class="containerBox ui-state-default" id=\''
				+ JSON.stringify(value) + '\' data-modulid="' + value.id
				+ '" data-modultype="' +  value.type + '"><div class="closeBox"><img data-modultype="' +  value.type + '" data-modulname="' + value.modul
				+ '" data-modulid="' + value.id + '_' + value.type + '" src="' + BASE_URL
				+ 'css/images/deleteIcon.png" /></div>' + status + value.modul
				+ '</div>';
		return html;
	}

	function createAddModul(position, number) {
		var html = '<div id="' + position + '" data-number="' + number + '" class="addBox ui-state-default">'+'<img class="add_modul_icon"  src="' + BASE_URL
				+ 'css/images/add.png" />'+'</div>';
		return html;
	}

	//expand-and-collapse-a-div-using-javascript
	$(".header").click(function () {

    $header = $(this);
    //getting the next element
    $content = $header.next();
    //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
    $content.slideToggle(500, function () {
        //execute this after slideToggle is done
        //change text of header based on visibility of content div
        $header.text(function () {
            //change text based on condition
            return $content.is(":visible") ? "Collapse" : "Expand";
        });
   	 });

	});
	
	return false;
	
	
}
