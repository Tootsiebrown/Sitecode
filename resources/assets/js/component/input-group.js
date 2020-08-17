import selectComponent from '../utilities/select-component'
import * as $ from "jquery"

export default class FocusableInputGroup {

    constructor() {
        this.$component = selectComponent(element)
        this.$input = this.$component.element('input');

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
