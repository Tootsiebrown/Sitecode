<?php

use App\Wax\Admin\Cms\Cms;
use Wax\Admin\Session\WaxSession as Session;

header("Content-type: application/x-javascript");

$session = new Session;
$session->requirePrivilege('Social - Post', true);
$cms = new Cms('social_modules');
//only get logged in modules... (psych!)
//$params = 'WHERE access_token != "" AND access_token_secret != ""';
//$params = 'WHERE access_token != ""';
$_social['modules'] = $cms->getRecords();
foreach($_social['modules'] as $key => $module) {
    require_once(DOCUMENT_ROOT . '/includes/modules/SocialModules/' . $module['key'] . '.php');
    $modName = "\SocialModules\\".$module['key'];
    $_social['modules'][$key]['object'] = new $modName($module);
}

$mediaLibrary = new Cms('media_library');
$media_path = $mediaLibrary->field('filename')['path'];

?>

var WEBSITE_URL = '<?php echo URL::to('/'); ?>';
var MEDIA_PATH = '<?php echo $media_path; ?>';

/*
 * 1. SocialBox
 *  1.1. showThumbnailModal
 *  1.2. Revert
 *  1.3. changeImage
 *  1.4. removeImage
 *  1.5. addImageToLibrary
 *  1.6. initEvents
 *  1.7. init
 *
 * 2. ImageUploadModal
 *  2.1. Init
 *  2.2. initModal
 *  2.3. initEvents
 *  2.4. Tabs
 *  2.5. Selection Persistence
 *  2.6. Runtime
 *
 * 3. File Manager
 *
 * 4. Tooltip
 *
 * 5. Page Init
 *  5.1. toggleSubmitAll
 *
 * 6. Isotope Extension.
 */
