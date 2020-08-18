import selectComponent from '../utilities/select-component'
import * as $ from 'jquery'

export default class TaxonomyNav {
    constructor(element, options = {}) {
        this.$component = selectComponent(element)
        this.$link = this.$component.elements.link
        this.isOpen = false
        this.otherNavs = []

        this.$link.on('click', this.handleClick)
        $(window).on('click', this.handleWindowClick)
    }

    handleClick = (event) => {
        event.stopPropagation()
        event.preventDefault()

        if (this.isOpen) {
            this.close()
        } else {
            this.open()
        }
    }

    handleWindowClick = (event) => {
        if (this.isOpen) {
            this.close()
        }
    }

    setOtherNavs = (others) => {
        this.otherNavs = others
    }

    close = () => {
        this.$component.removeClass('open')
        this.isOpen = false
    }

    open = () => {
        this.$component.addClass('open')
        this.isOpen = true

        $.each(this.otherNavs, (i, otherNav) => {
            otherNav.close()
        })
    }
}
