import 'velocity-animate'
import 'velocity-animate/velocity.ui.min'
import selectComponent from 'utilities/select-component'
import 'vendor/jquery.debouncedresize'
import {$bpLaptop} from 'utilities/grid-settings'

export default class SubNav {

    constructor(element, options = {}) {
        this.$component = selectComponent(element)
        this.$nav = this.$component.elements.subnavContents
        this.setTransition()
        $(window).on('debouncedresize', () => {
            this.setTransition()
        })
    }

    setTransition() {
        this.stopToggle()
        if ($bpLaptop.matches) {
            this.transitionIn = 'transition.slideDownIn'
            this.transitionOut = 'transition.slideUpOut'
        } else {
            this.transitionIn = 'slideDown'
            this.transitionOut = 'slideUp'
        }


        this.startToggle()
    }

    startToggle() {
        $('body').on('click', () => {
            if (this.$component.elements.toggle.attr('data-property') == 'open') {
                this.$component.elements.toggle.attr('data-property', 'closed')
                this.closeNav()
            }
        })

        this.$component.elements.toggle.on('click', (event) => {
            event.stopPropagation()

            if (this.$component.elements.toggle.attr('data-property') == 'open') {
                this.$component.elements.toggle.attr('data-property', 'closed')
                this.closeNav()
            } else {
                this.$component.elements.toggle.attr('data-property', 'open')
                this.openNav()
            }
        })

        this.$component.on('click', (event) => {
            event.stopPropagation()
        })
    }

    stopToggle() {
        this.$component.elements.toggle.off()
        $('body').off()
    }

    openNav() {
        this.$nav.velocity(this.transitionIn, {
            duration: 400,
            complete: () => {
                this.$nav.removeAttr('style')
                this.$nav.attr('data-property', 'open')
            }
        })
    }

    closeNav() {
        this.$nav.velocity(this.transitionOut, {
            duration: 500,
            complete: () => {
                this.$nav.removeAttr('style')
                this.$nav.attr('data-property', 'closed')
            }
        })

    }
}