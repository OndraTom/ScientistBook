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
		this.closeBtn		= dialogBox.find('[data-dialog-close]');
		this.isOpen			= false;

		this._initEvents();
	}

	CoolDialog.prototype._initEvents = function() {

		var self = this;

		this.closeBtn.click(function() {
			self.toggle();
		});

		this.dialogOverlay.click(function() {
			self.toggle();
		});

		$(document).keyup(function(e) {
			if (self.isOpen && e.keyCode === 27)
			{
				self.toggle();
			}
		});

	};

	CoolDialog.prototype.toggle = function() {

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