import selectComponent from '../utilities/select-component'

export default class SearchSidebar {

    constructor(element) {
        console.log('doing it')
        this.$component = selectComponent(element)
        this.$toggle = this.$component.elements.sidebarToggle
        this.$chevron = this.$toggle.find('i')
        this.$text = this.$toggle.find('span');
        this.isOpen = false

        this.$toggle.on('click', this.handleClick)
    }

    handleClick = (event) => {
        if (this.isOpen) {
            this.close()
            return;
        }

        this.open()
    }

    open = () => {
        this.$component.addClass('open')
        this.$chevron.removeClass('fa-chevron-down')
        this.$chevron.addClass('fa-chevron-up')
        this.$text.text('Hide')

        this.isOpen = true
    }

    close = () => {
        this.$component.removeClass('open')
        this.$chevron.addClass('fa-chevron-down')
        this.$chevron.removeClass('fa-chevron-up')
        this.$text.text('Show')

        this.isOpen = false
    }
}
