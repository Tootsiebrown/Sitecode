import selectComponent from "../../../utilities/select-component"

export default class UsageRestrictions {
    constructor(element) {
        this.$component = selectComponent(element)
        this.$select = this.$component.find('[name=usage_restrictions]')
        this.$select.on('change', this.handleChange)
        this.$permittedUses = this.$component.find('[name=permitted_uses]').closest('div.form-group')

        this.$select.trigger('change');
    }

    handleChange = (event) => {
        if (this.$select.val() !== 'once_per_user') {
            this.$permittedUses.addClass('hidden');
        } else {
            this.$permittedUses.removeClass('hidden');
        }
    }
}
