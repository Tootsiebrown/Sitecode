var livesearch_list = (function($, window, document, undefined) {
	var script 		= '/admin/cms_multiselect_popup.php';
	var hWnd 		= "";
	var pStruct		= "";
	var struct		= "";
	var pField		= "";
	var pID			= "";
	var prodID		= "";
	
	return {
		init: function(parentStructure, structure, parentField, parentId, product_id) {
			hWnd 	= $('.livesearch-list');
			pStruct	= parentStructure;
			struct	= structure;
			pField	= parentField;
			pID		= parentId;
			prodID	= product_id;
			$('.livesearch-list').live("keyup", this.events.keyup);
		},
		events: {
			keyup: function(evt) {
				var charCode = evt.charCode || evt.keyCode;
				if (charCode  == 13) { //Enter key's keycode
				return false;
				}				
				$.post(script, { 
					'call':'livesearch', 
					'val':$('.livesearch-list').val(), 
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
					$('.search-results').html(obj.results);	
					$('.livesearch-list-nav').html(obj.nav);
				});
				return false;
			}
		}
	}
})(jQuery, this, this.document);