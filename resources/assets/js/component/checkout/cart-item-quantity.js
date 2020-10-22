import selectComponent from "../../utilities/select-component"

export default class CartItemQuantity {
    constructor(element) {
        this.$component = selectComponent(element)
        this.$input = this.$component.elements.input
        this.$button = this.$component.elements.button
        this.$input.on('change', this.handleChange)
        this.$input.on('keyup', this.handleChange)

        this.handleChange()
    }

    handleChange = (e) => {
        console.log(this.$input.val())
        console.log(this.$input.attr('data-original-quantity'))
        if (this.$input.val() != this.$input.attr('data-original-quantity')) {
            this.$button.prop('disabled', false);
        } else {
            this.$button.prop('disabled', true);
        }
    }
}
