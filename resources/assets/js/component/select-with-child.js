import selectComponent from '../utilities/select-component'
import * as $ from 'jquery'
import SelectOrNew from "./select-or-new";

export default class SelectWithChild {

    constructor(element, options = {}) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        this.$component = selectComponent(element)
        this.$childWrapper = $(this.$component.attr('data-child-wrapper'))
        this.$childSelect = this.$childWrapper.find('select')
        this.childName = this.$component.attr('data-child-name')

        this.$component.on('change', this.handleChange)
        this.$component.trigger('change');
    }

    handleChange = (e) => {
        var formData = {}
        var the_value = this.$component.val()
        formData[this.$component.attr('data-url-parameter')] = the_value

        if (the_value == '' || the_value == 'new') {
            this.emptyAndHideChild();
            return;
        }

        $.ajax({
            type: 'GET',
            url: this.$component.attr('data-child-data-url'),
            data: formData,
            success: (jsonData) => {
                this.generateOptionsFromJson(jsonData);
            }
        });
    }

    emptyAndHideChild = () => {
        this.$childSelect.html('');
        this.$childSelect.hide();
        this.$childWrapper.hide();
    }

    generateOptionsFromJson = (jsonData) => {
        var option = '';
        option += '<option value="" selected>Select ' + this.childName + '...</option>'
        option += '<option value="new">New ' + this.childName + '...</option>';
        for (var i in jsonData){
            option += '<option value="'+jsonData[i].id+'"> '+jsonData[i].name +' </option>';
        }
        this.$childSelect.html(option);
        this.$childSelect.show();
        this.$childWrapper.show();
        var $selectOrNew = this.$childSelect.closest('[data-component="select-or-new"]');
        if ($selectOrNew.length > 0) {
            new SelectOrNew($selectOrNew.get(0))
        }

        if (jsonData.length === 0) {
            this.$childSelect.val('new')
        } else if (this.$childSelect.attr('data-selected') && this.$childSelect.find('[value="' + this.$childSelect.attr('data-selected') + '"]').length > 0) {
            this.$childSelect.val(this.$childSelect.attr('data-selected'))
        }

        this.$childSelect.trigger('change');
    }
}
