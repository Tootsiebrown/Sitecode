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

        this.$input.on('change', this.handleChange)
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
                this.appendImage(data.filename, data.url)
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
        let tmpFormData = new FormData(this.$component.closest('form').get(0))
        let formData = new FormData()
        formData.set('image', tmpFormData.get('new_image'));

        return formData;
    }

    startSpinner = () => {
        this.$component.addClass('loading')
    }

    stopSpinner = () => {
        this.$component.removeClass('loading')
    }

    appendImage = (filename, url) => {
        let $element = $(`<div class="lister-product-image clearfix" data-component="lister-product-image" data-saved="false">
            <input
                type="hidden"
                name="new_images[]"
                value="${ filename }"
            />
            <label class="col-sm-4 control-label"></label>
            <div class="col-sm-8 lister-product-image__display-container">
                <div class="lister-product-image__image-wrapper"><img src="${ url }"></div>
                <a href="#" data-element="delete"><i class="fa fa-trash"></i> Delete</a>
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
