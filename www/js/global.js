function showDialog(dialogElement)
{	
	var dialog = new CoolDialog(dialogElement);

	dialog.toggle();
}

$(function() {

	$.nette.init();
	
	$('.nav-toggle').click(function() {
		$('nav .nav-item').toggleClass('visible');
	});

});