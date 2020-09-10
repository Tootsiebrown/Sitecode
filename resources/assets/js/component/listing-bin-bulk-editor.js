import selectComponent from "../utilities/select-component";


export default class ListingBinBulkEditor {
    constructor(element) {
        this.$component = selectComponent(element)
        this.$opener = this.$component.elements.opener
        this.$collapsibleSection = this.$component.elements.collapsibleSection
        this.$closer = this.$component.elements.closer

        this.$opener.on('click', this.openForm)
        this.$closer.on('click', this.closeForm)
    }

    openForm = (event) => {
        event.preventDefault();

        this.$collapsibleSection.removeClass('hidden')
        this.$opener.addClass('hidden')
    }

    closeForm = (event) => {
        event.preventDefault();

        this.$collapsibleSection.addClass('hidden')
        this.$opener.removeClass('hidden')
    }
}
