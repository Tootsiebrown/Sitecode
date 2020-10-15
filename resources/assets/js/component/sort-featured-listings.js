import selectComponent from "../utilities/select-component";
import sortable from "html5sortable/dist/html5sortable.es";
import * as $ from "jquery"

export default class SortFeaturedListings {
    constructor(element) {
        this.element = element
        this.$component = selectComponent(element)
        this.$form = this.$component.closest('form');
        this.$input = this.$form.find('input[name=listing_order]');

        sortable(this.element, {
            itemSerializer: this.serializer,
        });

        sortable(this.element)[0].addEventListener('sortupdate', this.sortUpdate)
        this.sortUpdate()
    }

    serializer = (item, container) => {
        return {
            position: item.index +1,
            id: $(item.node).data('id')
        }
    }

    sortUpdate = (e) => {
        this.$input.val(JSON.stringify(sortable(this.element, 'serialize')[0].items));
    }
}
