tinyMCE.init({
	//mode : 'textareas',
	theme : 'advanced',
	//editor_selector : 'tinymceeditor',
	plugins : 'spellchecker,inlinepopups,paste',
	spellchecker_languages : '+Русский=ru',
	theme_advanced_buttons1 : 'bold,italic,underline,separator,bullist,numlist,separator,code,cleanup,separator,spellchecker,separator,pasteword,separator,undo,redo',
	theme_advanced_buttons2 : '',
	theme_advanced_buttons3 : '',
	theme_advanced_toolbar_location : 'top',
	theme_advanced_toolbar_align : 'left',
	entity_encoding : 'raw',
	gecko_spellcheck : true,
	verify_html : true,
	inline_styles : false,
	valid_elements : 'strong/b,em/i,u,#p,-ol,-ul,-li,br',
	invalid_elements : 'table,thead,tbody,th,tr,td,div,img,font,pre,span',
	apply_source_formatting : true,
	fix_list_elements : true,
	//convert_newlines_to_brs : true,
	setup : function(ed) {
		ed.onChange.add(function(ed) {
			ed.save();
		});
	},
	language : 'ru',
	width: 850,
	height: 150
});

var i = 0;

function showelements(rowid) {
	jQuery('#row'+rowid+'body2 .divcheckboxtohide input:checkbox').parent().show();
	return false;
}

function hideelements(rowid) {
	jQuery('#row'+rowid+'body2 .divcheckboxtohide input:checkbox:not(:checked)').parent().hide();
	return false;
}

function showdivelementecoruptibilitate(control) {
	if (control == 2)
		tb_show('Подробный список факторов коррупционности установленных экспертами', '/reports/viewotherelements?KeepThis=true&TB_iframe=true&height=500&width=520', false);
	else
		tb_show('Подробный список факторов коррупционности', '/reports/viewelements?KeepThis=true&TB_iframe=true&height=550&width=950', false);
	return false;
}

function confirmDelete(delobj) {
	if (confirm('Хотите удалить ?')) {
		tinyMCE.execCommand('mceRemoveControl', false, 'subraport'+delobj+'SubreportText');
		tinyMCE.execCommand('mceRemoveControl', false, 'subraport'+delobj+'SubreportObiectia');
		jQuery('#subraport'+delobj+'SubreportTodelete').val(1);
		jQuery('#row'+delobj).hide();
	}
	return false;
}

function toogletinymce(tinymceid) {
	if (!tinyMCE.get(tinymceid))
		tinyMCE.execCommand('mceAddControl', false, tinymceid);
	else
		tinyMCE.execCommand('mceRemoveControl', false, tinymceid);
	return false;
}

function initrows() {
	jQuery('.subreportrow').each(function () {
		rowid = i;
		jQuery('#row'+rowid+'list').tabs();
		//tinyMCE.execCommand('mceAddControl', false, 'subraport'+rowid+'SubreportText');
		//tinyMCE.execCommand('mceAddControl', false, 'subraport'+rowid+'SubreportObiectia');
		i++;
	});
}

function addrow()
{
	rowid = i;
	jQuery.get('/reports/generatesubreportcode/'+rowid+'/'+celemsacceptance, function(data) {
		jQuery('#rowsdiv').append(jQuery(data));
		jQuery('label').click(function() {
			return false;
		});
		jQuery('#row'+rowid+'list').tabs();
		//tinyMCE.execCommand('mceAddControl', false, 'subraport'+rowid+'SubreportText');
		//tinyMCE.execCommand('mceAddControl', false, 'subraport'+rowid+'SubreportObiectia');
	});
	i++;
	return false;
}

function confirmDeleteattachment(delobj) {
	if (confirm('Хотите удалить ?'))
	{
		$('#'+delobj+'todelete').val(1);
		$('#'+delobj+'Attachmentfile').remove();
		$('#'+delobj).hide();
	}
	return false;
}

function addattachment(){
	attachmentkey = countattachment;
	$('#attachmentsdiv').append($(
		'<tr id="Attachment'+attachmentkey+'">'+
			'<td valign="top">Название приложения: <input name="data[Attachment]['+attachmentkey+'][name]" id="Attachment'+attachmentkey+'Name" style="width: 350px;">'+
			'<input type="hidden" name="data[Attachment]['+attachmentkey+'][todelete]" id="Attachment'+attachmentkey+'todelete" value="0"/></td>'+
			'<td width="180" valign="top"></td>'+
			'<td width="200" valign="top"><input name="data[Attachment]['+attachmentkey+'][attachmentfile]" type="file" id="Attachment'+attachmentkey+'Attachmentfile"/></td>'+
			'<td width="30" valign="top"><a href="javascript:void(0);" onclick="return confirmDeleteattachment(\'Attachment'+attachmentkey+'\');"><img src="/images/delete.png" width="20" height="20" border="0" title="стереть приложение"/></a></td>'+
		'</tr>'
	));
	countattachment++;
	return false;
}

