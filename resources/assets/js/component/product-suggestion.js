import selectComponent from '../utilities/select-component'
import * as $ from 'jquery'
import "magnific-popup";

export default class ProductSuggestion {

    constructor(element, options = {}) {
        this.$component = selectComponent(element)

        this.$modalTrigger = this.$component.elements.modalTrigger

        this.$modalTrigger.on('click', this.openModal)
    }

    openModal = () => {
        $.magnificPopup.open({
            items: {
                type: 'inline',
                src: this.$modalTrigger.attr('href')
            },
        })
    }
}
