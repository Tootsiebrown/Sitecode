import selectComponent from "../utilities/select-component"

export default class CancelOrder {
    constructor(element) {
        this.$component = selectComponent(element)
        this.$component.on('submit', this.confirmCancel)
    }

    confirmCancel = () => {
        return confirm('This cannot be undone. Are you sure you want to cancel the order?')
    }
}
