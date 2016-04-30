function showDialog(dialogElement)
{
	var dialog = new CoolDialog(dialogElement);

	dialog.toggle();
}

function clearElementFormsValues(element)
{
	var form = element.find('form');

	form.find('input[type=text], input[name=id], textarea').val('');
	form.find('option[selected=selected]').removeAttr('selected');
}

$(function() {

	$.nette.init();

	$('.dialog-trigger').click(function() {

		var dialogElement = $('#' + $(this).attr('data-dialog'));

		clearElementFormsValues(dialogElement);

		showDialog(dialogElement);
	});

});