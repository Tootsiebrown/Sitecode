
/**
	Javascript Plugins
***************************/

/*
 *	Name:			Clear Default
 * Author:		Mitchell Petty
 */
(function($){
	jQuery.fn.cleardefault=function(options){
		var options = $.extend({}, $.fn.cleardefault.defaults, options);

		return this.each(function() {
			var
				$obj = $(this),
				$objType = $obj.attr('type');

			if( $obj.is(options.excludeClass) || $objType == 'submit' || $objType == 'button' ) {

				return false;

			} else {

				return $obj.focus(function(){

					if( this.value == this.defaultValue ) this.value = ""

				}).blur(function(){

					if( ! this.value.length ) this.value = this.defaultValue

				});

			}
		});
	};

	$.fn.cleardefault.defaults = {
		excludeClass: 	'.no-clear', //dont clear inputs with this class
	};
})(jQuery);

/*
 *	Name:		Smooth Scroll
 *	Author: 	Mitchell Petty
 * 	Version: 	1.0
 */
(function($){
	jQuery.fn.smoothScroll = function(options) {
		var options = $.extend({}, $.fn.smoothScroll.defaults, options);
		return this.each(function() {
			var $obj = $(this);

			$obj .click(function(){
				if( location.pathname.replace(/^\//,"") == this.pathname.replace(/^\//,"") && location.hostname == this.hostname ) {
					var a=$(this.hash),

					a = a.length && a || $("[name="+this.hash.slice(1)+"]");

					if(a.length){
						return a = a.offset().top,
						$("html,body").animate({ scrollTop:a  + options.scroll_offset }, options.scroll_speed),!1
					}
				}
			})
		});
	};

	$.fn.smoothScroll.defaults = {
		scroll_offset:	0,		 // pixel value of offset: ex '100px'
		scroll_speed: 	400,	 //animation speed
	};
})(jQuery);


/**
 * maxlength counter
 * - appends a counter to any text input that has a data-property-maxlength="##"
 *
 *
 * @author David Woodmansee
 *
 * @returns
 */
$(function() {
	$('.inputContainer input[type="text"], .inputContainer textarea').each(function(i) {
		var $this = $(this);
		if($this.is('[data-property-maxlength]')) {
			var afterNode = $('<span>').attr('data-target', $this.attr('id')).addClass('maxLengthCounter').text($this.val().length + ' / ' + $this.attr('data-property-maxlength'));
			$this.after(afterNode);
			$this.on('keydown.maxlength', function(e) {
				var allowedKeys = [8,9,10,16,17,18,33,34,35,36,37,38,39,40,45,46];
				if((this.value.length == $(this).attr('data-property-maxlength')) && $.inArray(e.keyCode, allowedKeys) == -1) {
					return false;
				}
			});
			$this.on('keyup.maxlength', function(e) {
				$('.maxLengthCounter[data-target="' + $(this).attr('id') + '"]').text(this.value.length + ' / ' + $(this).attr('data-property-maxlength'));
			});
		}
	});
});