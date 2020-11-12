import selectComponent from '../utilities/select-component'
import * as $ from "jquery";
import Cropper from "cropperjs";

export default class ProductImage {
    constructor(element, options = {}) {

        this.$component = selectComponent(element)

        this.alreadySaved = this.$component.attr('data-saved') === 'false'
            ? false
            : true;

        this.$delete = this.$component.elements.delete
        this.$startCrop = this.$component.elements.startCrop
        this.$croppableImage = this.$component.elements.croppableImage
        this.$submitCrop = this.$component.elements.submitCrop
        this.$cancelCrop = this.$component.elements.cancelCrop
        this.$cropData = this.$component.elements.cropData
        this.$tempCropData = this.$component.elements.tempCropData
        this.$preview = this.$component.elements.preview

        this.cropperModalId = '#' + this.$component.attr('data-modal-id')

        this.$delete.on('click', this.handleDeleteClick)
        this.$startCrop.on('click', this.handleStartCrop)
        this.$submitCrop.on('click', this.handleSubmitCrop)
    }

    handleDeleteClick = (e) => {
        e.preventDefault()
        if (! confirm("Are you sure you want to delete this image?")) {
            return
        }
        let deletableImage = this.$component.find('input').val();
        this.$component.html('');
        this.$component.html('<input type="hidden" name="deletable_images[]" value="' + deletableImage + '">')

    }

    handleStartCrop = (event) => {
        event.preventDefault()
        $.magnificPopup.open({
            modal: true,
            items: {
                type: 'inline',
                src: this.cropperModalId
            },
            callbacks: {
                open: () => {
                    this.initCropper()
                    this.$cancelCrop.on('click', () => {
                        $.magnificPopup.close()
                    })
                },
                close: () => {
                    this.destroyCropper()
                    this.$cancelCrop.off('click')
                }
            }
        });


    }

    initCropper = () => {
        let image = this.$croppableImage.get(0)

        image.addEventListener('crop', this.handleCrop)

        this.cropper = new Cropper(image, {
            vewMode: 2,
            zoomOnWheel: false,
            modal: false,
        })
    }

    destroyCropper = () => {
        let image = this.$croppableImage.get(0)

        image.removeEventListener('crop', this.handleCrop)
        this.cropper.destroy()
    }

    handleCrop = (event) => {
        this.$tempCropData.val(JSON.stringify(event.detail))
    }

    handleSubmitCrop = (event) => {
        event.preventDefault()
        this.$cropData.val(this.$tempCropData.val())
        this.$preview.attr('src', this.cropper.getCroppedCanvas().toDataURL(this.getMimeType()))
        $.magnificPopup.close()
    }

    getMimeType = () => {
        let extension = this.$croppableImage.attr('src').split('.').pop()

        if (extension === 'png') {
            return 'image/png'
        } else {
            return 'image/jpeg';
        }
    }
}
