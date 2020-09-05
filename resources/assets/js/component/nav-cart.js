import selectComponent from '../utilities/select-component'

export default class NavCart {
    constructor(element, options = {}) {
        this.$component = selectComponent(element)
        this.$link = this.$component.elements.link;

        this.$link.on('click', this.handleClick)
        this.mediaQuery = window.matchMedia("(min-width: 768px)")
    }

    handleClick = (event) => {
        if (! this.mediaQuery.matches) {
            return
        }

        event.preventDefault()

        this.$component.toggleClass('open');
    }
}
