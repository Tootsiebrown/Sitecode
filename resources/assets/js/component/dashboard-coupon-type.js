import selectComponent from "../utilities/select-component"

export default class DashboardCouponType {
    constructor(element) {
        this.$component = selectComponent(element)
        this.$select = this.$component.find('[name=type]')
        this.$select.on('change', this.handleChange)
        this.$dollars = this.$component.find('[name=dollars]')
        this.$percent = this.$component.find('[name=percent]')
    }

    handleChange = (event) => {
        console.log(this.$select.val())
    }
}