function processResponse(data)
{
	// 'data' is the json object returned from the server
	if (data.message) {
		if (isadmin == 1) backlink = '/admin';
		else backlink = '';
		location.href = backlink + '/reports';
	}
	else
		jQuery('#submit-message-append').html('<br/>Заключение не может быть сохранено. Наверное уже существует заключение под тем же номером. Проверьте введенные данные и проверьте еще раз.<br/>');
}

jQuery(document).ready(function($){

	//$().ajaxStart($.blockUI).
	//ajaxStop($.unblockUI).
	$().ajaxError(function(a, b, e) {
		throw e;
		alert('Ошибка соединения! Проверьте подключение к серверу!');
	});

	$.metadata.setType('attr', 'validate');

	var validator = $('#ReportEditForm').validate({
		errorPlacement: function(error, element) {
			if (element.is(':radio'))
				error.appendTo(element.parent().nextAll('.green'));
			else if (element.is('textarea'))
				error.appendTo(element.parent().prev());
			else
				error.appendTo(element.parent().next());
		},
		showErrors: function(errorMap, errorList) {
			var errors = this.numberOfInvalids();
			if (($('#ReportReportstate:checked').length == 1 || $('#ReportReportstate option:selected').length == 1) && (errors)) {
				var message = errors == 1 ? '1 ошибку' : errors + ' ошибок';
				$('#submit-message-append').html('<br/>Заключение содержит ' + message + ', проверьте введенные данные.<br/>');
			}
			else $('#submit-message-append').html('');
			this.defaultShowErrors();
		}
		// specifying a submitHandler prevents the default submit, good for the demo
		//submitHandler: function() {
			//tinyMCE.triggerSave();
			//$('#ReportEditForm').ajaxSubmit({
				//url:	'/reports/save',
				//dataType:		'json',
				//success:		processResponse
			//});
		//}
	});

	$(".required_dependent").each(function(){
		$(this).rules("add", {
			required: function(element) {
				if ($('#ReportReportstate:checked').length == 1 || $('#ReportReportstate option:selected').length == 1) return true;
				else return false
			}
		});
	});

	$('input, select, textarea').blur(function(){
		validator.element(this);
	});

	$('#savebutton').click(function(){
		//tinyMCE.triggerSave();
		jQuery('.tinymceeditor').each(function () {
			tinyMCE.execCommand('mceRemoveControl', false, $(this).attr('id'));
		});
		//return false;
	});

	$('#savebutton2').everyTime(300000, function(){
		jQuery('.tinymceeditor').each(function () {
			tinyMCE.execCommand('mceRemoveControl', false, $(this).attr('id'));
		});
		$('#ReportEditForm').ajaxSubmit();
	});

	$('.sortable').sortable({
		placeholder: 'ui-state-highlight',
		handle: '.handle',
		tolerance: 'pointer',
		start: function(event, ui) {
			var tinymcedisable = $(ui.item).attr('id');
			tinymcedisable = tinymcedisable.replace(/row/, '');
			tinyMCE.execCommand('mceRemoveControl', false, 'subraport'+tinymcedisable+'SubreportText');
			tinyMCE.execCommand('mceRemoveControl', false, 'subraport'+tinymcedisable+'SubreportObiectia');
		},
		helper: function() {
			var myHelper = document.createElement('div');
			$(myHelper).css({
				background: 'yellow',
				width: this.offsetWidth + 'px',
				height: '60px',
				opacity: 0.6,
				position: 'absolute'
			});
			return myHelper;
		},
		delay: 300,
		distance: 15
	});
	$('.handle').disableSelection();

	jQuery('label').click(function() {
		return false;
	});

	$('#ReportP09radio11').click(function(){
		$('.divtohidep09radio1').show();
	});

	$('#ReportP09radio12').click(function(){
		$('#ReportP09radio22').val(['2']);
		$('.divtohidep09radio1').hide();
	});

	$('#ReportP11radio11').click(function(){
		$('.divtohidep11radio1').show();
	});

	$('#ReportP11radio12').click(function(){
		$('#ReportP11radio22').val(['2']);
		$('.divtohidep11radio1').hide();
	});

	$('#ReportP12radio11').click(function(){
		$('.divtohidep12radio1').show();
	});

	$('#ReportP12radio12').click(function(){
		$('#ReportP12radio22').val(['2']);
		$('.divtohidep12radio1').hide();
	});

	$('#ReportP15radio11').click(function(){
		$('.divtohidep15radio1').show();
	});

	$('#ReportP15radio12').click(function(){
		$('#ReportP15radio22').val(['2']);
		$('.divtohidep15radio1').hide();
	});

	$('#ReportP05list1').change(function(){
		tempval = $(this).val();
		if (tempval == 'опубликована на сайте Парламента')
			$('#ReportP05list2').text('соблюдает');
		else if (tempval == 'не опубликована на сайте Парламента')
			$('#ReportP05list2').text('не соблюдает');
	});

	$('#ReportReportdatetext').datepicker({
		altField: '#ReportReportdate',
		altFormat: 'yy-mm-dd',
		onClose: function() {
			validator.element('#ReportReportdatetext');
		}
	});

	$('.divcheckboxtohide input:checkbox:not(:checked)').parent().hide();

	$('.bej, .gri').corner();

	$('#ReportP05list1').trigger('change');

	initrows();

});
