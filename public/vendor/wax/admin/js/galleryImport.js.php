<?php

use Illuminate\Support\Facades\File;

$mediaLibrary = new Cms('media_library');
$tmpUploadDir = $mediaLibrary->field('filename')['path'];

$relativeDir    = $tmpUploadDir."/gallery/import/";
$outDir         = $tmpUploadDir."/gallery/";
if(!is_dir(DOCUMENT_ROOT . $relativeDir)) {
    File::makeDirectory(DOCUMENT_ROOT . $relativeDir, config('wax.core.defaultDirectoryMode'), true);
}

?>

$(document).ready(function(){

    var bulkImporter = function(){
        var imagetypes = ["jpg","gif","png","jpeg","svg"];
        var errorfiles = new Array();
        var errormessages = new Array(); //I'm doing this fast, should be done better
        var filepath = '<?php echo $relativeDir; ?>';
        //var $eventNexus = $("#galleryId");
        var $queueTable = $("#filelist");
        var galleryId = $("#galleryId").val();
        // var array of deferreds?

        this.uploader = new plupload.Uploader({
            runtimes : 'html5,flash,silverlight,html4',
            browse_button   : 'pickfiles',
            max_file_size   : '32mb',
            chunk_size      : '<?php
                $max = ini_get("upload_max_filesize");
                echo strtolower(preg_replace('/^([\d]+)([mk]?)$/i', '$1$2b', $max));
            ?>',
            url : '/admin/media/ooholoader-upload',
            flash_swf_url : '/vendor/wax/admin/js/vendor/plupload/Moxie.swf',
            silverlight_xap_url : '/vendor/wax/admin/js/vendor/plupload/Moxie.xap',
            filters : [
                {title : "Image files", extensions : "jpg,JPG,jpeg,JPEG,gif,GIF,png,PNG"}
            ]
        });

        this.uploader.bind('FilesAdded', function(up, files){
            _self.fileDeferreds = new Array();
            _self.filePromises = new Array();
            prepTable();
            addFiles(files); // expects [{name:'',id:'',size:'',},...]

            // I know. This is wrong.
            setTimeout(function(){_self.uploader.start();}, 500);
        });


        this.uploader.bind('UploadProgress', function(up, file) {
            var thisRow, statusCell;
            thisRow     = $("[data-id='" + file.id + "']");
            statusCell  = thisRow.find(".progress-cell");
            statusCell.text(file.percent + "%");
            if(file.percent == 100){
                statusCell.text('processing...');
            }
        });

        this.uploader.bind('Error', function(up, err) {
            up.refresh(); // Reposition Flash/Silverlight
        });

        function prepTable (){
            $queueTable.find("tr").each(function(){
                if ($(this).text() == "No Items to Display"){
                    $(this).remove();
                }
            });
        }

        function addFiles(files){
            for (var i in files) {
                console.log(i);
                initializeQueueRow(files[i].id, files[i].name, files[i].size);
                _self.fileDeferreds[i] = new $.Deferred();
                _self.filePromises[i] = _self.fileDeferreds[i].promise();
            }

            refreshView();

        }

        function initializeQueueRow(fileId, fileName, fileSize){
            var tmpStatus, newRow, fileCell, blankCell, statusCell;
            tmpStatus   = (jQuery.inArray(fileId, errorfiles) > -1 ? "Failed" : "Waiting...");
            newRow      = $('<tr />',{
                "data-id" : fileId
            });
            fileCell    = $('<td />',{
                "class" : "filename-cell",
                "text"  : fileName + " (" + plupload.formatSize(fileSize) + ")"
            });
            statusCell  = $('<td />',{
                "class" : "progress-cell",
                "text"  : tmpStatus,
                css     : {
                    "text-align"    : "center"
                }
            });
            newRow.append(fileCell).append(statusCell);
            $queueTable.find('tbody:last').append(newRow);
        }

        this.uploader.bind('FileUploaded', function(up, file, response) {
            var tmpObj      = jQuery.parseJSON(response.response);
            var tmpFullFile = tmpObj.fullfilename.toString();
            var tmpFile     = tmpObj.filename.toString();

            processFile(file.id, tmpFile, tmpFullFile);
        });

        function processFile(fileId, fileName, fullFilename){ // expects the fileId to match the file.id from _self.addFiles();

            $.post("/admin/cms_edit.php",{structure: 'galleries', action: 'field_method', field: 'bulk_importer', method: 'import', filename: fileName, id: galleryId}, function(response){
                var res     = jQuery.parseJSON(response);
                var tmpFullFile = res.fullfilename.toString();
                var tmpFile     = res.filename.toString();
                $.post("/admin/cms_edit_popup.php", {action: 'save', parentStructure: "galleries.php", structure: 'galleries_images', parentField: 'images', id: 0, gallery_id: galleryId, parentId: galleryId, 'image[]': tmpFile}, function(response){
                    resolveNext(_self.fileDeferreds);
                    clearQueueRowStatus();
                });
            });

            showQueueImage(fileId, fileName, fullFilename);
        }

        function clearQueueRowStatus(fileId){
            $queueTable.find('[data-id="'+fileId+'"] .progress-cell').empty();
        };

        function refreshView(){
            $.when.apply($, _self.filePromises).done(function(){
                $.get('/admin/cms_edit.php', {structure: 'galleries', action: 'field_method', field: 'bulk_importer', method: 'refresh', parentId: galleryId}, function(data){
                    $("#inputContainer_images").closest(".field-container").replaceWith(data);
                    hasPendingChanges();
                    $queueTable.find('tr').slideUp(function(){$(this).remove();});
                    _self.filePromises = new Array();
                    $(document).trigger('modal/gallery/refresh');
                });
            });
        };

        function showQueueImage(fileId, fileName, fullFilename){
            var fileCell = $queueTable.find('[data-id="'+fileId+'"] .filename-cell');
            var statusCell = $queueTable.find('[data-id="'+fileId+'"] .progress-cell');
            var thumbURL    = "/vendor/wax/admin/js/upload/processImage.php?action=thumbnail&maxX=50&maxY=50&path=<?php echo $outDir; ?>" + fileName;
            var thumbnail   = $("<img />",{
                src     : thumbURL,
                css     : {
                    "padding-right" : "5px",
                    "vertical-align": "middle"
                }
            });
            var modalLink   = $("<a />", {
                "data-full" : fullFilename
            });
            var modalIframe = $("<iframe />",{
                src     : fullFilename
            });
            modalLink.on("click", function(e){
                $.modal(modalIframe, {
                    autoResize: true,
                    maxHeight: '90%',
                    maxWidth: '70%',
                    minHeight: '90%',
                    minWidth: '70%',
                    containerCss:{
                        height: '90%',
                        width: '70%',
                        minWidth: '700px'
                    }
                });
                e.preventDefault();
            });
            modalLink.append(thumbnail).append(fileName);
            fileCell.empty().append(modalLink);
        };

        function resolveNext(deferreds){
            for(i in deferreds){
                var state = deferreds[i].state();
                if(state == 'pending'){
                    deferreds[i].resolve();
                    return;
                }
            }
        }

        var _self = this;
        this.uploader.init();
        refreshView();
    };

    thingy = new bulkImporter();
    thingy.uploader.start();
});