var OOH = OOH || {};
/* 1. SocialBox
======================================================================================= */
OOH.SocialBox = function(service, formel){
    this.Service        = service;
    this.FormEl         = formel;
//  this.Target         = this.FormEl.attr("action");
    this.textInput      = this.FormEl.find(".primary");
    this.StatusEl       = this.FormEl.find(".status");
//  this.loggedin       = this.FormEl.data("loggedin");
//  this.loginButton    = this.FormEl.find(".login-button")
    this.Special        = {};

    this.isSubmittable  = true;
    this.ImageUploadModal = null;
    this.FileEl     = this.FormEl.find("#"+service+"-filename");
    this.origfile   = this.FormEl.find("#"+service+"-filename").val() || null;

    var _self       = this,
        action      = this.FormEl.attr("action"),
        currentfile = "";

    //check whether to hide

    switch(service){
        <?php
            foreach($_social['modules'] as $module){
                $module['object']->drawJsCase();
            }
        ?>


        default:
            //alert('Service: '+service);
            break;
    };


    this.FormEl.submit(function(e){
        if(_self.FormEl.attr('data-submitted') == 'false'){
            var formdata =  _self.FormEl.serialize();


            switch(service){
            <?php
                foreach($_social['modules'] as $module){
                    if(method_exists($module['object'], 'drawJsValidate'))
                        $module['object']->drawJsValidate();
                }
            ?>
            }

            _self.StatusEl.addClass('submitting').show()
                .find("*").hide();
            _self.StatusEl.find('.status-inner').show().find(".loading").show().css('display','block');
            //_self.FormEl.find('.form-proper').animate({opacity:.5});
            _self.FormEl.attr('data-submitted','true');
            $.ajax({
                type    : 'POST',
                url     : action,
                data    : formdata,
                context : $(this),
                complete : function(data){

                    if(!jQuery.isPlainObject(data))
                        try{
                            data = jQuery.parseJSON(data);
                        }
                        catch(err){
                            data = jQuery.parseXML(data.responseText);
                        }

                    else if(data.responseText != ''){
                        console.log(data);
                        try{
                            data = jQuery.parseJSON(data.responseText);
                            console.log('json');
                        }
                        catch(err){
                            try{
                                data = jQuery.parseXML(data.responseText);
                                console.log('xml');
                                data.error = $(data).find('error').text();
                            }
                            catch(err){
                                data.error = 'could not parse response';
                                console.log('bad');
                            }
                        }
                        console.log(data.error);
                    }

                    if( typeof data == 'object' && typeof data.error != 'undefined' && data.error != 0){
                        _self.StatusEl.find("*").hide();
                        _self.StatusEl.find('.status-inner').show().find(".failure").show();
                        _self.FormEl.attr('data-submitted','false');
                        if(typeof data.error_code != 'undefined' && data.error_code == 1){
                            _self.FormEl.find('.form-meta').hide();
                            _self.FormEl.find('.form-proper').hide();
                            _self.FormEl.find('.ooh-social-profile').hide();
                            _self.FormEl.find('.ooh-login').show();
                            _self.FormEl.attr('data-loggedin','0');
                        }
                        if(typeof data.error_code != 'undefined'){
                            alert(data.error);
                        }
                        setTimeout(function(){
                            _self.StatusEl.hide();
                        },4000);

                    }else{
                        _self.StatusEl.find("*").hide();
                        _self.StatusEl.find('.status-inner').show().find(".success").show();
                        setTimeout(function(){
                            _self.StatusEl.fadeTo(1000,0,function(){
                                _self.StatusEl.find(".success").hide();
                                _self.StatusEl.removeClass('submitting');
                                _self.FormEl.attr('data-submitted','false');
                                _self.FormEl.find('input[type="text"]').val('');
                                _self.FormEl.find('textarea').val('');
                                _self.removeImage();
                            });
                        },4000);
                    }

                },
                error   : function(jqXHR, textStatus, errorThrown){
                    _self.StatusEl.find("*").hide();
                    _self.StatusEl.find('p.failure').html('There was an error. Please try logging out completely and then logging in again.');
                    _self.StatusEl.find('.status-inner').show().find(".failure").show();

                    //more handling info goes here.

                    setTimeout(function(){
                        _self.FormEl.attr('data-submitted','false');
                        //_self.StatusEl.hide();
                    },4000);

                }
            });
            e.preventDefault();
        }else{
            // do nothing... it's already been submitted
            e.preventDefault();
        }
    });
/* 1.1. showThumbnailModal
----------------------------------------------------------------------- */
    function showThumbnailModal(){
        var social_key = _self.FormEl.attr('data-key');
        /*$('#'+social_key+'-full-img-modal').modal({
            "overlayClose": true,
            "containerCss": {
                "borderWidth" : 2,
                "height"        : '80%',
                "maxWidth"  : '80%'
            }
        });*/
    }
/* 1.2. Revert
----------------------------------------------------------------------- */
    this.revert = function(){
        _self.FileEl.val(_self.origfile);
    };
/* 1.3. changeImage
----------------------------------------------------------------------- */
    this.changeImage = function(imgsrc){
        currentfile = imgsrc;
        _self.FormEl.find('.social-image').css('visibility','visible').attr('src',imgsrc);
        $("#"+ _self.Service + "-social-image-url a").css('visibility','visible').text(imgsrc);
        _self.FormEl.find('.social-image-remove').show();
        _self.FormEl.find('.social-image-upload').hide();
        _self.FormEl.find('.faux-file-button').hide();
        _self.FileEl.val(imgsrc);
    };
/* 1.4. removeImage
----------------------------------------------------------------------- */
    function removeImage(){
        currentfile = null;
        _self.FormEl.find('.social-image').css('visibility','hidden');
        $("#"+ _self.Service + "-social-image-url a").css('visibility','hidden');
        _self.FormEl.find('.social-image-remove').hide();
        _self.FormEl.find('.social-image-upload').show();
        _self.FormEl.find('.faux-file-button').show();
        _self.FileEl.val('');
    }

    this.removeImage = removeImage;

/* 1.5 addImageToLibrary
----------------------------------------------------------------------- */
    this.addImageToLibrary = function(filename){
        if(typeof filename == 'undefined'){
            return false
        }
        $.ajax({
            type    : 'POST',
            url     : '/vendor/wax/admin/ajax/add_file.php',
            data    : 'filename='+filename,
            context : $(this),
            complete : function(data){
                // awesome.
                // console.log(data.response);
            },
            error   : function(jqXHR, textStatus, errorThrown){
                // bummer.
            }
        });
    }

/* 1.6. initEvents
----------------------------------------------------------------------- */
    function initEvents(){
        //Create image upload modal on click
        _self.FormEl.on("click.OOH.SocialBox",'.social-image-change', function(e){
            _self.ImageUploadModal = OOH.ImageUploadModal($(this), _self);
        });
        //Image thumbnail click -> full screen modal
        _self.FormEl.on("click.OOH.SocialBox",".social-full-image-trigger",showThumbnailModal);
        //The styled "Upload" button in the social box (not the modal)
        _self.FormEl.on("click.OOH.SocialBox",".faux-file-button", function(){
            _self.FormEl.find('.real-file-button').trigger('click');
        });
        //Remove Image button
        _self.FormEl.on("click.OOH.SocialBox",".social-image-remove", removeImage);
        //Toggle Submittable status and SHARE button (explicitly stated to ensure things don't somehow get out of sync)
        _self.FormEl.on("click.OOH.SocialBox",'[name="shareable"]', function(){
            var $thissubmit = _self.FormEl.find("input[type='submit']");
            if ($(this).is(':checked')){
                _self.isSubmittable = true;
                $thissubmit.removeAttr('disabled');
            } else {
                _self.isSubmittable = false;
                $thissubmit.attr('disabled','disabled');
            }
            $(document).trigger('OOH.Page.toggleSubmitAll');
        });

        //When a new image has been uploaded.
        $('#'+_self.Service+'-filename-manual_output').bind('fileAdded', function() {
            // depends on custom event not in stock cmsupload.js
            var filename = $(this).find('input').val();
            var full_image_url = WEBSITE_URL+MEDIA_PATH+'/'+filename;
            _self.changeImage(full_image_url);
            _self.addImageToLibrary(filename);

        });

    }
/* 1.7. init
----------------------------------------------------------------------- */
    this.init = function(){
        //Get proper character count for "Characters Remaining"
        _self.FormEl.find('input[type="text"]').trigger('keyup');
        _self.FormEl.find('textarea').trigger('keyup');//initialize the upload button
        $('#'+_self.Service+'-filename-manual').cmsupload({"id":_self.Service+'-filename-manual',"uploadPath":MEDIA_PATH,"prefix":"","maxImages":1,"overwrite":false,"values":[""],"allowedExtensions":["jpeg","jpg","png","gif"]});
        initEvents();
    }

    this.init();
};
/* 2. ImageUploadModal
======================================================================================= */
OOH.ImageUploadModal = function(linkEl, parentObj, selectedImage){
    this._parent    = parentObj || null;
    this.selectedImage = selectedImage || null;
    this.$form      = linkEl.closest('form');
    this.$modal     = this.$form.find('.social-image-container');

    var _self       = this,
        key         = this.$form.attr('data-key'),
        currentimg  = null,
        modalArgs   = {
            opacity     : 0,
            appendTo    : 'body',
            autoPosition: true,
            autoResize  : true,
            focus       : false,
            overlayClose: false,
            escClose    : false,
            persist     : true,
            containerCss: {
                borderWidth : 2,
                maxHeight   : '80%',
                width       : '80%',
            },
            onShow      : function(){
                $modalEls = initModal(); //Get modal controls for events
                initModalTabs();
            },
        },
        modalObj    = null,
        $modalEls   = {};
/* 2.1. Init
----------------------------------------------------------------------- */
    this.init = function(){
        modalObj = _self.$modal.modal(modalArgs);
        initEvents($modalEls);
        return this;
    };

/* 2.2. initModal
----------------------------------------------------------------------- */
    function initModal(){
        var $thisEl = {
            filename_dummies    : $(".image_picker"),

            ok          : '[name="ok_'+key+'"]',
            upload      : '[name="upload_'+key+'"]',
            cancel      : '[name="cancel_'+key+'"]',
            cancelEl    : $('[name="cancel_'+key+'"]'),
            status      : $('.image-selected-status'),
            statusImg   : $('.image-selected-status img'),
            statusFile  : $('.image-selected-status .filename')
        };

        var current_filename    = _self._parent.FileEl.val();
        //Ajax-load file manager images.
        var filemgr = new OOH.FileManager({
            "domEl"     : _self.$modal,
            "filename"  : current_filename,
            "key"       : key,
            "parentObj" : _self
        });

        _self.imagePickerIsotopeChain($thisEl.filename_dummies);


        // initialize the status section
        $thisEl.statusImg.attr('src',current_filename);
        $thisEl.statusFile.html(current_filename.replace(/^.*[\\\/]/, ''));
        // initialize the cancel element with the proper data
        $thisEl.cancelEl.data('current_img', $thisEl.filename_dummies.val());

        return $thisEl;
    }
/* 2.3. initEvents
----------------------------------------------------------------------- */
    function initEvents(controls){
        //Cancel
        _self.$modal.on("click.OOH.ImageUploadModal", controls.cancel, function(){
            _self._parent.revert();
            modalObj.close();
        });
        //OK
        _self.$modal.on("click.OOH.ImageUploadModal", controls.ok, function(){
            _self._parent.changeImage(_self.currentimg);
            modalObj.close();
        });
        //Image change
        _self.$modal.on("change.OOH.ImageUploadModal", "select", function(e){
            if ( $(this).val() != "" ){
                _self.currentimg = $(this).val();
            }
        });
        //Upload
        _self.$modal.on("click.OOH.ImageUploadModal", controls.upload, function(e){
            e.stopImmediatePropagation();
            _self.$form.find('.social-image-remove').trigger('click');
            _self.$form.find('.real-file-button').trigger('click');
            modalObj.close();
        });
        // various display
        _self.$modal.css('height','100%'); //necessary to fix current safari issue. height is set to 80% in css.
        //Resize
        $(window).on("resize.OOH.ImageUploadModal",function() {
            $('.simplemodal-wrap').height($('#simplemodal-container').height()); // dunno why this is needed, but it is.
            $(window).trigger('resize.simplemodal');
        }).trigger('resize.OOH.ImageUploadModal');
        //Hover over images
        _self.$modal.on("mouseenter.OOH.ImageUploadModal",".thumbnail",function(){
            var imgsrc  = decodeURIComponent($(this).find("img").attr("src").split("path=")[1]);
            //var thisimg = $(this).find("img").attr("src").replace(/^.*[\\\/]/, '');
            var tmpmsg = new OOH.Tooltip($(this),imgsrc);
        });
    }
/* 2.4. Tabs
----------------------------------------------------------------------- */
    function initModalTabs(){

        if(typeof _self._parent.activeTab === 'undefined') _self._parent.activeTab = 'attached';
        if(_self.$modal.find('[name="attached"]').is(':disabled')) _self._parent.activeTab = 'filemanager';

        _self.attached_tab = {
            "tabKey"    : "attached",
            "button"    : _self.$modal.find('.attached_images_button'),
            "content"   : _self.$modal.find('.attached-images-container'),
            "tab"       : _self.$modal.find('.attached_images_button').parent(),
        }

        _self.filemanager_tab = {
            "tabKey"    : "filemanager",
            "button"    : _self.$modal.find('.filemanager_images_button'),
            "content"   : _self.$modal.find('.filemanager-images-container'),
            "tab"       : _self.$modal.find('.filemanager_images_button').parent(),
        }


        switch(_self._parent.activeTab){
            case 'attached':
                _self.attached_tab.content.show();
                _self.filemanager_tab.content.hide();
                _self.attached_tab.tab.addClass('active');
                break
            case 'filemanager':
                _self.attached_tab.content.hide();
                _self.filemanager_tab.content.show();
                _self.filemanager_tab.tab.addClass('active');
                break;
        }


        _self.attached_tab.button.on('click', function(){
            toggleTabs(_self.attached_tab, _self.filemanager_tab);
        });
        _self.filemanager_tab.button.on('click', function(){
            toggleTabs(_self.filemanager_tab, _self.attached_tab);
        });
    }

    function toggleTabs(clicked, other){
        if(clicked.tabKey == _self._parent.activeTab){
            return;
        }
        // set up the clicked properties

        _self._parent.activeTab = clicked.tabKey;
        clicked.content.show();
        clicked.tab.addClass('active');

        // set up the "other" properties
        other.tab.removeClass('active');
        other.content.hide();

        // re-init the image picker & isotope.
        clicked.content.find('ul').remove();
        _self.imagePickerIsotopeChain(clicked.content.find('select'));
    }

/* 2.5 Selection Persistence
----------------------------------------------------------------------- */
    this.imagePickerIsotopeChain = function($select){
    $select.imagepicker({show_label: true});
    var container = $select.parent().find("ul.thumbnails");
    container.imagesLoaded(function(){
        container.isotope({
            itemSelector:   "li",
            isFitWidth:     true,
            filter: ':not(:first-child)'
        });
        $.modal.setContainerDimensions();
        $select.val(_self._parent.FileEl.val());
        $select.trigger('change');
    });
}


/* 2.6. Runtime
----------------------------------------------------------------------- */
    this.init();
};

