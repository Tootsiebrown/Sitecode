
/**
	Load Functions
***************************/

$(document).ready(function() {
	initiate_dropDowns();
	initCmsActions();
});



/**
	Functions
***************************/






function initCmsActions() {
	$(document).on('click', '[data-action="submit-bulkaction"]', function(e) {
		e.preventDefault();

		$selectedAction = $('select[data-property="bulkaction"] :selected');
		if(!$selectedAction.length || !$selectedAction.attr('value').length) return false;

		if($selectedAction.is('[data-property-confirm]') && !confirm($selectedAction.attr('data-property-confirm'))) return false;

		var $trigger = $(this);

		// prevent multiple clicks + set a better action name
		$trigger.hide();
		$('[data-action="bulk-action"]').val('bulkaction');

		$trigger.closest('form').submit();
		return true;
	});
}


//Clear Form Fields
function initiate_clearDefault() {
	$("input, textarea").cleardefault();
}

// Dropdowns
function initiate_dropDowns() {
	$(".subnav .more").click(function(){
		$(this).parent('li').find('ul').toggle();
	});

	$("#page-sidebar .side-box h1 a").click(function(){
		$(this).parents('.side-box').find('ul').slideToggle(500);
		return false;
	});

	$("#page-sidebar .side-box").each(function(){
		if( $(this).find('.active').length > 0 ) $(this).addClass('active');
	});

	$("#page-sidebar .side-box.active").find('ul').show();

	$(document).bind('click', function(e){
		var $clicked = $(e.target);

		if (! $clicked.parents().is(".subnav") ) {
			$('.subnav ul').hide();
		}
	});
}