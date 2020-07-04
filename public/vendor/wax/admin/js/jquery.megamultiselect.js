var megamultiselect_list = (function($, window, document, undefined) {
	var script 		= '';
	var hWnd 		= "";
	var pStruct		= "";
	var struct		= "";
	var pField		= "";
	var pID			= "";
	var prodID		= "";
	
	return {
		init: function(callback_script, parentStructure, structure, parentField, parentId, product_id) {
			script	= callback_script;
			hWnd 	= $('.livesearch-table');
			pStruct	= parentStructure;
			struct	= structure;
			pField	= parentField;
			pID		= parentId;
			prodID	= product_id;
			$('.livesearch-table tr').live("click",this.list.events.click);
			$('.livesearch-list-nav').live("click",this.pagenav.events.click);
		},
		list: {
			events: {
				click: function() {
					var parent = $(this);
					$.post(script, { 
						'call':'megamultiselect-click', 
						'val':$(this).attr('id'),
						'parentStructure':pStruct,
						'structure':struct, 
						'parentField':pField, 
						'parentId':pID, 
						'product_id':prodID}, function(data) {
						try {
							var obj = jQuery.parseJSON(data);
						} catch (e) {
							return false;
						}
						if (obj.results == 1) {
							if (parent.hasClass('selected')) {
								parent.removeClass('selected');
								parent.addClass('unselected');
							} else {
								if (parent.hasClass('unselected')) {
									parent.removeClass('selected');
								}
								parent.addClass('selected');							
							}
						}
					}); // End $.post	
				} // End click event
			} // End events
		}, // End list object
		pagenav: {
			events: {
				click: function() {
					var parent 	= $(this);
					var page 	= $(event.target).attr('data-page');
					var search	= $('#multiselect_livesearch').val();
					$.post(script, { 
						'call':'megamultiselect-page', 
						'val':page,
						'parentStructure':pStruct,
						'structure':struct, 
						'parentField':pField, 
						'parentId':pID, 
						'product_id':prodID,
						'page':page,
						'search':search}, function(data) {
						try {
							var obj = jQuery.parseJSON(data);
						} catch (e) {
							return false;
						}
						$('.search-results').html(obj.results);	
						$('.livesearch-list-nav').html(obj.nav);
					}); // End $.post					
				} // End click event
			} // End events
		} // End pagenav object
	}
})(jQuery, this, this.document);