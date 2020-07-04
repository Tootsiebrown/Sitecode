/*
 * buildInputs method uses input found in
 * resources > views > forms > components > standard-input.blade
 */

import selectComponent from 'utilities/select-component'
import autosize from 'autosize'

const baseClass = 'input'

export default class CustomInput {
    
    activeClass = baseClass + '--is-active'
    filledClass = baseClass + '--is-filled'
    disabledClass = baseClass + '--is-disabled'
    errorClass = baseClass + '--has-error'

    constructor(element, options = {}) {
        this.$component = selectComponent(element)
        this.$field = this.$component.elements.field


        this.attachEvents(options)
        this.handleInputFill()
        
        if (!this.$component.elements.errorLabel) {
            this.createErrorLabel()
        }
    }

    attachEvents(options) {
        const tagName = this.$field[0].tagName.toLowerCase()

        if (this.$field.attr('type') === 'file') {
            this.$component.on('change', this.handleFileChange)

            return
        }

        if (tagName === 'select') {
            this.options = { ...options }

            if (this.$component.attr('data-action') == 'filter') {
                this.$component.on('change', this.handleFilterEvent)
            }
        }

        if (tagName === 'textarea') {
            autosize(this.$field[0])
        }

        this.$field.on('focus blur', this.handleInputFill)
    }

    createErrorLabel() {
        if (!this.$component.elements.error) {
            this.$component.prepend(
                $('<label />', {
                    'for': this.$component.elements.field.attr('name'),
                    'class': 'input__error',
                    'data-element': 'error'
                })
            )

            this.$component.refresh()
        }
    }

    disable() {
        this.$component.addClass(this.disabledClass)
        this.$field.attr('disabled', 'disabled')
    }

    enable() {
        this.$component.removeClass(this.disabledClass)
        this.$field.removeAttr('disabled')
    }

    focus() {
        this.$component.elements.field.focus()
    }

    clear() {
        this.$component.elements.field.val('')
    }

    setError(message) {
        this.$component.addClass(this.errorClass)
        this.$component.elements.error
            .html(message)
            .addClass(this.activeClass)
    }

    removeError() {
        this.$component.removeClass(this.errorClass)
        this.$component.elements.error
            .html('')
            .removeClass(this.activeClass)
    }

    getName() {
        return this.$component.elements.field.attr('name')
    }

    handleFileChange = event => {
        const fileName = this.$component.elements
            .field[0]
            .files[0]
            .name

        this.$component.elements
            .label
            .text(fileName)
    };

    handleFilterEvent = (event) => {
        const url = this.$component.find('option:selected').val()

        if (url.length > 0) {
            window.location.href = url;
        }
    };

    handleInputFill = event => {
        if (this.$component.elements.field.val()) {
            this.$component.addClass(this.filledClass)
        } else {
            this.$component.removeClass(this.filledClass)
        }
    };
}