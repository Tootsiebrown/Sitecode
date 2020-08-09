import selectComponent from '../utilities/select-component'
import ProductCategoriesChild from "./product-categories-child";
import * as  $ from 'jquery'

export default class ProductCategoriesHierarchy {
    constructor(element, options = {}) {
        this.$component = selectComponent(element)

        this.categories = window.categoryHierarchy

        this.$topSelect = this.$component.find('[data-product-categories-hierarchy-element="topSelect"]');
        this.$topSelect.on('change', this.handleChange)
        this.$childProductCategoriesComponent = new ProductCategoriesChild(
            $('[data-product-categories-hierarchy-element="child-select"]')
        )
    }

    handleChange = (e) => {
        this.$childProductCategoriesComponent.setOptions(
            this.getNewChildren()
        )

        if (this.$topSelect.val() != '') {
            this.$childProductCategoriesComponent.addClass('visible')
        } else {
            this.$childProductCategoriesComponent.removeClass('visible')
        }

        if (this.$topSelect.val() === 'new') {
            this.$childProductCategoriesComponent.value('new');
        }

        this.$childProductCategoriesComponent.trigger('change');
    }

    getNewChildren = () => {
        if (!(this.$topSelect.val() in this.categories)) {
            return {}
        }

        return this.categories[this.$topSelect.val()].children
    }
}
