import selectComponent from '../utilities/select-component'

export default class FocusableInputGroup {

    constructor(element, options = {}) {
        this.$component = selectComponent(element)
        this.$input = this.$component.elements.input

        this.$input.on('focus', this.handleFocus)
        this.$input.on('blur', this.handleBlur)
    }

    handleFocus = (e) => {
        this.$component.addClass('focused')
    }

    handleBlur = (e) => {
        this.$component.removeClass('focused')
    }
}
