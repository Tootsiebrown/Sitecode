import selectComponent from "../../utilities/select-component";
import sortable from "html5sortable/dist/html5sortable.es";
import * as $ from "jquery"

export default class MultiImageSort {
    constructor(element) {
        this.element = element
        this.$component = selectComponent(element)
        this.$form = this.$component.closest('form');
        this.$input = this.$form.find('input[data-element=sortOrderInput]');

        sortable(this.element, {
            itemSerializer: this.serializer,
            forcePlaceholderSize: true,
            handle: '[data-element=sort-handle]'
        });

        sortable(this.element)[0].addEventListener('sortupdate', this.sortUpdate)
        sortable(this.element)[0].addEventListener('sortenter', this.sortUpdate)
        this.sortUpdate()
    }

    serializer = (item, container) => {
        let $existingImage = $(item.node).find('[data-element=existingImageId]')

        if ($existingImage.length > 0) {
            return {
                position: item.index + 1,
                id: "existing-" + $existingImage.val()
            }
        } else {
            return {
                position: item.index + 1,
                id: "new-" + $(item.node).find('[data-element=newImageFilename]').val()
            }
        }
    }

    sortUpdate = (e) => {
        console.log(sortable(this.element, 'serialize')[0].items)
        this.$input.val(JSON.stringify(sortable(this.element, 'serialize')[0].items));
    }
}
