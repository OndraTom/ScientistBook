/**
 * Cool dialog.
 *
 * @author Ondrej Tom
 */
$(window).load(function() {

	function CoolDialog(dialogBox)
	{	
		this.dialogBox		= dialogBox;
		this.dialogContent	= dialogBox.find('.dialog-content');
		this.dialogOverlay	= dialogBox.find('.dialog-overlay');
		this.closeOnClick	= false;
		this.isOpen			= false;
		this.eventsInited	= false;
	}

	CoolDialog.prototype._initEvents = function() {

		var self = this;
		
		this.dialogOverlay.click(function(e) {
			if (self.closeOnClick || $(e.target).attr('class') === 'dialog-overlay')
			{
				self.toggle();
			}
		});

		$(document).keyup(function(e) {
			if (self.isOpen && e.keyCode === 27)
			{
				self.toggle();
			}
		});

	};
	
	CoolDialog.prototype.setCloseOnClick = function(flag) {
		
		this.closeOnClick = flag;
	};

	CoolDialog.prototype.toggle = function() {

		if (!this.eventsInited)
		{
			this._initEvents();
		}

		var self = this;

		if (this.isOpen)
		{	
			this.dialogBox.removeClass('dialog--open');
			this.dialogBox.addClass('dialog--close');

			this.dialogContent.on('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', function() {
				self.dialogBox.removeClass('dialog--close');
			});
		}
		else
		{
			this.dialogBox.addClass('dialog--open');
		}

		this.isOpen = !this.isOpen;

	};

	// Add to global namespace.
	window.CoolDialog = CoolDialog;

});