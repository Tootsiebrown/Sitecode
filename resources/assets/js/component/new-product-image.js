import selectComponent from '../utilities/select-component'
import * as $ from "jquery";
import ProductImage from "./product-image";

export default class NewProductImage {
    constructor(element, options = {}) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        this.$component = selectComponent(element)
        this.$input = this.$component.elements.input
        this.$spinner = this.$component.elements.spinner
        this.$message = this.$component.elements.message
        this.type = this.$component.attr('data-type')

        this.$input.on('change', this.handleChange)
        this.newImageId = 1;
    }

    handleChange = () => {
        this.startSpinner()
        $.ajax({
            type:'POST',
            url: this.$input.attr('data-action'),
            data: this.getFormData(),
            cache:false,
            contentType: false,
            processData: false,
            success:(data) => {
                console.log("success");
                console.log(data);
                $.each(data.images, (i, image) => {
                    this.appendImage(image.filename, image.url, this.newImageId)
                    this.newImageId++
                });
                this.stopSpinner()
                this.resetInput()
            },
            error: (data) => {
                console.log("error");
                console.log(data);
                this.stopSpinner()
                this.showMessage()
            }
        });
    }

    getFormData = () => {
        let formData = new FormData()

        $.each(this.$input.get(0).files, function (i, file) {
            formData.append('image[]', file);
        });

        formData.append('type', this.type)

        return formData;
    }

    startSpinner = () => {
        this.$component.addClass('loading')
    }

    stopSpinner = () => {
        this.$component.removeClass('loading')
    }

    appendImage = (filename, url, imageId) => {
        let $element = $(`<div class="lister-product-image clearfix"
          data-component="lister-product-image"
          data-saved="false"
          data-modal-id="image-cropper-popup-new-${ imageId }"
        >
            <input
              type="hidden"
              name="new_images[]"
              value="${ filename }"
            />
            <input
              type="hidden"
              name="new_images_metadata[${ filename }]"
              value=""
              data-element="cropData"
            >
            <label class="col-sm-4 control-label"></label>
            <div class="col-sm-8 lister-product-image__display-container">
                <div class="lister-product-image__image-wrapper">
                    <img src="${ url }" alt="an image" data-element="preview">
                </div>
                <a class="lister-product-image__control btn btn-default" href="#" data-element="delete">
                    <i class="fa fa-trash"></i>
                </a>
                <a class="lister-product-image__control btn btn-default" href="#" data-element="startCrop">
                    <i class="fa fa-crop"></i>
                </a>
            </div>
            <div class="mfp-hide image-field__cropper-modal" id="image-cropper-popup-new-${ imageId }">
                <div class="image-field__cropper-wrapper">
                    <img class="image-field__croppable-image" src="${ url }" data-element="croppableImage" alt="">
                </div>
                <div class="image-field__actions">
                    <input type="hidden" name="tempCropData" data-element="tempCropData">
                    <button class="btn btn-primary" data-element="submitCrop">Crop</button>
                    <button class="btn btn-secondary" data-element="cancelCrop">Cancel</button>
                </div>
            </div>
        </div>`)

        $('.images-wrapper').append($element);
        new ProductImage($element)
    }

    resetInput = () => {
        this.$input.val('')
    }

    showMessage = (message) => {
        this.$message.html(message)
    }
}
