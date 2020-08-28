import selectComponent from '../utilities/select-component'
import * as $ from "jquery"
import * as datetimepicker from 'eonasdan-bootstrap-datetimepicker'
import moment from 'moment';

export default class DateTimePickerWrapper {
    constructor(element, options = {}) {
        this.$component = $(element)
        let defaultDate = moment();
        defaultDate.add(2, 'days');
        defaultDate.hour(23)
        defaultDate.minute(59)
        this.$component.datetimepicker({
            defaultDate,
            format: 'YYYY-MM-DD HH:mm'
        })
    }
}
