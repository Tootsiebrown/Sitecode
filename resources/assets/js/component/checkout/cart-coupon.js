import selectComponent from "../../utilities/select-component"
import * as $ from 'jquery'
import route from 'ziggy-js';
import { Ziggy } from "ziggy-js"; // this was missing from your setup

export default class CartCoupon {
    constructor(element, options) {
        this.$component = selectComponent(element)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        this.$parent = options.parent
        this.code = this.$component.attr('data-code')
        this.$button = this.$component.find('[data-element=remove-coupon]')

        this.$component.on('submit', 'form.remove-code', this.removeCode)

        this.oldButtonText = '';
    }

    removeCode = (e) => {
        e.preventDefault();
        this.disable()

        $.ajax({
            type: 'POST',
            url: route('shop.checkout.removeCode', {code: this.code}),
            data: {"_method": "DELETE"},
            success: (data) => {
                this.$parent.refresh($(data).html())
            }
        })
    }

    unbindRemovalEvent = () => {
        this.$component.off('submit', 'form.remove-code', this.removeCode)
    }

    disable = () => {
        this.$button.prop('disabled',true)
    }
}
