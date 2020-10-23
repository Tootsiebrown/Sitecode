import selectComponent from "../utilities/select-component"

export default class DashboardCouponType {
    constructor(element) {
        this.$component = selectComponent(element)
        this.$select = this.$component.find('[name=type]')
        this.$select.on('change', this.handleChange)
        this.$dollars = this.$component.find('[name=dollars]').closest('div.form-group')
        this.$percent = this.$component.find('[name=percent]').closest('div.form-group')

        this.$dollars.addClass('hidden');
        this.$percent.addClass('hidden');

        this.$select.trigger('change');
    }

    handleChange = (event) => {
        this.$dollars.addClass('hidden');
        this.$percent.addClass('hidden');

        this['$' + this.$select.val()].removeClass('hidden')
    }
}
