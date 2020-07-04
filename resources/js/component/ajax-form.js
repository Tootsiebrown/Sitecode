import selectComponent from 'utilities/select-component'
import CustomInput from 'component/custom-input'

const baseClass = 'form'

export default class AjaxForm {
    completeClass = baseClass + '--is-complete';
    disabledClass = baseClass + '--is-disabled';
    activeClass = baseClass + '--is-active';
    loadingClass = baseClass + '--is-loading';
    fieldsSelector = '[data-component="input"]';
    inputs = {};

    constructor(element) {
        this.$form = selectComponent(element)

        this.buildInputs()
        this.createSuccessElement()

        this.$form
            .attr('novalidate', true)
            .on('submit', this.handleSubmit)
    }

    buildInputs() {
        this.$form.find(this.fieldsSelector)
            .each((index, element) => {
                const input = new CustomInput(element)

                this.inputs[input.getName()] = input
            })
    }

    createSuccessElement() {
        if (!this.$form.elements.successMessage) {
            this.$form.append(
                $('<div />', {
                    'class': 'form__success',
                    'data-element': 'success-message'
                })
            )

            this.$form.refresh()
        }
    }

    handleError = (jqXHR, textStatus, errorThrown) => {
        const errorObject = jqXHR.responseJSON ? jqXHR.responseJSON.errors : false

        if (errorObject) { 

            $.each(errorObject, (key, value) => {
                if ($.type(value) === 'string') {
                    value = [value][0]
                }

                this.inputs[key].setError(value.join('<br />'))
            })

            const $firstError = this.$form
                .find('.input__error')
                .filter(`.${this.activeClass}`)
                .first()

            if ($firstError.length) {
                const inputName = $firstError.attr('for')

                this.inputs[inputName]
                    .$component
                    .velocity('scroll',
                        {
                            offset: -200,
                            duration: 350,
                            complete: () => {
                                this.$form
                                    .find(`#${inputName}`)
                                    .focus()
                            }
                        }
                    )
            }
        }
    };

    resetErrors() {
        $.each(this.inputs, (name, field) => field.removeError())
    }

    handleSuccess = (data, textStatus, jqXHR) => {
        this.$form.addClass(this.completeClass)

        $.each(this.inputs, (name, field) => field.disable())

        this.$form.elements.submit
            .attr('disabled', 'disabled')

        this.$form.elements.successMessage
            .append(
                $('<p />', {
                    'text': data.message
                })
            )

        this.$form
            .velocity({
                opacity: .8
            }, {
                duration: 1500,
                easing: 'easeOutCubic'
            })
            .velocity({
                opacity: 1
            }, {
                begin: () => {
                    this.$form.elements.successMessage
                        .velocity('transition.slideUpIn')
                },
                complete: () => {
                    this.$form.removeAttr('styles')
                },
                duration: 750,
                easing: [1000, 20]
            })
    };

    handleRequestStart = () => {
        this.resetErrors()

        this.$form.elements.submit
            .attr('disabled', 'disabled')
            .addClass(this.loadingClass)

        this.$form.addClass(this.disabledClass)
    };

    handleRequestEnd = () => {
        this.$form.elements.submit
            .attr('disabled', false)
            .removeClass(this.loadingClass)

        this.$form.removeClass(this.disabledClass)
    };

    handleSubmit = (event) => {
        event.preventDefault()

        if (this.$form.hasClass(this.disabledClass)) {
            return
        }

        const data = new FormData(this.$form[0])
        const url = this.$form.attr('action')

        this.handleRequestStart()

        $.ajax({
            url,
            type: 'POST',
            data,
            processData: false,
            contentType: false,
        })
        .always(this.handleRequestEnd)
        .then(this.handleSuccess)
        .fail(this.handleError)
    };
}