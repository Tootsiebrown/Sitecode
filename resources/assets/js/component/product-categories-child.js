import selectComponent from "../utilities/select-component"

export default class ProductCategoriesChild {
    constructor(element, options = {}) {
        this.$component = selectComponent(element)
        this.$select = this.$component.find('select')
        this.prettyName = 'Child Category'
        if ( typeof this.$component.attr('data-my-child-hierarchy-component') !== 'undefined' ) {
            this.hasChildComponent = true
            this.childComponent = new ProductCategoriesChild(
                $(this.$component.attr('data-my-child-hierarchy-component'))
            )
        } else {
            this.hasChildComponent = false
        }

        if (! this.hasChildComponent) {
            this.prettyName = 'Grandchild Category';
        }

        this.$select.on('change', this.handleChange)
    }

    setOptions(options) {
        this.options = options
        this.replaceOptions()
    }

    addClass(the_class) {
        this.$component.addClass(the_class)

    }

    removeClass(the_class) {
        this.$component.removeClass(the_class)
    }

    replaceOptions() {
        var options = '';
        options += `<option value="">Select ${ this.prettyName }...</option>`
        options += `<option value="new">New ${ this.prettyName }...</option>`;
        for (var i in this.options){
            options += `<option value="${ this.options[i].id }">${ this.options[i].name }</option>`;
        }
        this.$select.html(options)
        this.$select.val(this.$select.attr('data-selected'))

        if (this.hasChildComponent) {
            this.childComponent.setOptions(
                this.getNewChildren()
            )
        }
    }

    handleChange = (e) => {
        if (!this.hasChildComponent) {
            return
        }

        this.childComponent.setOptions(
            this.getNewChildren()
        )

        if (this.$select.val() === 'new' && this.hasChildComponent) {
            this.childComponent.value('new')
        }

        if (this.$select.val() != '') {
            this.childComponent.addClass('visible')
        } else {
            this.childComponent.removeClass('visible')
        }

        this.childComponent.trigger('change')
    }

    getNewChildren = () => {
        if (!(this.$select.val() in this.options)) {
            return {}
        }

        return this.options[this.$select.val()].children
    }

    value(value) {
        if (typeof value === 'undefined') {
            return this.$select.val()
        }

        this.$select.val(value)
    }

    trigger(eventName) {
        this.$select.trigger(eventName)
    }
}