/* 3. File Manager
======================================================================================= */
OOH.FileManager = function(args){
    this.thispage   = 1;
    this.lastpage   = 1;
    this.domEl      = args.domEl;
    this._parent    = args.parentObj;

    var _self       = this,
        key         = args.key,
        start       = args.start || 0,
        perpage     = args.perpage || 10,
        filename    = args.filename,
        thisselect  = _self.domEl.find('[name="' + key + '-filename-dummy-filemanager"]'),
        domEl       = thisselect.parent();

    function createPaginationTable(thispage, lastpage){
        var nav = [     "<table class='pagination'>",
                            "<tr>",
                                "<td class='prev'><input type='button' class='link' value='&lt;' /></td>",
                                "<td class='current-page'>Page " + thispage + " of " + lastpage + "</td>",
                                "<td class='next'><input type='button' class='link' value='&gt;' /></td>",
                            "</tr>",
                        "</table>"
                    ].join('\n');
        return nav;
    }
    function insertFileManagerPagination(domEl){
        var task        = $.Deferred(),
            mediaArgs   = {
            'info'      : 'numRecords',
            'per_page'  : perpage,
        };
        if (filename.length > 0){mediaArgs.filename = encodeURIComponent(filename.replace(/^.*[\\\/]/, ''));}
        $.ajax({
            type    : 'POST',
            url     : '/vendor/wax/admin/ajax/dashboard.mediaLibrary.php',
            data    : mediaArgs,
            success : function(data){
                var results     = jQuery.parseJSON(data);
                    //start         = results.page || start;

                _self.lastpage  = (Math.floor(results.numRecords / perpage) + 1);
                _self.thispage  = ($.type(results.page) != "null" ? results.page : start + 1);
                if($.type(_self.thispage) == "undefined"){_self.thispage = start + 1};
                    pagerEl     = $("<p />",{
                        "text" : "Page "+ _self.thispage + " of " + _self.lastpage
                    });
                    if (!domEl.find(".pagination").is("*")){
                        domEl.append(createPaginationTable(_self.thispage, _self.lastpage));
                    } else {
                        _self.domEl.find(".current-page").text("Page "+ _self.thispage + " of " + _self.lastpage);
                    }
                task.resolve();
            }
        });
        return task.promise();
    }
    function insertFileManagerSelect(start, perpage, domEl){
        var task = $.Deferred();
        $.ajax({
            type    : 'POST',
            url     : '/vendor/wax/admin/ajax/dashboard.mediaLibrary.php',
            data    : {
                'info'      : 'options',
                'offset'    : start * perpage,
                'number'    : perpage
            },
            success : function(data){
                domEl.empty().html(data);
                task.resolve();
            }
        });
        return task.promise();
    }

    function drawFileManagerPage(start, perpage, domEl){
        $.when(insertFileManagerSelect(start, perpage, thisselect)).then(function(){
            _self._parent.imagePickerIsotopeChain(thisselect);
        });
        _self.domEl.find(".current-page").text("Page "+ _self.thispage + " of " + _self.lastpage);
    }

    $.when(insertFileManagerPagination(thisselect.parent())).then(function(){
        drawFileManagerPage(_self.thispage - 1, perpage, thisselect);
    });

    domEl.on('click','.next', function(){
        if (_self.thispage < _self.lastpage){
            _self.thispage = _self.thispage + 1;
            drawFileManagerPage(_self.thispage - 1, perpage, thisselect);
        }
    });
    domEl.on('click','.prev', function(){
        if (_self.thispage > 1){
            _self.thispage = _self.thispage - 1;
            drawFileManagerPage(_self.thispage - 1, perpage, thisselect);
        }
    });
}

