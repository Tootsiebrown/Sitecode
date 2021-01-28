import selectComponent from '../../utilities/select-component'

export default class ListingToEbay {

    constructor(element, options = {}) {
        this.$component = selectComponent(element)
        this.$settings = this.$component.find('.send-to-ebay-settings')
        this.$input = this.$component.find('[name=send_to_ebay]')
        this.$input.on('change', this.handleChange)

        if (this.$input.attr('type') === 'hidden' && this.$input.val() == 1) {
            this.showSettings()
        } else {
            this.$input.trigger('change')
        }
    }

    show = () => {
        this.$component.show()
    }

    hide = () => {
        this.$component.hide()
    }

    handleChange = (e) => {
        if (this.$input.prop('checked')) {
            this.showSettings()
        } else {
            this.hideSettings()
        }
    }

    showSettings = () => {
        this.$settings.show()
    }

    hideSettings = () => {
        this.$settings.hide()
    }
}
