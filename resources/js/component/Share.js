import selectComponent from 'utilities/select-component'

export default class Share {

    animatingClass = 'velocity-animating';
    velocityConfig = {
        duration: 250
    };

    constructor(element) {
        this.$component = selectComponent(element)
        this.$list = this.$component.elements.list
        this.$button = this.$component.elements.button

        $.Velocity.hook(this.$list, 'translateX', '-50%')

        this.$button.on('click', event => {
            event.stopPropagation()
            this.toggleList()
        })

        this.$list.on('click', event => event.stopPropagation())

        $(window).on('click', () => {
            if (this.$list.is(':visible') && !this.$list.hasClass(this.animatingClass)) {
                this.hideList()
            }
        })
    }

    handeButtonClick = event => {
        this.toggleList()
    };

    showList() {
        if (!this.$list.hasClass(this.animatingClass)) {
            this.$list.velocity('transition.slideDownIn', this.velocityConfig)
        }
    }

    hideList() {
        if (!this.$list.hasClass(this.animatingClass)) {
            this.$list.velocity('transition.slideUpOut', {
                ...this.velocityConfig,
                complete: () => {
                    this.$list.css('display', '')
                }
            })
        }
    }

    toggleList() {
        if (this.$list.is(':visible')) {
            this.hideList()
        } else {
            this.showList()
        }
    }
}