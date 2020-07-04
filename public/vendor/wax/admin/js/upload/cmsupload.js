(function( $ ) {

  $.widget( "wax.cmsupload", {

    options: {

        // thumb size
        thumbMaxX: 80,
        thumbMaxY: 80,

        values: [],
        maxFiles: 1,

        uploaderUrl: '/admin/media/upload',
        fileInfoUrl: '/admin/media/thumb-path',

        allowedExtensions: [],

		disk: 'uploads',
		uploadPath: '/',
		prefix: '',
		overwrite: false
    },
    id: undefined,
    container: undefined,
    fileCount: 0,


    // Set up the widget
    _create: function() {
        var self = this;

        if(this.id == undefined) this.id = this.element.attr('id');

        $(this.element).wrap('<div id="' + this.id + '_container" />');
        $(this.element).attr('name', $(this.element).attr('name') + '_input');
        $(this.element).attr('id', $(this.element).attr('id') + '');

        this.container = $(this.element).parent();

        this.container.append('<div id="' + this.id + '_output" /><div style="clear: both;" /><div id="' + this.id + '_status" />');

        for(v in this.options.values) {
            if(self.options.values[v] != '') {
                self.addFile(self.options.values[v]);
            }
        }
    },

	addFile: function(filename) {

		var self = this;
		if(this.options.maxFiles > 0 && this.fileCount == this.options.maxFiles) {
			$('#' + this.id + '_output > div:first').remove();
			this.fileCount--;
		}
		var thumb=false;

		$.ajax({
			url: this.options.fileInfoUrl,
			dataType: 'json',
			async: false,
			data: {
				action: 'thumbnail',
				disk: self.options.disk,
				path: self.options.uploadPath + filename,
				thumbx: self.options.thumbMaxX,
				thumby: self.options.thumbMaxY
			},
			success: function(result) {
				thumb = result
				return result;
			}
		});


		var node = $('<div style="margin: 8px; float: left; text-align: center; font-size: .7em" />');
		node.append($("<img />").attr("src", thumb));
		node.append('<br />');
		node.append(document.createTextNode(filename));
		node.append('<br />');
		node.append('<a href="#" onclick="$(\'#' + this.element.attr('id') + '\').cmsupload(\'removeFile\', $(this).parent()); return false;">[remove]</a>');

		var hiddenInput = $('<input type="hidden" />');
		hiddenInput.attr("name", this.id + '[]');
		hiddenInput.val(filename);
		node.append(hiddenInput);

		$('#' + this.id + '_output').append(node);

		this.fileCount++;
	},


	removeFile: function(element) {
		this.fileCount--;
		element.remove();
	},


	// bind the UI plugins
	_init: function() {
		var self = this;
		var newDate = new Date;
        var uniqid = newDate.getTime() + '-' + Math.floor(Math.random() * 32767);
        $(this.element).fileupload({
            dropZone: $('#' + self.id),
			dataType: 'json',
			url: self.options.uploaderUrl + '?uniqid=' + uniqid + '&param_name=' + self.id + '_input&disk=' + self.options.disk + '&path=' + self.options.uploadPath + '&prefix=' + self.options.prefix + '&overwrite=' + self.options.overwrite,

            beforeSend: function (event, files, index, xhr, handler, callBack) {
                if(index === undefined){
                    index = 0;
                }

                if(self.options.allowedExtensions.length > 0){

                    var regexp = new RegExp('\.(' + self.options.allowedExtensions.join('|') + ')', 'i');

                    // Using the filename extension for our test,
                    // as legacy browsers don't report the mime type
                    if (!regexp.test(files['files'][index].name.toLowerCase())) {

                        var node = $('<div style="margin: 8px; float: left; text-align: center; color:red" />');
                        //node.append(document.createTextNode('File type of '+files['files'][0].name+' is not allowed.'));
                        node.append(document.createTextNode('Allowed types: ' + self.options.allowedExtensions.join(', ')));

                        $('#' + self.id + '_output').append(node);
                        $('#' + self.id + '_status').progressbar("destroy");

                        setTimeout(function () {
                            $(node).remove();
                        }, 10000);

                        return false;
                    }
                }
                //callBack();
            },

            done: function (e, data) {

                $('#' + self.id + '_status').progressbar("destroy");

                $.each(data.result, function (index, file) {
                    self.addFile(file.name);
                    $(':submit').removeAttr("disabled");

                });

            },

            progress: function(e, data) {
                $('#' + self.id + '_status').progressbar( "option", "value", parseInt(data.loaded / data.total * 100, 10));
            },

            start: function(e, data) {

                //var id = $(this).parent().find('input:hidden').attr('id');

                $('#' + self.id + '_status').progressbar({value: 0});
                $(':submit').attr("disabled", "disabled");
            },

            fail: function(e, data) {
                var msg = '';
                for(i in data) {
                    msg = msg + i + ": " + data[i] + "\n";
                }
                //alert(msg);
            }



        });
    },


    // Use the _setOption method to respond to changes to options

    _setOption: function( key, value ) {

      switch( key ) {

        case "clear":
          // handle changes to clear option

          break;

      }

      // In jQuery UI 1.8, you have to manually invoke the _setOption method from the base widget
      $.Widget.prototype._setOption.apply( this, arguments );
      // In jQuery UI 1.9 and above, you use the _super method instead
      this._super( "_setOption", key, value );

    },

    // Use the destroy method to clean up any modifications your widget has made to the DOM

    destroy: function() {

      // In jQuery UI 1.8, you must invoke the destroy method from the base widget

      $.Widget.prototype.destroy.call( this );
      // In jQuery UI 1.9 and above, you would define _destroy instead of destroy and not call the base method

    }

  });

}( jQuery ) );
