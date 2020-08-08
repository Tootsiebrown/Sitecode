import selectComponent from '../utilities/select-component'

export default class ListingTypeSelect {

    constructor(element, options = {}) {
        this.$component = selectComponent(element)
        this.$select = this.$component.elements.select
        this.$quantity = this.$component.elements.quantity
        this.$select.on('change', this.handleChange)
        this.$select.trigger('change');
    }

    handleChange = (e) => {
        if (this.$select.val() === 'buy-it-now') {
            this.$quantity.addClass('visible')
        } else {
            this.$quantity.removeClass('visible')
        }
    }
}
