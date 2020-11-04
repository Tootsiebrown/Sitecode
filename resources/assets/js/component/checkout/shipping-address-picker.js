import selectComponent from "../../utilities/select-component"

export default class ShippingAddressPicker {
    constructor(element) {
        this.$component = selectComponent(element)
        this.$addressPicker = null
        if ('addressPicker' in this.$component.elements) {
            this.$addressPicker = this.$component.elements.addressPicker
        }

        this.$newAddress = this.$component.elements.newAddress

        if (this.$addressPicker) {
            this.$addressPicker.on('change', this.handleAddressChange)
        }
    }

    handleAddressChange = (event) => {
        if (this.$addressPicker.val() == 'new') {
            this.$newAddress.removeClass('hidden')
        }
    }
}
