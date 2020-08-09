import selectComponent from '../utilities/select-component'

export default class SelectOrNew {

    constructor(element, options = {}) {
        this.$component = selectComponent(element)
        this.$select = this.$component.find('select')
        this.$new = this.$component.find('[data-element="new"]')
        this.$select.on('change', this.handleChange)
        this.$select.trigger('change');
    }

    handleChange = (e) => {
        if (this.$select.val() == 'new') {
            this.$new.addClass('visible')
        } else {
            this.$new.removeClass('visible')
        }
    }
}
