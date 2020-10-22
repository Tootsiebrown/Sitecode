import selectComponent from "../../utilities/select-component"
import * as $ from 'jquery'
import route from 'ziggy';
import { Ziggy } from "../../ziggy";
window.Ziggy = Ziggy; // this was missing from your setup

export default class CheckoutSidebarCart {
    constructor(element) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        this.$component = selectComponent(element)

        this.$component.on('submit', 'form.remove-code', this.removeCode)
        this.$component.on('submit', 'form.apply-code', this.applyCode)

        this.oldButtonText = '';
    }

    applyCode = (e) => {
        e.preventDefault();
        this.disable()

        $.ajax({
            type: 'POST',
            url: route('shop.checkout.applyCode'),
            data: {code: this.$component.find('[name=code]').val()},
            success: (data) => {
                this.$component.html($(data).html())
            }
        })
    }

    removeCode = (e) => {
        e.preventDefault();
        this.disable()

        $.ajax({
            type: 'POST',
            url: route('shop.checkout.removeCode'),
            data: {"_method": "DELETE"},
            success: (data) => {
                this.$component.html($(data).html())
            }
        })
    }

    disable = () => {
        let $button = this.$component.find('button')
        this.oldButtonText = $button.html()

        $button.prop('disabled',true)
        $button.html('<img alt="loading..." src="/assets/img/loading-spinner.gif" class="code-loading-spinner">')
    }
}
