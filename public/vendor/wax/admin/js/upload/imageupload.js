(function ($) {

    $.widget("wax.imageupload", {
        options: {
            clear: null,
            crop: false,
            disk: 'uploads',
            focalPoint: false,
            alt: false,
            // max cropper window image size
            modalImageMaxX: 800,
            modalImageMaxY: 600,
            // aspect ratio
            forceAr: true,
            arX: 4,
            arY: 3,
            ar: (4 / 3),
            // max output size
            outMaxX: 400,
            outMaxY: 300,
            // thumb size
            thumbMaxX: 80,
            thumbMaxY: 80,
            values: [],
            maxImages: 1,
            uploaderUrl: '/admin/media/upload',
            imageCropUrl: '/admin/media/crop',
            uploadPath: '/',
            prefix: '',
            overwrite: false
        },
        id: undefined,
        container: undefined,
        imgCount: 0,
        // Set up the widget
        _create: function () {
            var self = this;

            this.options.ar = this.options.arX / this.options.arY;
            if (this.id == undefined) {
                this.id = this.element.attr('id');
            }

            $(this.element).wrap('<div id="' + this.id + '_container" />');
            $(this.element).attr('name', $(this.element).attr('name') + '_input');
            $(this.element).attr('id', $(this.element).attr('id') + '');

            this.container = $(this.element).parent();

            this.container
                .append('<div id="' + this.id + '_output" />')
                .append('<div style="clear: both;" />')
                .append('<div id="' + this.id + '_error" />')
                .append('<div id="' + this.id + '_progress" />')
                .append('<div id="' + this.id + '_crop" style="display: none;" />');

            $('#' + this.id + '_error').css({ 'color': 'red', 'font-size': '120%', 'margin': '10px 0' }).hide();
            $('#' + this.id + '_progress').css({ 'margin': '4px 0' });

            for (v in this.options.values) {
                var img = self.options.values[v];
                self.addImage(img);
            }
        },
        addImage: function (img) {
            if (typeof img === 'undefined') {
                img = {}
            }

            filename = img.basename;
            w = img.width;
            h = img.height;
            url = img.url;

            if (this.options.maxImages > 0 && this.imgCount == this.options.maxImages) {
                $('#' + this.id + '_output > div:first').remove();
                this.imgCount--;
            }

            var thumbSize = this.fit(w, h, this.options.thumbMaxX, this.options.thumbMaxY);

            var node = $('<div style="margin: 8px; float: left;" />');

            var fileInput = $('<input type="hidden" />');
            fileInput.attr("name", this.id + '[' + this.imgCount + '][filename]');
            fileInput.val(filename);
            node.append(fileInput);

            var thumb = $('<img />');
            thumb.attr("src", url);
            thumb.attr("width", thumbSize.w);
            thumb.attr("height", thumbSize.h);
            thumb.attr('data-url', url);
            thumb.attr('data-src', this.options.uploadPath + this.options.prefix + filename);
            thumb.attr('data-width', w);
            thumb.attr('data-height', h);
            node.append(thumb);

            node.append('<a data-action="remove" style="position: absolute;" href="#" onclick="if(confirm(\'Delete image?\')) $(\'#' + this.element.attr('id') + '\').imageupload(\'removeImage\', $(this).parent()); return false;">X</a><br />');

            if (this.options.crop) {
                node.append('<a data-action="crop" href="#" onclick="$(\'#' + this.element.attr('id') + '\').imageupload(\'crop\', $(this).parent()); return false;">crop</a>');
                var cropInput = $('<input type="hidden" />');
                cropInput.attr("name", this.id + '[' + this.imgCount + '][crop]');
                cropInput.attr('data-property', 'crop');
                if (typeof img.crop !== 'undefined') {
                    cropInput.val(JSON.stringify(img.crop));
                }
                node.append('<br>');
                node.append(cropInput);
            }

            if (this.options.focalpoint) {
                node.append('<a data-action="focalpoint" href="#" onclick="$(\'#' + this.element.attr('id') + '\').imageupload(\'focalpoint\', $(this).parent()); return false;">focal point</a>');
                var focalpointInput = $('<input type="hidden" />');
                focalpointInput.attr("name", this.id + '[' + this.imgCount + '][focalpoint]');
                focalpointInput.attr('data-property', 'focalpoint');
                if (typeof img.focalpoint !== 'undefined') {
                    focalpointInput.val(JSON.stringify(img.focalpoint));
                }
                node.append('<br>');
                node.append(focalpointInput);
            }

            if (this.options.alt) {
                node.append('<a data-action="alt" href="#" onclick="$(\'#' + this.element.attr('id') + '\').imageupload(\'alt\', $(this).parent()); return false;">alt text</a>');
                var altInput = $('<input type="hidden" />');
                altInput.attr("name", this.id + '[' + this.imgCount + '][alt]');
                altInput.attr('data-property', 'alt');
                if (typeof img.alt !== 'undefined') {
                    altInput.val(img.alt);
                }
                node.append('<br>');
                node.append(altInput);
            }

            $('#' + this.id + '_output').append(node);
            this.imgCount++;

            return node;
        },
        removeImage: function (element) {
            this.imgCount--;
            element.remove();
        },
        fit: function (imgX, imgY, outX, outY) {
            if (outX === undefined) {
                outX = this.options.thumbMaxX;
            }
            if (outY === undefined) {
                outY = this.options.thumbMaxY;
            }

            if (outX > 0 && imgX > outX) {
                imgY = (outX / imgX) * imgY;
                imgX = outX;
            }
            if (outY > 0 && imgY > outY) {
                imgX = (outY / imgY) * imgX;
                imgY = outY;
            }
            return {w: Math.round(imgX), h: Math.round(imgY)};
        },
        alt: function (element) {
            var self = this;
            if (!self.options.alt) {
                return false;
            }

            //set up the initial selection
            var $input = $(element).find('[data-property="alt"]').first();
            var value = $input.val();

            var $modalContent = $('<div style="padding: 16px;"><h2>Image Alt Text</h2></div>');
            $modalContent.append($('<input style="width: 350px; margin: 16px 0;" />')
                .attr('id', self.id + '_alt_ui')
                .attr('value', value)
            );
            $modalContent.append('<div style="text-align: right"><input style="height: 40px; width: 100px;" type="submit" value="Ok" class="simplemodal-close"/></div>');

            $modalContent.modal({
                autoResize: true,
                ias: undefined,
                //close: false,
                id: self.id + '_alt_modal',
                onClose: function (dialog) {
                    var sel = $('#' + self.id + '_alt_ui').first().val();
                    $input.val(sel).trigger('change');

                    $.modal.close();
                }
            });
        },
        focalpoint: function (element) {
            var self = this;
            if (!self.options.focalpoint) {
                return false;
            }

            var $img = $(element).find('img').first();
            var file = {
                url: $img.data('src'),
                imgX: $img.data('width'),
                imgY: $img.data('height')
            };

            var modalImageSize = self.fit(file.imgX, file.imgY, self.options.modalImageMaxX, self.options.modalImageMaxY);

            //set up the initial selection
            var $input = $(element).find('[data-property="focalpoint"]').first();
            var selection = $input.val();
            selection = selection.length ? JSON.parse(selection) : false;

            if (!selection) {
                // default selection is a square in the center of the image
                var selX = file.imgX / 5;
                selection = {
                    x1: Math.round((file.imgX - selX) / 2),
                    y1: Math.round((file.imgY - selX) / 2),
                    x2: Math.round(selX + ((file.imgX - selX) / 2)),
                    y2: Math.round(selX + ((file.imgY - selX) / 2)),
                };
            }

            var $modalContent = $('<div style="padding: 16px;"><h2>Select Focal Point</h2></div>');
            $modalContent.append($('<img style="margin: 16px 0;" />')
                .attr('id', self.id + '_focalImage')
                .attr('width', modalImageSize.w)
                .attr('height', modalImageSize.h)
                .attr('src', file.url)
            );
            $modalContent.append('<div style="text-align: right"><input style="height: 40px; width: 100px;" type="submit" value="Ok" class="simplemodal-close"/></div>');

            $modalContent.modal({
                autoResize: true,
                ias: undefined,
                //close: false,
                id: self.id + '_focalpoint_modal',
                onClose: function (dialog) {
                    ias.setOptions({hide: true});
                    ias.update();

                    var sel = ias.getSelection();
                    $input.val(JSON.stringify(sel)).trigger('change');

                    $.modal.close();
                },
                onShow: function (img) {
                    ias = $('#' + self.id + '_focalImage').imgAreaSelect({
                        instance: true,
                        handles: true,
                        movable: true,
                        x1: selection.x1,
                        y1: selection.y1,
                        x2: selection.x2,
                        y2: selection.y2,
                        imageHeight: file.imgY,
                        imageWidth: file.imgX
                    });

                    //ias.update();
                }
            });

        },
        crop: function (element) {
            var self = this;
            if (!self.options.crop) {
                return false;
            }
            var ias;

            var $img = $(element).find('img').first();
            var file = {
                url: $img.data('url'),
                imgX: $img.data('width'),
                imgY: $img.data('height')
            };

            //set up the initial selection
            var $input = $(element).find('[data-property="crop"]').first();
            var selection = $input.val();
            selection = selection.length ? JSON.parse(selection) : false;

            if (!selection) {
                var selX = file.imgX;
                var selY = file.imgY;
                if (self.options.forceAr == true && selX / selY != self.options.ar) {
                    if (selX / selY > self.options.ar) {
                        selX = selY * self.options.ar;
                    } else {
                        selY = selX / self.options.ar;
                    }
                }
                selection = {
                    x1: Math.round((file.imgX - selX) / 2),
                    y1: Math.round((file.imgY - selY) / 2),
                    x2: Math.round(selX + ((file.imgX - selX) / 2)),
                    y2: Math.round(selY + ((file.imgY - selY) / 2)),
                };
            }

            var modalImageSize = self.fit(file.imgX, file.imgY, self.options.modalImageMaxX, self.options.modalImageMaxY);

            var $modalContent = $('<div style="padding: 16px;"><h2>Select Crop Region</h2></div>');

            $modalContent.append($('<img style="margin: 16px 0;">')
                .attr('id', self.id + '_cropImg')
                .attr('width', modalImageSize.w)
                .attr('height', modalImageSize.h)
                .attr('src', file.url)
            );
            $modalContent.append('<div style="text-align: right"><input style="height: 40px; width: 100px;" type="submit" value="Ok" class="simplemodal-close"/></div>');

            $modalContent.modal({
                ias: undefined,
                //close: false,
                id: self.id + '_crop_modal',
                onClose: function (dialog) {
                    ias.setOptions({hide: true});
                    ias.update();

                    var sel = ias.getSelection();
                    $input.val(JSON.stringify(sel)).trigger('change');

                    $.modal.close();
                },
                onShow: function (dialog) {
                    ias = $('#' + self.id + '_cropImg').imgAreaSelect({
                        instance: true,
                        x1: selection.x1,
                        y1: selection.y1,
                        x2: selection.x2,
                        y2: selection.y2,
                        imageHeight: file.imgY,
                        imageWidth: file.imgX,
                        handles: true,
                        movable: true,
                    });
                    if (self.options.forceAr) {
                        ias.setOptions({aspectRatio: self.options.arX + ':' + self.options.arY});
                        ias.update();
                    }
                }
            });

        },
        buildUploadUrl: function() {
            var self = this;
            var newDate = new Date;
            var uniqid = newDate.getTime() + '-' + Math.floor(Math.random() * 32767);
            return self.options.uploaderUrl + '?uniqid=' + uniqid + '&param_name=' + self.id + '_input&disk=' + self.options.disk + '&path=' + self.options.uploadPath + '&prefix=' + self.options.prefix + '&overwrite=' + self.options.overwrite;
        },
        // bind the fileupload plugin
        _init: function () {
            var self = this;
            $(this.element).fileupload({
                dropZone: $('#' + self.id),
                dataType: 'json',
                add: function(e, data) {
                    // refresh the url+uniqid for every request
                    data.url = self.buildUploadUrl();
                    data.submit();
                },
                done: function (e, data) {
                    $('#' + self.id + '_progress').progressbar("destroy");

                    $('#' + self.id + '_progress').append(
                        $('<img />')
                            .css({'margin': '0 8px', 'vertical-align': 'middle'})
                            .attr('src', '/vendor/wax/admin/images/spinner.gif')
                    ).append('Processing...');

                    $.each(data.result, function (index, file) {
                        if (file.error) {
                            $('#' + this.id + '_error').text(file.error).show();
                        }

                        var outSize = self.fit(file.imgX, file.imgY, self.options.outMaxX, self.options.outMaxY);

                        // main image resize (yes the action is crop but its not cropping)
                        $.ajax({
                            url: self.options.imageCropUrl,
                            dataType: 'json',
                            id: self.id,
                            data: {
                                disk: self.options.disk,
                                path: file.path,
                                x1: 0,
                                y1: 0,
                                x2: file.imgX,
                                y2: file.imgY,
                                w: outSize.w,
                                h: outSize.h,
                                deleteOnError: true
                            }
                        }).done(function (result) {
                            if (result.status !== false) {
                                // the filename returned by the imageProcessor has the prefix on it, so strip it off again.
                                img = {
                                    basename: result.filename.substring(self.options.prefix.length),
                                    width: outSize.w,
                                    height: outSize.h,
                                    url: result.url
                                }
                                var element = self.addImage(img);

                                if (self.options.crop) {
                                    self.crop(element);
                                }
                            } else {
                                if (result.hasOwnProperty('error')) {
                                    $('#' + this.id + '_error').text(result.error).show();
                                }
                            }
                        }).error(function (jqXHR) {
                            if (jqXHR.hasOwnProperty('responseJSON') && jqXHR.responseJSON.hasOwnProperty('error')) {
                                $('#' + this.id + '_error').text(jqXHR.responseJSON.error).show();
                            } else {
                                // If it didn't have a JSON error, it was probably a memory limit or timeout error.
                                $('#' + this.id + '_error').text('There was an error while processing the image. You may need to try uploading a smaller image file.').show();
                            }
                        }).always(function() {
                            $('#' + self.id + '_progress').empty();

                            $('[data-action="save"]').removeAttr("disabled");
                        });
                    });

                },
                progress: function (e, data) {
                    $('#' + self.id + '_progress').progressbar("option", "value", parseInt(data.loaded / data.total * 100, 10));
                },
                start: function (e, data) {
                    $('#' + self.id + '_error').empty().hide();
                    $('#' + self.id + '_progress').empty();
                    $('#' + self.id + '_progress').progressbar({value: 0});
                    $('[data-action="save"]').attr("disabled", "disabled");
                },
                fail: function (e, data) {
                    $('#' + this.id + '_error').text('There was an error while uploading the image. You may need to try uploading a smaller image file.').show();
                }

            });
        },
        // Use the _setOption method to respond to changes to options

        _setOption: function (key, value) {

            switch (key) {

                case "clear":
                    // handle changes to clear option

                    break;

            }

            // In jQuery UI 1.8, you have to manually invoke the _setOption method from the base widget
            $.Widget.prototype._setOption.apply(this, arguments);
            // In jQuery UI 1.9 and above, you use the _super method instead
            this._super("_setOption", key, value);

        },
        // Use the destroy method to clean up any modifications your widget has made to the DOM

        destroy: function () {

            // In jQuery UI 1.8, you must invoke the destroy method from the base widget

            $.Widget.prototype.destroy.call(this);
            // In jQuery UI 1.9 and above, you would define _destroy instead of destroy and not call the base method

        }

    });

}(jQuery));
