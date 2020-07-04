/**
 * Modals using Magnific Popup.
 *
 * AJAX MODALS:
 * Will create Ajax-based modals from links by default. Currently, default HTML would be:
 * <a href="/path/to/page" data-action="modal-mfp" data-fragment="#fragment">Foo</a>
 *
 * INLINE MODALS:
 * Modals from in-page content can be created by using type: 'inline'.
 * Default HTML would be:
 * <a href="/path/to/fallback/page" data-action="modal-mfp" data-mfp-src="#id-of-content">
 *
 * IMAGE MODALS:
 * Use type: image
 * <a href="/path/to/image" data-action="modal-mfp">Image type</a>
 *
 * GALLERY MODAL:
 * Use type: gallery
 * <div class="gallery">
 * 	   <a data-action="modal-mfp" href="/path/to/full/image/1"><img src="/path/to/thumbnail/image/1" alt="1"></a>
 * 	   <a data-action="modal-mfp" href="/path/to/full/image/2"><img src="/path/to/thumbnail/image/2" alt="2"></a>
 * 	   <a data-action="modal-mfp" href="/path/to/full/image/3"><img src="/path/to/thumbnail/image/3" alt="3"></a>
 * 	   <a data-action="modal-mfp" href="/path/to/full/image/4"><img src="/path/to/thumbnail/image/4" alt="4"></a>
 * 	   <a data-action="modal-mfp" href="/path/to/full/image/5"><img src="/path/to/thumbnail/image/5" alt="5"></a>
 * </div>
 *
 * For all other types, pass your custom MFP options to the module's init() function.
 *
 * @todo add beforeOpen callback so effect could be a data attribute
 * @module modal-mfp
 */

import Base from './base';
import 'vendor/magnific-popup/jquery.magnific-popup.min';

export default function ModalMFP(args){
	
	/**
	 * Plugin defaults / Base constructor
	 * ----------------------------------------------------------- */
	const DEFAULT = {
		name	: 'Modal (Magnific Popup)',
		el		: '[data-action="modal-mfp"]',
		type	: 'ajax'
    };

    let settings = Base.construct(DEFAULT, args);
	
	let action = function(){
		//console.log(settings.type);

		
		if (settings.type == 'ajax'){
			this.args = {
				type 			: 'ajax',
				src  			: $(this).attr('href'),
				callbacks 		: {
					parseAjax 	: function(r){
						//http://stackoverflow.com/questions/18265294/magnific-popup-ajax-call-for-html-fragment
						var mp 			= $.magnificPopup.instance,
							$trigger	= $(mp.currItem.el[0]),
							fragment	= $trigger.attr('data-fragment');

						if (fragment === undefined){
							r.data = $(r.data);
						} else {
							r.data = $(r.data).filter(fragment);
						}
					}
				},
				removalDelay 	: 500,
				mainClass 		: 'mfp-zoom-in',
				closeBtnInside 	: true
			};
		}

		if (settings.type == 'inline') {
			this.args = {
				type            : 'inline'
			};
		}

		if (settings.type == 'image') {
			this.args = {
				type            : 'image'
			};
		}

		if (settings.type == 'gallery') {
			this.args = {
				type            : 'image',
				gallery         : {
					enabled: true
				}
			};
		}

        $(settings.el).magnificPopup(this.args);

    }
	
    
    /**
     * Method exporter
     * ----------------------------------------------------------- */
    let publicExports = {
        action,
    };

    return Object.assign(Base, publicExports);
};