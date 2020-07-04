import 'vendor/magnific-popup/jquery.magnific-popup.min.js'
import QuillEditor from 'component/QuillEditor'

const APP = (function(core, window, document, $) {

    core.ContentSubmit = function ContentSubmit(form) {
        const $form = $(form);
        const $textEditors = $form.find('[data-component="text-editor"]')
        const $saveButton = $form.find('[data-action="save"]')

        $saveButton.on('click', function() {
            $form.append('<input type="hidden" name="action" value="save">');
            createTextAreas();
        })

        function createTextAreas() {
            $textEditors.each((index, element) => {
                const $this = $(element)
                const content = $this[0].__quill.root.innerHTML
                const cleanContent = cleanText(content)
                const id = $this.attr('id')
                const name = $this.attr('name')

                $this.removeAttr('id')
                $this.removeAttr('name')
                $this.append("<textarea id='" + id + "' name='" + name + "' class='visually-hidden'>" + cleanContent + "</textarea>")
            })
            .promise()
            .done( function() {
                $form.submit()
            })
        }

        function cleanText(text) {
            const removeSpace = new RegExp(/(<p>[\s.]*(<br>|&nbsp;|[\s.]*)[\s.]*<\/p>)/g)
            return text.replace(removeSpace, '')
        }
    };

    core.ImageUpload = function ImageUpload() {
        $('.text-editor').each((index, element) => new QuillEditor(element) )
    };


    core.Modal_Gallery = function Modal_Gallery(){
        var s = {
            el : '[data-property="mfp-gallery__item"]'
        };

        var action = function action(){
            var gallery = '[data-property="modal/gallery"]';
            $(s.el).each(function(){
                $(this).parent().attr('data-property','modal/gallery');
            });

            $(gallery).each(function(){
                $(this).magnificPopup({
                    delegate    : s.el,
                    type        : 'image',
                    mainClass   : 'mfp-wax-gallery mfp-zoom-in',
                    removalDelay : 250,
                    gallery     : {
                        enabled             : true,
                        navigateByImgClick  : true,
                        preload             : [1,1]
                    },
                    image: {
                        verticalFit: true,
                    }
                });
            });

            $(document).on('modal/gallery/refresh', function(e){
                action();
            });
        }

        action();
    };

    core.Modal = function Modal(){
        var s = {
            el : '[data-action="modal/ajax"]'
        };

        var action = function action(){
            $(s.el).each(function(){
                $(this).magnificPopup({
                    type : 'iframe',
                    modal : true,
                    mainClass : 'wax-modal-ajax mfp-zoom-in',
                    removalDelay : 250,
                    items :{
                        src : $(this).attr('data-href')
                    }
                });
            });

        };

        var initEvents = function initEvents(){

            $(document).on('modal/gallery/refresh', function(e){
                action();
            });

            $(document).on('modal/close', function(e){
                $.magnificPopup.close();
                $.modal.close();
            });
        };

        action();
        initEvents();
    };

    core.unsavedChanges = () => {
        const $window = $(window);

        var hasPendingChanges = false;

        function bindPendingChangesListener() {
            if (hasPendingChanges === true) {
                return;
            }

            hasPendingChanges = true;

            //TODO: this is breaking with the bulk importer. Its function 'refreshView' calls hasPendingChanges.
            window.addEventListener('beforeunload', function(e) {
                if($(':focus').is('.cancelLeavePageAlert')) {
                    delete e['returnValue'];
                    return true;
                }

                // FireFox likes this
                e.preventDefault();

                // Chrome requires returnValue to be set
                e.returnValue = '';

                return 'There are pending changes on this page that will be discarded if you cancel.';
            });
        }

        $('.inputContainer input, .inputContainer select, .inputContainer textarea').change(bindPendingChangesListener);
        $('#sortable').on('sortchange', bindPendingChangesListener);
        $window.on('pendingChanges', bindPendingChangesListener);
    }

    core.sortable = () => {
        const $sortable = $('#sortable')

        $sortable.sortable()
        $sortable.disableSelection()
    }


    return core;
}) (APP || {}, window, document, jQuery);




var WaxUI = (function(core, window, document, $) {

    core.Hamburger = function Hamburger(){
        var el = '[data-action="hamburger"]';

        var closeMenu = function($el){
            $el.attr('data-property', 'closed');
        }

        var toggleMenu = function($el){
            $el.attr('data-property', $el.attr('data-property') == 'open' ? 'closed' : 'open');
        };

        var initEvents = function(){
            $(document).on('click', el, function(e){
                e.stopPropagation();
                toggleMenu($(this));
            });

            $(document).on('click', function(e){
                closeMenu($(el));
            });
        };

        initEvents();
    }

    return core;
}) (WaxUI || {}, window, document, jQuery);


(function ($) {

    $( document ).ready(function() {
        APP.Modal_Gallery()
        APP.Modal()
        WaxUI.Hamburger()

        $('#cmsEditForm').each((index, element) => {
            APP.ImageUpload()
            APP.ContentSubmit(element)
        });

        APP.sortable()
        APP.unsavedChanges()
    });

}) (jQuery);
