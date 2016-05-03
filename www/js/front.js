$(function() {
	
	$('.project .header').click(function(e) {
		$(this).parent().find('.content').toggleClass('visible');
	});
	
});