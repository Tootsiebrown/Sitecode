export default class QuillImageAltText {

    constructor(quill) {
        this.quill = quill
        this.addEvents()
    }

    addEvents = () => {
        this.quill.root.addEventListener('click', this.handleClick, false)
        this.quill.on('text-change', (index, delta, source) => {
            if (source == 'user') {
                this.repositionElements()
            }
        })
        document.addEventListener('keydown', this.checkKeyDown, true)
        document.addEventListener('keyup', this.checkAlt, true)
    };

    handleClick = (event) => {
        if (this.eventIsImage(event) && this.img === event.target) {
            return
        }
        if (this.eventIsImage(event) && this.img) {
            this.hide()
        }
        if (this.eventIsImage(event)) {
            this.show(event.target)
        }
        if (!this.eventIsImage(event) && this.img) {
            this.hide()
        }
    };

    checkKeyDown = (event) => {
        if ((this.img && this.isDeletingImage(event)) || (event.keyCode == '13' && document.activeElement == this.field)) {
            event.preventDefault()
        }

        if (event.keyCode == '13' && document.activeElement == this.field) {
            this.hide()
        }
    }

    eventIsImage = (event) => {
        if (event.target && event.target.tagName && event.target.tagName.toUpperCase() === 'IMG') {
            return true
        }
        return false
    };

    show = (img) => {
        this.img = img
        this.showField()
    };

    showField = () => {
        const parent = this.quill.root.parentNode
        const imgRect = this.img.getBoundingClientRect()
        const containerRect = parent.getBoundingClientRect()
        const altText = this.img.getAttribute('alt')

        if (this.field) {
            this.hide()
        }

        this.quill.setSelection(null)

        this.fieldContainer = document.createElement('div')
        this.fieldInputContainer = document.createElement('div')
        this.fieldText = document.createTextNode('Alt text: ')
        this.fieldContainer.appendChild(this.fieldText)

        // Create and add the field
        this.field = document.createElement('input')
        this.field.setAttribute('type', 'text')

        Object.assign(this.fieldInputContainer.style, {
            display: 'inline-block'
        })

        if (altText != null) {
            this.field.setAttribute('value', altText)
        }

         Object.assign(this.fieldContainer.style, {
            left: `${imgRect.left - containerRect.left - 1 + parent.scrollLeft}px`,
            top: `${imgRect.bottom - containerRect.top + parent.scrollTop + 2}px`,
            maxWidth: `${imgRect.width * 0.8}px`,
            background: 'rgba(220,220,220,0.9)',
            border: '1px solid rgba(200,200,200,0.9)',
            padding: '2px 2px 2px 4px',
            position: 'absolute'
        })

        this.fieldInputContainer.appendChild(this.field)
        this.fieldContainer.appendChild(this.fieldInputContainer)
        this.quill.root.parentNode.appendChild(this.fieldContainer)
    };

    isDeletingImage = (event) => {
        if ((event.keyCode == 46 || event.keyCode == 8) && document.activeElement != this.field) {
            return true
        }

        return false
    };

    checkAlt = (event) => {
        if (this.img) {
            if (this.isDeletingImage(event)) {
                this.hide()
                return
            }

            const altText = this.field.value
            this.img.setAttribute('alt', altText)
        }
    };

    hideField = () => {
        if (!this.field) {
            return;
        }

        document.removeEventListener('keydown', this.checkKeyDown)
        document.removeEventListener('keyup', this.checkAlt)

        // Remove the overlay
        this.quill.root.parentNode.removeChild(this.fieldContainer);
        this.field = undefined
        this.fieldContainer = undefined
        this.fieldInputContainer = undefined
        this.fieldText = undefined
    };

    repositionElements = () => {
        if (!this.fieldContainer || !this.img) {
            return;
        }

        // position the overlay over the image
        const parent = this.quill.root.parentNode
        const imgRect = this.img.getBoundingClientRect()
        const containerRect = parent.getBoundingClientRect()

         Object.assign(this.fieldContainer.style, {
            left: `${imgRect.left - containerRect.left - 1 + parent.scrollLeft}px`,
            top: `${imgRect.bottom - containerRect.top + parent.scrollTop + 2}px`
        })
    };

    hide = () => {
        this.hideField();
        this.img = undefined;
    };
}