/* 4. Tooltip
======================================================================================= */
OOH.Tooltip = function(domEl, message){
    var _self   = this,
        domEl   = domEl || $("body"),
        msg;
    function create(){
        msg = $("<div />",{
            "html" : message,
            "class": "ooh-tooltip"
        });
        $("body").append(msg);
        msg.fadeOut(0).delay(750).fadeIn(150);
    }
    function follow(event){
        //ie gets screenleft and screentop
        var tmpheight = $(window).height();
        var tmpx    = event.pageX;
        var tmpy    = event.pageY - $(window).scrollTop();
        var toppos    = tmpy + 16;

        msg.css({
            "left"  : tmpx + 16,
            "top"   : toppos
        });
    }
    function destroy(){
        msg.stop(true, true).fadeOut(100, function(){
            msg.remove();
            _self = null;
        });
    }
    this.init = function(){
        create();
        domEl.mousemove(function(e){
            follow(e);
        }).mouseleave(function(){
            destroy();
        });
        domEl.on("click", destroy);
    }
    this.init();
}
/* 5. Page Init
======================================================================================= */
OOH.Page = {};  //Start page functions & vars off blank

/* 5.1. toggleSubmitAll
----------------------------------------------------------------------- */
$(document).bind('OOH.Page.toggleSubmitAll', function(){
//Schrodinger's checklist
    var $submitAll  = $('#one_submit_to_rule_them_all'),
        allchecked  = true,
        nonechecked = true,
        submitmsg   = "Submit All";
        $.each(OOH.Page.SocialBoxList, function(){
            if (this.isSubmittable){
                nonechecked = false;
            } else {
                allchecked = false;
            }
        });
    if (!allchecked){submitmsg = "Submit Checked";}
    if (nonechecked){
        $submitAll.attr('disabled','disabled');
    } else {
        $submitAll.removeAttr('disabled');
    }
    $submitAll.val(submitmsg);
});
/* 5.2. Runtime
----------------------------------------------------------------------- */
$(document).ready(function(){
    OOH.Page.SocialBoxList = {
        "tweet"     : new OOH.SocialBox("Twitter",  $("#Twitterbox")),
        "facebook"  : new OOH.SocialBox("Facebook", $("#Facebookbox")),
        "linkedin"  : new OOH.SocialBox("LinkedIn", $("#LinkedInbox")),
        //"instagram" : new OOH.SocialBox("Instagram",$("#instagram"));
    };

    $('#one_submit_to_rule_them_all').on('click', function(e){
        $('form.ooh-socialbox').each(function(index,element){
            if($(this).find('[name="shareable"]').prop('checked')){
                $(this).submit();
            }
        });
        e.preventDefault();
    });
});


