import selectComponent from "../utilities/select-component";

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

        this.stripeElements = stripe.elements()

        this.mountCard()
        this.$component.on('submit', this.handleSubmit)
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
        //this.$submitButton.prop('disabled', true)
        this.$spinner.removeClass('hidden');

        stripe.createToken(this.card).then((result) => {
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

    handleStripeToken = (token) => {
        this.$tokenField.val(token.id)
        this.$lastFourField.val(token.card.last4)
        this.$zipField.val(token.card.address_zip)
        this.$brandField.val(token.card.brand)
        this.$component.submit()
    }
}
