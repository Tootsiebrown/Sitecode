import selectComponent from "../utilities/select-component"
import * as $ from 'jquery';

export default class BillingSameAsShipping {
    constructor(element) {
        this.$component = selectComponent(element)
        this.$toggle = this.$component.elements.toggle
        this.$shipmentBillingInfo = this.$component.elements.shipmentBillingInfo
        this.$newBillingInfo = this.$component.elements.newBillingInfo;

        this.$toggle.on('change', this.handleToggle);
        this.$toggle.trigger('change');
    }

    handleToggle = (event) => {
        let checked = $(event.target).prop('checked')

        if (checked) {
            this.$shipmentBillingInfo.removeClass('hidden')
            this.$newBillingInfo.addClass('hidden');
        } else {
            this.$shipmentBillingInfo.addClass('hidden')
            this.$newBillingInfo.removeClass('hidden');
        }

    }
}
