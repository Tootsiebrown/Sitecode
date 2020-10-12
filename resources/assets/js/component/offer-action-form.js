import selectComponent from "../utilities/select-component"

export default class OfferActionForm {
    constructor(element) {
        console.log('wellll')
        this.$component = selectComponent(element)
        this.$counterButton = this.$component.elements.counterButton
        this.$counterForm = this.$component.elements.counterForm
        this.$initialButtons = this.$component.elements.initialButtons
        this.$cancelButton = this.$component.elements.cancelButton

        this.$counterButton.on('click', this.handleCounterClick)
        this.$cancelButton.on('click', this.handleCancelClick)
    }

    handleCounterClick = (event) => {
        this.$counterForm.removeClass('hidden')
        this.$initialButtons.addClass('hidden')
    }

    handleCancelClick = (event) => {
        this.$counterForm.addClass('hidden')
        this.$initialButtons.removeClass('hidden')
        event.preventDefault()
    }
}
