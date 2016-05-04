function showDialog(dialogElement)
{	
	var dialog = new CoolDialog(dialogElement);
	
	dialog.setCloseOnClick(true);

	dialog.toggle();
}

function correctProfileMenu()
{
	var menu = $('#profile-menu');
	
	if (menu)
	{
		if (menu.outerHeight() > $(window).height())
		{
			menu.addClass('absolute');
			$('#profile-menu-toggle').addClass('absolute');
		}
	}
}

function loadPublicationTypes()
{
	var typeFilter = $('#publications-types-filter');
	
	if (typeFilter)
	{
		var types = [];
	
		$('.publication').each(function() {
			var type = $(this).attr('data-type');

			if (types.indexOf(type) < 0)
			{
				types.push(type);
			}
		});

		types.forEach(function(item) {
			typeFilter.append('<option value="' + item + '">' + item + '</option>');
		});
	}
}


$(function() {
	
	correctProfileMenu();
	
	loadPublicationTypes();
	
	$('.project .header, .publication .header').click(function(e) {
		$(this).parent().find('.content').toggleClass('visible');
	});
	
	$('#publications-types-filter').change(function() {
		var type = $(this).val();
		
		if (type === '')
		{
			$('.publication').show();
		}
		else
		{
			$('.publication').each(function() {
				if ($(this).attr('data-type') === type)
				{
					$(this).show();
				}
				else
				{
					$(this).hide();
				}
			});
		}
	});
	
	$('.dialog-trigger').click(function() {

		var dialogElement = $('#' + $(this).attr('data-dialog'));

		showDialog(dialogElement);
	});
	
	$('#profile-menu-toggle').click(function() {
		$('#profile-menu').toggleClass('visible');
	});
	
});