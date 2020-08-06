import selectComponent from '../utilities/select-component'

export default class SelectOrNew {

    constructor(element, options = {}) {
        this.$component = selectComponent(element)
console.log('constructing...');
console.log(this.$component);
        this.$select = this.$component.elements.select
        this.$new = this.$component.elements['new']
        this.$select.on('change', this.handleChange)
        this.$select.trigger('change');
    }

    handleChange = (e) => {
        console.log(this.$select.attr('name'))
        console.log(this.$select.val())
        if (this.$select.val() == 'new') {
            this.$new.addClass('visible')
        } else {
            this.$new.removeClass('visible')
        }
    }
}
