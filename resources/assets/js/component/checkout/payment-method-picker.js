import selectComponent from "../../utilities/select-component"

export default class PaymentMethodPicker {
    constructor(element) {
        this.$component = selectComponent(element)
        this.$paymentMethodPicker = null
        if ('paymentMethodPicker' in this.$component.elements) {
            this.$paymentMethodPicker = this.$component.elements.paymentMethodPicker
        }

        this.$newPaymentMethod = this.$component.elements.newPaymentMethod

        if (this.$paymentMethodPicker) {
            this.$paymentMethodPicker.on('change', this.handlePaymentMethodChange)
            this.$paymentMethodPicker.trigger('change')
        }
    }

    handlePaymentMethodChange = (event) => {
        console.log(event);
        if (this.$paymentMethodPicker.val() == 'new') {
            this.$newPaymentMethod.removeClass('hidden')
        } else {
            this.$newPaymentMethod.addClass('hidden')
        }
    }
}

