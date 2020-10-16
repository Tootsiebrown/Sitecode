import selectComponent from "../utilities/select-component";
import * as $ from 'jquery'

export default class StripeForm
{
    constructor(element, options = {}) {
        this.form = element
        this.$component = selectComponent(element)
        this.$tokenField = this.$component.elements.tokenField
        this.$lastFourField = this.$component.elements.lastFourField
        this.$zipField = this.$component.elements.zipField
        this.$brandField = this.$component.elements.brandField
        this.$submitButton = this.$component.elements.submitButton
        this.$spinner = this.$component.elements.spinner
        this.$sameAsShipping = this.$component.find('[name=same_as_shipping]');

        this.stripeElements = stripe.elements()

        this.mountCard()
        this.$component.on('submit', this.handleSubmit)

        console.log(this.$component.elements)
    }

    mountCard = () => {
        // Custom styling can be passed to options when creating an Element.
        var style = {
            base: {
                // Add your base input styles here. For example:
                fontSize: '16px',
                color: '#32325d',
            },
        };

        // Create an instance of the card Element.
        this.card = this.stripeElements.create('card', {style: style})

        // Add an instance of the card Element into the `card-element` <div>.
        this.card.mount('#card-element')
    }

    handleSubmit = (event) => {
        event.preventDefault();

        this.$component.off('submit', this.handleSubmit)
        this.$spinner.removeClass('hidden');

        stripe.createToken(this.card, this.getBillingData()).then((result) => {
            if (result.error) {
                // Inform the customer that there was an error.
                var errorElement = document.getElementById('card-errors')
                errorElement.textContent = result.error.message
                this.$component.on('submit', this.handleSubmit)
                this.$spinner.addClass('hidden');
                this.$submitButton.prop('disabled', false)
            } else {
                // Send the token to your server.
                this.handleStripeToken(result.token)
            }
        });
    }

    getBillingData = () => {
        let billingData = {}

        billingData.address_country = 'US'

        if (this.$sameAsShipping.prop('checked')) {
            billingData.name = $('[data-shipping-info="first-name"]').text()
                + ' ' + $('[data-shipping-info="last-name"]').text()
            billingData.address_line1 = $('[data-shipping-info="address1"]').text()
            let address2 = $('[data-shipping-info="address2"]').text()
            if (address2.length > 0) {
                billingData.address_line2 = address2
            }
            billingData.address_city = $('[data-shipping-info="city"]').text()
            billingData.address_state = $('[data-shipping-info="state"]').text()
        } else {
            billingData.name = $('[name="first_name"]').val()
                 + ' ' + $('[name="last_name"]').val()
            billingData.address_line1 = $('[name="address1"]').val()
            let address2 = $('[name="address2"]').val()
            if (address2.length > 0) {
                billingData.address_line2 = address2
            }
            billingData.address_city = $('[name="city"]').val()
            billingData.address_state = $('[name="state"]').val()
        }

        return billingData
    }

    handleStripeToken = (token) => {
        this.$tokenField.val(token.id)
        this.$lastFourField.val(token.card.last4)
        this.$zipField.val(token.card.address_zip)
        this.$brandField.val(token.card.brand)
        this.$component.submit()
    }
}
