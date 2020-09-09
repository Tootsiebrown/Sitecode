import selectComponent from '../utilities/select-component'

export default class AutoSelectOnFocus {

    constructor(element) {
        this.$component = selectComponent(element)
        this.$component.on('focus', this.handleFocus)

        if (this.$component.attr('autofocus')) {
            this.$component.trigger('focus')
        }
    }

    handleFocus = () => {
        this.$component.get(0).select();
    }
}
