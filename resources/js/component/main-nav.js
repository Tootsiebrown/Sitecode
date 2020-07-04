import 'velocity-animate'
import 'velocity-animate/velocity.ui.min'
import selectComponent from 'utilities/select-component'
import { $bpLg } from 'utilities/grid-settings'
import 'vendor/jquery.debouncedresize'

export default class MainNav {
    bodyOpenClass = '-nav-open'
    mobileToggleActiveClass = 'is-active'

    constructor(element, options = {}) {
        this.$component = selectComponent(element)
        this.$nav = this.$component.elements.list
        this.$toggle = this.$component.elements.toggle
        this.attachEvents()
    }

    attachEvents() {
        this.checkToggle()

        $(window).on('debouncedresize', () => {
            this.checkToggle()
        })
    }

    checkToggle() {
        this.stopToggle()

        if(!$bpLg.matches) {
            this.startToggle()
        }
    }

    startToggle() {
        this.$toggle.on('click', () => {
            if (this.$toggle.attr('data-property') == 'open') {
                this.$toggle.attr('data-property', 'closed')
                this.closeNav()
                this.$toggle.removeClass(this.mobileToggleActiveClass)
                $('body').removeClass(this.bodyOpenClass)
            } else {
                this.$toggle.attr('data-property', 'open')
                this.openNav()
                this.$toggle.addClass(this.mobileToggleActiveClass)
                $('body').addClass(this.bodyOpenClass)
            }
        })
    }

    stopToggle() {
        this.$toggle.off()
    }

    openNav() {
        this.$nav.velocity('slideDown', {
            duration: 400,
            complete: () => {
                this.$nav.removeAttr('style')
                this.$nav.attr('data-property', 'open')
            }
        })
    }

    closeNav() {
        this.$nav.velocity('slideUp', {
            duration: 500,
            complete: () => {
                this.$nav.removeAttr('style')
                this.$nav.attr('data-property', 'closed')
            }
        })
    }
}