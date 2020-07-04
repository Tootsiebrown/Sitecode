import 'vendor/sticky-kit'
import 'vendor/jquery.debouncedresize.js'

export function stickyKit() {
    const $stickyChild = $('[data-role="sticky-child"]')
    const $stickyParent = $('[data-role="sticky-parent"]')

    const init = () => {
        set()
    }

    const set = () => {
        $stickyChild.stick_in_parent({
            parent: $stickyParent
        })
    }

    const unSet = () => {
        $stickyChild.trigger('sticky_kit:detach')
    }

    if ($stickyChild.is('*')) {
        init()
    }
}