/* 6. Isotope Extension for centering.
======================================================================================= */
$.Isotope.prototype._getCenteredMasonryColumns = function() {
    this.width = this.element.width();

    var parentWidth = this.element.parent().width();

                  // i.e. options.masonry && options.masonry.columnWidth
    var colW = this.options.masonry && this.options.masonry.columnWidth ||
                  // or use the size of the first item
                  this.$filteredAtoms.outerWidth(true) ||
                  // if there's no items, use size of container
                  parentWidth;

    var cols = Math.floor( parentWidth / colW );
    cols = Math.max( cols, 1 );

    // i.e. this.masonry.cols = ....
    this.masonry.cols = cols;
    // i.e. this.masonry.columnWidth = ...
    this.masonry.columnWidth = colW;
};

$.Isotope.prototype._masonryReset = function() {
    // layout-specific props
    this.masonry = {};
    // FIXME shouldn't have to call this again
    this._getCenteredMasonryColumns();
    var i = this.masonry.cols;
    this.masonry.colYs = [];
    while (i--) {
      this.masonry.colYs.push( 0 );
    }
};

$.Isotope.prototype._masonryResizeChanged = function() {
    var prevColCount = this.masonry.cols;
    // get updated colCount
    this._getCenteredMasonryColumns();
    return ( this.masonry.cols !== prevColCount );
};

