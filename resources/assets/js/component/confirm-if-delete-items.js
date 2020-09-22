import selectComponent from "../utilities/select-component"
import * as $ from "jquery"

export default class ConfirmIfDeleteItems {
    constructor(element) {
        this.$component = selectComponent(element)
        this.$form = this.$component.closest('form')
        this.$form.on('submit', this.confirmIfDeletes)
    }

    confirmIfDeletes = () => {
        let somethingIsToBeDeleted = this.$form
            .find('input.deletable')
            .filter((i, element) => {
                return $(element).prop('checked')
            })
            .length > 0

        if (somethingIsToBeDeleted) {
            return confirm('Some items will be deleted. Are you sure?')
        }

        return true
    }
}
