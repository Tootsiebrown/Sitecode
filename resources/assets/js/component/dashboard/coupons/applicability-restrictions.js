import selectComponent from "../../../utilities/select-component"

export default class ApplicabilityRestrictions {
    constructor(element) {
        this.$component = selectComponent(element)
        this.$which = this.$component.elements.which

        this.$category = this.$component.find('[name=category_id]')
        this.$category.on('change', this.handleCategoryChange)
        this.$categoryWrapper = this.$component.elements.categoryWrapper

        this.$listing = this.$component.find('[name=listing_id]')
        this.$listing.on('change', this.handleListingChange)
        this.$listingWrapper = this.$component.elements.listingWrapper

        this.$category.trigger('change');
        this.$listing.trigger('change');
    }

    handleCategoryChange = (event) => {
        if (this.$category.val() != '') {
            this.$listingWrapper.addClass('hidden')
            this.$which.val('category')
        } else {
            this.$listingWrapper.removeClass('hidden')
            this.$which.val('')
        }
    }

    handleListingChange = (event) => {
        if (this.$listing.val() != '') {
            this.$categoryWrapper.addClass('hidden')
            this.$which.val('listing')
        } else {
            this.$categoryWrapper.removeClass('hidden')
            this.$which.val('')
        }
    }
}
