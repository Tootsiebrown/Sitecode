import selectComponent from "../../utilities/select-component"
import * as $ from 'jquery'
import route from 'ziggy';
import { Ziggy } from "../../ziggy";
import SearchSidebar from "../search-sidebar";
import CartCoupon from "./cart-coupon";
window.Ziggy = Ziggy; // this was missing from your setup

export default class CheckoutSidebarCart {
    constructor(element) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        this.$component = selectComponent(element)
        this.init()

        this.$component.on('submit', 'form.apply-code', this.applyCode)

        this.oldButtonText = '';
    }

    init = () => {
        this.$button = this.$component.find('[data-element=apply-code]')
        console.log(this.$button)
        this.initCoupons()
    }

    applyCode = (e) => {
        e.preventDefault();
        this.disable()

        $.ajax({
            type: 'POST',
            url: route('shop.checkout.applyCode'),
            data: {code: this.$component.find('[name=code]').val()},
            success: (data) => {
                this.refresh($(data).html())
            }
        })
    }

    refresh = (html) => {
        this.unbindCouponRemovalEvents()
        this.$component.html(html)
        this.init()
    }

    initCoupons = () => {
        this.$coupons = selectComponent('cart-coupon').map((index, element) => new CartCoupon(element, {parent: this}))
    }

    unbindCouponRemovalEvents = () => {
        this.$coupons.each((index, $coupon) => $coupon.unbindRemovalEvent())
    }

    disableCoupons = () => {
        this.$coupons.each((index, $coupon) => $coupon.disable())
    }

    disable = () => {
        this.disableCoupons()
        this.oldButtonText = this.$button.html()

        this.$button.prop('disabled',true)
        this.$button.html('<img alt="loading..." src="/assets/img/loading-spinner.gif" class="code-loading-spinner">')
    }
}
