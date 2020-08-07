import selectComponent from '../utilities/select-component'

export default class ProductImage {
    constructor(element, options = {}) {

        this.$component = selectComponent(element)
        this.$delete = this.$component.elements.delete
        this.alreadySaved = this.$component.attr('data-saved') === 'false'
            ? false
            : true;


        this.$delete.on('click', this.handleClick)
    }

    handleClick = (e) => {
        e.preventDefault()
        if (! confirm("Are you sure you want to delete this image?")) {
            return
        }
        let deletableImage = this.$component.find('input').val();
        this.$component.html('');
        if (! this.alreadySaved) {
            this.$component.html('<input type="hidden" name="deletable_images[]" value="' + deletableImage + '">')
        }
    }
}
