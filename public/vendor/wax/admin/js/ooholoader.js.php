<?php

$mediaLibrary = new Cms('media_library');
$relativeDir = $mediaLibrary->field('filename')['path'];

$canInsert      = (bool)request('canInsert');
?>

$(document).ready(function(){

    var imagetypes = ["jpg","gif","png","jpeg","svg"];
    var errorfiles = new Array();
    var errormessages = new Array(); //I'm doing this fast, should be done better
    var filepath = '<?php echo $relativeDir; ?>';

    var uploader = new plupload.Uploader({
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
            {title : "Image files", extensions : "jpg,JPG,jpeg,JPEG,gif,GIF,png,PNG"},
            {title : "Zip files", extensions : "zip,ZIP"},
            {title : "Document files", extensions :"doc,DOC,docx,DOCX,odt,ODT,pdf,PDF,xls,XLS,xlsx,XLSX,ppt,PPT,pptx,PPTX"}
        ],
    });
    uploader.bind('Init', function(up, params) {
        document.title = document.title + " (" + params.runtime + " uploader)";
    });
    uploader.init();

    uploader.bind('FilesAdded', function(up, files) {
        var canInsert = <?= $canInsert ? 'true' : 'false'; ?>;
        $("#filelist tr").each(function(){
            if ($(this).text() == "No Items to Display"){
                $(this).remove();
            };
        });
        for (var i in files) {
            var tmpID, tmpStatus, newRow, fileCell, blankCell, statusCell;

            tmpID       = files[i].id;
            tmpStatus   = (jQuery.inArray(tmpID, errorfiles) > -1 ? "Failed" : "Waiting...");
            newRow      = $('<tr />',{
                "data-id" : tmpID,
            });
            fileCell    = $('<td />',{
                "class" : "filename-cell",
                "text"  : files[i].name + " (" + plupload.formatSize(files[i].size) + ")",
            });
            insertCell  = $('<td />',{
                "class" : "insert-cell",
            });
            blankCell   = $('<td />',{
                "text"  : " ",
            });
            statusCell  = $('<td />',{
                "class" : "progress-cell",
                "text"  : tmpStatus,
                css     : {
                    "text-align"    : "center",
                },
            });
            newRow.append(fileCell);
            if(canInsert) {
                newRow.append(insertCell);
            }
            newRow.append(statusCell); //Blank cell was for description, but that's gone now
            $('#filelist > tbody:first').prepend(newRow);
        }
        uploader.start();
    });

    uploader.bind('UploadProgress', function(up, file) {
        var thisRow, statusCell;
        thisRow     = $("[data-id='" + file.id + "']");
        statusCell  = thisRow.find(".progress-cell");
        statusCell.text(file.percent + "%");
    });

    uploader.bind('Error', function(up, err) {
        alert("There was a problem with your upload.\n" + err.message + "\nError Code: " + err.code);
        up.refresh(); // Reposition Flash/Silverlight
    });

    uploader.bind('FileUploaded', function(up, file, response) {
        var canInsert = <?= $canInsert ? 'true' : 'false'; ?>;
        var thisRow, fileCell, statusCell;
        var tmpObj, thumbURL, tmpFullFile, tmpFile, thumbnail;
        var modalLink, modalIframe;
        var thisCheck;

        thisRow     = $("[data-id='" + file.id + "']");
        fileCell    = thisRow.find(".filename-cell");
        statusCell  = thisRow.find(".progress-cell");
        statusCell.empty();

        tmpObj      = jQuery.parseJSON(response.response);
        tmpFullFile = tmpObj.fullfilename.toString();
        tmpFile     = tmpObj.filename.toString();
        thumbURL    = "/vendor/wax/admin/js/upload/processImage.php?action=thumbnail&maxX=50&maxY=50&path=" + tmpFullFile;
        thumbnail   = $("<img />",{
            src     : thumbURL,
            css     : {
                "padding-right" : "5px",
                "vertical-align": "middle",
            },
        });
        modalLink   = $("<a />", {
            "data-full" : tmpFullFile,
        });
        modalIframe = $("<iframe />",{
            src     : tmpFullFile,
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
        $.post("/admin/media",{filename: tmpFile}, function(response){
            var res     = jQuery.parseJSON(response);
            thisCheck   = $("<input />",{
                "type"  : "checkbox",
                "id"    : "selection[]",
                "name"  : "selection[]",
                "value" : res.ID,
            });
            statusCell.empty().append(thisCheck);

        });
        if(canInsert) {
            var insertLink = $('<a />',{
                "data-action" : "choose-file",
                "data-property-file" : tmpFullFile,
                "text" : "Insert"
            });
            thisRow.find(".insert-cell").append(insertLink);
        }
        modalLink.append(thumbnail).append(tmpFile);
        fileCell.empty().append(modalLink);
    });
});
