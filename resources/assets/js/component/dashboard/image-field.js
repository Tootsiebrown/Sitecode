import selectComponent from '../../utilities/select-component'
import * as $ from "jquery";
import route from "ziggy-js";
import Cropper from "cropperjs";
import "magnific-popup";

export default class ImageField {
    constructor(element) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        this.$component = selectComponent(element)
        this.allowCrop = Boolean(parseInt(this.$component.attr('data-allow-crop')))
        this.$fileInput = this.$component.elements.fileInput
        this.$filenameInput = this.$component.elements.filenameInput
        this.$image = this.$component.elements.image
        this.name = this.$filenameInput.attr('name')
        this.$spinner = this.$component.elements.spinner
        this.$message = this.$component.elements.message
        this.$delete = this.$component.elements.delete

        this.$fileInput.on('change', this.handleChange)
        this.$delete.on('click', this.handleDelete)

        if (this.allowCrop) {
            this.$startCrop = this.$component.elements.startCrop
            this.$croppableImage = this.$component.elements.croppableImage
            this.$startCrop.on('click', this.handleStartCrop)
        }

        console.log(this.name)
    }

    handleChange = () => {
        this.startSpinner()
        this.showMessage()
        console.log('handle change triggers for ' + this.name)
        $.ajax({
            type:'POST',
            url: route('dashboard.uploadImage'),
            data: this.getFormData(),
            cache:false,
            contentType: false,
            processData: false,
            success:(data) => {
                console.log("success");
                console.log(data);
                this.initializeImage(data.path, data.filename)
                this.stopSpinner()
            },
            error: (data) => {
                if (data.status === 422) {
                    this.showMessage(data.responseJSON.errors[this.name][0])
                } else {
                    this.showMessage('There was an error.')
                }
                this.stopSpinner()
            }
        });
    }

    handleDelete = (event) => {
        event.preventDefault()
        this.$filenameInput.val('')
        this.$image.attr('src', '')
        this.$image.addClass('hidden')
        this.$fileInput.removeClass('hidden')
        this.$delete.addClass('hidden');
    }

    handleStartCrop = (event) => {
        event.preventDefault()
        console.log('#image-cropper-popup-' + this.name)
        $.magnificPopup.open({
            items: {
                type: 'inline',
                src: '#image-cropper-popup-' + this.name
            },
            callbacks: {
                open: () => {
                    this.initCropper()
                },
                close: () => {
                    this.destroyCropper()
                }
            }
        });
    }

    getFormData = () => {
        let formData = new FormData()

        $.each(this.$fileInput.get(0).files, function (i, file) {
            formData.append('image', file);
        });

        formData.append('path', this.$fileInput.attr('data-path'))

        return formData;
    }

    startSpinner = () => {
        this.$component.addClass('loading')
    }

    stopSpinner = () => {
        this.$component.removeClass('loading')
    }

    initializeImage = (path, name) => {
        this.$filenameInput.val(name)
        this.$image.attr('src', path)
        this.$image.removeClass('hidden')
        this.$fileInput.addClass('hidden')
        this.$delete.removeClass('hidden');
    }

    showMessage = (message) => {
        this.$message.html(message)
    }

    concatenateErrors = (errors) => {
        let errorString = ''

        for (const key in errors) {
            errorString = errorString + ' ' + errors[key].join(' ')
        }

        return errorString
    }

    initCropper = () => {
        let image = this.$croppableImage.get(0)

        image.addEventListener('crop', this.handleCrop)

        this.cropper = new Cropper(image, {
            vewMode: 1
        })
    }

    destroyCropper = () => {
        let image = this.$croppableImage.get(0)

        image.removeEventListener('crop', this.handleCrop)
        this.cropper = undefined
    }

    handleCrop = (event) => {
        console.log(event)
    }
}
