$(function() {
	$("#selectType").chosen();
	if(type == 'normal') {
		$('.saveas-normal').prop('checked', true);
		$('.resources').show();
	}
	
	$('.type').live('change', function() {
		console.log($(this).parent().parent().find('.fileInfo').html());
		if($(this).val() == 'PDF') {
			$(this).parent().parent().find('.fileInfo').show();
			$(this).parent().parent().find('.linkInfo').hide();
		} else {
			$(this).parent().parent().find('.fileInfo').hide();
			$(this).parent().parent().find('.linkInfo').show();
		}
	});
	
	
	$('#addDocument').live('click', addDocument);
	
	$('.remove-document').live('click', removeDocument);
	
	$('ul#navLeft li').live('click', loadService);
	
	$('.normal').live('click', normalCLickCallback);
	
	$('.standard').live('click', standardCLickCallback);
	
	$('.saveas-normal').live('click', saveAsModulNormal);
	
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

function saveAsModulNormal(e) {
	if($(this).is(':checked'))  {
		$('.resources').show();
	} else {
		$('.resources').hide();
	}
}

function normalCLickCallback(e) {
	$('.standard, .normal').removeClass('active');
	$('.standard, .normal').removeClass('hide');
	$('div.normal').addClass('active');
	$('li.standard').addClass('hide');
}

function standardCLickCallback(e) {
	$('.standard, .normal').removeClass('active');
	$('.standard, .normal').removeClass('hide');
	$('div.standard').addClass('active');
	$('li.normal').addClass('hide');
}

function addDocument() {
	var html = $('.documents').html();
	$('.list-document').append(html);
}

function removeDocument() {
	$(this).parent().remove();
}