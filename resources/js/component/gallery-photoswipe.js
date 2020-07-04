/**
 * Gallery - Photoswipe
 * ================================
 *
 * Description:  An image gallery implemented with the Photoswipe javascript library.
 *
 * Instructions: Gallery container element must be the parent node of <a> elements
 *               that link to the full-size version of the thumbnail image. The anchor contains
 *               a child <img> tag. Markup to be used for the full-size image caption should be a child
 *               element of the <a> tag and include the selector specified in settings.titleEl. The <a>
 *               element must contain a data-size attribute with the width and height of the full size image.
 *
 *               Example:
 *                        <div data-element="gallery-photoswipe">
 *                            <a href="/path/to/full/image.jpg" data-size="640x480">
 *                               <img src="/path/to/thumb.jpg" alt="Thumnail Image">
 *                               <div data-element="title">Image Caption</div>
 *                            </a>
 *                            [...]
 *                        </div>
 *
 *               The template for the photoswipe full-image UI is in /Templates/includes/photoswipe-element.php
 *               and must be included on the same page as the gallery.
 *
 *
 * Parameters:
 *               el:       [data-action="gallery-photoswipe"]         // Anchor elements that trigger scroll when clicked
 *               titleEl:  [data-element="title"]                     // Markup to be used in full-size caption
 **/
import Base from 'component/base'
import PhotoSwipe from  'vendor/photoswipe'
import PhotoSwipeUi from 'vendor/photoswipe-ui-default'

export default function GalleryPhotoSwipeFactory(args) {
    /**
         * Plugin defaults / Base constructor
         * ----------------------------------------------------------- */
    const DEFAULT = {
        name: 'Gallery - Photoswipe',
        el: '[data-action="gallery-photoswipe"]',
        titleEl: '[data-element="title"]',
    };

    let settings = Base.construct(DEFAULT, args)

    /**
     * Private and public methods
     * ----------------------------------------------------------- */
    let action = function() {

        let initPhotoSwipeFromDOM = function(gallerySelector) {

            // parse slide data (url, title, size ...) from DOM elements (links)
            let parseThumbnailElements = function(el) {
                let thumbElements = el.childNodes,
                    numNodes = thumbElements.length,
                    items = [],
                    childElements,
                    thumbnailEl,
                    size,
                    item;

                for (let i = 0; i < numNodes; i++) {
                    el = thumbElements[i];

                    // include only element nodes
                    if (el.nodeType !== 1) {
                        continue;
                    }

                    let linkEl

                    if (el.children[0].tagName.toUpperCase() == 'A') {
                        linkEl = el.children[0]
                    } else {
                        linkEl = el
                    }

                    childElements = linkEl.children;

                    size = linkEl.getAttribute('data-size').split('x');

                    // create slide object
                    item = {
                        src: linkEl.getAttribute('href'),
                        w: parseInt(size[0], 10),
                        h: parseInt(size[1], 10),
                    };

                    if(el.children.length > 1) {
                        // <figcaption> content
                        item.title = el.children[1].innerHTML; 
                    }

                    if(linkEl.children.length > 0) {
                        // <img> thumbnail element, retrieving thumbnail url
                        item.msrc = linkEl.children[0].getAttribute('src');
                    }

                    item.el = linkEl; // save link to element for getThumbBoundsFn

                    items.push(item);
                }

                return items;
            };

            // find nearest parent element
            let closest = function closest(el, fn) {
                return el && (fn(el) ? el : closest(el.parentNode, fn));
            };

            // triggers when user clicks on thumbnail
            let onThumbnailsClick = function(e) {
                e = e || window.event;
                e.preventDefault ? e.preventDefault() : e.returnValue = false;

                let eTarget = e.target || e.srcElement;

                let clickedListItem = closest(eTarget, function(el) {
                    return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
                });

                if (!clickedListItem) {
                    return;
                }

                let clickedGallery = clickedListItem.parentNode;

                let childNodes = clickedListItem.parentNode.childNodes,
                    numChildNodes = childNodes.length,
                    nodeIndex = 0,
                    index;

                for (let i = 0; i < numChildNodes; i++) {
                    if (childNodes[i].nodeType !== 1) {
                        continue;
                    }

                    if (childNodes[i] === clickedListItem) {
                        index = nodeIndex;
                        break;
                    }

                    nodeIndex++;
                }

                if (index >= 0) {
                    openPhotoSwipe(index, clickedGallery);
                }

                return false;
            };

            // parse picture index and gallery index from URL (#&pid=1&gid=2)
            let photoswipeParseHash = function() {
                let hash = window.location.hash.substring(1),
                params = {};

                if (hash.length < 5) {
                    return params;
                }

                let vars = hash.split('&');
                for (let i = 0; i < vars.length; i++) {
                    if (!vars[i]) {
                        continue;
                    }

                    let pair = vars[i].split('=');
                    if (pair.length < 2) {
                        continue;
                    }

                    params[pair[0]] = pair[1];
                }

                if (params.gid) {
                    params.gid = parseInt(params.gid, 10);
                }

                return params;
            };

            let openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
                let pswpElement = document.querySelectorAll('.pswp')[0],
                    gallery,
                    options,
                    items;

                items = parseThumbnailElements(galleryElement);

                // define options (if needed)
                options = {
                    index: index,
                    fullscreenEl: false,
                    shareEl: false,

                    // define gallery index (for URL)
                    galleryUID: galleryElement.getAttribute('data-pswp-uid'),

                    getThumbBoundsFn: function(index) {
                        // See Options -> getThumbBoundsFn section of docs for more info

                        let thumbnail = items[index].el.children[0],
                            pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                            rect = thumbnail.getBoundingClientRect();

                        return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
                    },

                };

                if(fromURL) {
                    if(options.galleryPIDs) {
                        // parse real index when custom PIDs are used 
                        // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                        for(var j = 0; j < items.length; j++) {
                            if(items[j].pid == index) {
                                options.index = j;
                                break;
                            }
                        }
                    } else {
                        // in URL indexes start from 1
                        options.index = parseInt(index, 10) - 1;
                    }
                } else {
                    options.index = parseInt(index, 10);
                }

                if( isNaN(options.index) ) {
                    return;
                }

                if (disableAnimation) {
                    options.showAnimationDuration = 0;
                }

                // Pass data to PhotoSwipe and initialize it
                gallery = new PhotoSwipe(pswpElement, PhotoSwipeUi, items, options);
                gallery.init();
            };

            // loop through all gallery elements and bind events
            let galleryElements = document.querySelectorAll(gallerySelector);
            for (let i = 0, l = galleryElements.length; i < l; i++) {
                galleryElements[i].setAttribute('data-pswp-uid', i+1);
                galleryElements[i].onclick = onThumbnailsClick;
            }

            // Parse URL and open gallery if it contains #&pid=3&gid=1
            let hashData = photoswipeParseHash();
            if (hashData.pid && hashData.gid) {
                openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
            }
        };

        // execute above function
        initPhotoSwipeFromDOM(settings.el);
    };

    /**
     * Method exporter
     * ----------------------------------------------------------- */
    let publicExports = {
        action,
    };

    return Object.assign(Base, publicExports);
};
