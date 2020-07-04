// case insensitive ":contains"
$.expr[':'].containsI = function(x, y, z){
    return jQuery(x).text().toUpperCase().indexOf(z[3].toUpperCase())>=0;
};

(function( $ ) {

  $.widget( "wax.structureRecordSelectBox", {

    options: {
        multiselect: false,
        maxRecords: 1
    },

    // Set up the widget
    _create: function() {
        this.el = $(this.element);
        this.id = this.el.data('id');
        this.field = this.el.data('field');
        this.structure = this.el.data('structure');
        this.inputContainer = $(this.el.closest(".inputContainer"));
        this.filterInput = $("#structureRecordSelectBox_" + this.field + "_filter");
        this.token = this.el.data('token');
    },

    // bind the UI plugins
    _init: function() {
        var self = this;
        this.inputContainer.on('click', '.structureRecordSelectBox div', function(e) {
            var id = $(e.currentTarget).data('id');
            self.choose(id);
        });
        this.filterInput.on("keyup", function(e) {
            var filterString = self.sanitizeFilter(e.target.value);
            self.filterChildren(filterString);
        });

        var selection = this.inputContainer.find('input[type="hidden"]').map(function() { return $(this).val(); }).get();

        var loadData = {
            'structure' : this.structure,
            'field'     : this.field,
            'id'        : this.id,
            'selection' : selection,
            '_token'    : this.token
        }

        this.el.load('/admin/cms/structure-record-select-box .structureRecordSelectBox', loadData, function() {
            $(this).children(':first').unwrap();

            // refresh the element so its children can be accessed normally
            self.el = $(self.inputContainer.find('.structureRecordSelectBox').get(0));
        });
    },

    sanitizeFilter: function(str) {
        //return str;
        return str = str.replace("'", '\'');

        str = str.match(/[a-z0-9]+/ig);
        return (str == null) ? '' : str.join(' ');
    },

    filterChildren: function(str) {
        if(str.length==0) {
            this.el.children().show();
        } else {
            this.el.children().not(":containsI('" + str + "')").hide();
            this.el.children(":containsI('" + str + "')").show();
        }
    },

    choose: function (id) {
        if(this.options.multiselect == false) {
            if(this.el.children("[data-id='" + id + "']").hasClass('selected')) {
                this.el.children("[data-id='" + id + "']").removeClass('selected');
                $("#" + this.field).val(0);
            } else {
                this.el.children().removeClass('selected');
                $("#" + this.field).val(id);
                this.el.children("[data-id='" + id + "']").addClass('selected');
            }
        } else {
            if(this.el.children("[data-id='" + id + "']").hasClass('selected')) {
                this.el.children("[data-id='" + id + "']").removeClass('selected');
                this.inputContainer.find('input[value="' + id + '"]').remove();
            } else {
                var selectedCount = this.inputContainer.find('input[name="' + this.field + '[]"]').length;
                if(this.options.maxRecords == 0 || selectedCount < this.options.maxRecords) {
                    var newInput = $('<input>').attr('type', 'hidden').attr('name', this.field + '[]').val(id);
                    this.inputContainer.append(newInput);
                    this.el.children("[data-id='" + id + "']").addClass('selected');
                }
            }
        }
    },

    // Use the destroy method to clean up any modifications your widget has made to the DOM
    destroy: function() {
      // In jQuery UI 1.8, you must invoke the destroy method from the base widget
      $.Widget.prototype.destroy.call( this );
      // In jQuery UI 1.9 and above, you would define _destroy instead of destroy and not call the base method
    }

  });

}( jQuery ) );
