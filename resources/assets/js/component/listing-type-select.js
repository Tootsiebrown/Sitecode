import selectComponent from '../utilities/select-component'

export default class ListingTypeSelect {

    constructor(element, options = {}) {
        this.$component = selectComponent(element)
        this.$select = this.$component.elements.select
        this.$quantity = this.$component.elements.quantity
        this.$bidDeadline = this.$component.elements.bidDeadline
        this.$select.on('change', this.handleChange)
        this.$select.trigger('change');
    }

    handleChange = (e) => {
        if (this.$select.val() === 'set-price') {
            this.$quantity.addClass('visible')
            this.$bidDeadline.removeClass('visible')
        } else if (this.$select.val() === 'auction') {
            this.$quantity.removeClass('visible')
            this.$bidDeadline.addClass('visible')
        } else {
            this.$quantity.removeClass('visible')
            this.$bidDeadline.removeClass('visible')
        }
    }
}
