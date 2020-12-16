import selectComponent from '../../utilities/select-component'
import ListingToEbay from "./listing-to-ebay";

export default class ListingTypeSelect {

    constructor(element, options = {}) {
        this.$component = selectComponent(element)
        this.$select = this.$component.elements.select
        this.$quantity = this.$component.elements.quantity
        this.$offersEnabled = this.$component.elements.offersEnabled
        this.$bidDeadline = this.$component.elements.bidDeadline
        this.toEbay = new ListingToEbay(this.$component.find('.send-to-ebay'))

        this.$select.on('change', this.handleChange)
        this.$select.trigger('change');
    }

    handleChange = (e) => {
        if (this.$select.val() === 'set-price') {
            this.$quantity.addClass('visible')
            this.$bidDeadline.removeClass('visible')
            this.$offersEnabled.addClass('visible')
            this.toEbay.show()
        } else if (this.$select.val() === 'auction') {
            this.$quantity.removeClass('visible')
            this.$bidDeadline.addClass('visible')
            this.$offersEnabled.removeClass('visible')
            this.toEbay.hide()
        } else {
            this.$quantity.removeClass('visible')
            this.$bidDeadline.removeClass('visible')
            this.$offersEnabled.removeClass('visible')
            this.toEbay.hide()
        }
    }
}
