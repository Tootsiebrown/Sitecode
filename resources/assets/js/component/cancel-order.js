import selectComponent from "../utilities/select-component"
import * as $ from "jquery"

export default class CancelOrder {
    constructor(element) {
        console.log('doin it.')
        this.$component = selectComponent(element)
        this.$component.on('submit', this.confirmCancel)
    }

    confirmCancel = () => {
        return confirm('This cannot be undone. Are you sure you want to cancel the order?')
    }
}
