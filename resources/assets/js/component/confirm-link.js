import selectComponent from "../utilities/select-component"
import * as $ from "jquery"

export default class ConfirmLink {
    constructor(element) {
        this.$component = selectComponent(element)
console.log('we got here')
        this.$component.on('click', this.confirmLink)
    }

    confirmLink = () => {
        return confirm(this.$component.attr('data-message'))
    }
}