$.Isotope.prototype._masonryGetContainerSize = function() {
    var unusedCols = 0,
        i = this.masonry.cols;
    // count unused columns
    while ( --i ) {
        if ( this.masonry.colYs[i] !== 0 ) {
            break;
        }
      unusedCols++;
    }

    return {
        height : Math.max.apply( Math, this.masonry.colYs ),
        // fit container to columns that have been used;
        width : (this.masonry.cols - unusedCols) * this.masonry.columnWidth
    };
};


$(function(){

    var $container = $('#container');


    // add randomish size classes
    $container.find('.element').each(function(){
        var $this = $(this),
            number = parseInt( $this.find('.number').text(), 10 );
        if ( number % 7 % 2 === 1 ) {
            $this.addClass('width2');
        }
        if ( number % 3 === 0 ) {
            $this.addClass('height2');
        }
    });

    $container.isotope({
        itemSelector : '.element',
        masonry : {
            columnWidth : 120
        },
        getSortData : {
            symbol : function( $elem ) {
                return $elem.attr('data-symbol');
            },
            category : function( $elem ) {
                return $elem.attr('data-category');
            },
            number : function( $elem ) {
                return parseInt( $elem.find('.number').text(), 10 );
            },
            weight : function( $elem ) {
                return parseFloat( $elem.find('.weight').text().replace( /[\(\)]/g, '') );
            },
            name : function ( $elem ) {
                return $elem.find('.name').text();
            }
        }
    });


    var $optionSets = $('#options .option-set'),
        $optionLinks = $optionSets.find('a');

    $optionLinks.click(function(){
        var $this = $(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
            return false;
        }
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');

        // make option object dynamically, i.e. { filter: '.my-filter-class' }
        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
            // changes in layout modes need extra logic
            changeLayoutMode( $this, options )
        } else {
            // otherwise, apply new options
            $container.isotope( options );
        }

        return false;
    });



    $('#insert a').click(function(){
        var $newEls = $( fakeElement.getGroup() );
        $container.isotope( 'insert', $newEls );

        return false;
    });

    $('#append a').click(function(){
        var $newEls = $( fakeElement.getGroup() );
        $container.append( $newEls ).isotope( 'appended', $newEls );

        return false;
    });



    // change size of clicked element
    $container.delegate( '.element', 'click', function(){
        $(this).toggleClass('large');
        $container.isotope('reLayout');
    });

      // toggle variable sizes of all elements
    $('#toggle-sizes').find('a').click(function(){
        $container
          .toggleClass('variable-sizes')
          .isotope('reLayout');
        return false;
    });


    var $sortBy = $('#sort-by');
    $('#shuffle a').click(function(){
        $container.isotope('shuffle');
        $sortBy.find('.selected').removeClass('selected');
        $sortBy.find('[data-option-value="random"]').addClass('selected');
        return false;
    });

});
