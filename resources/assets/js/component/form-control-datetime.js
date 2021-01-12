import selectComponent from '../utilities/select-component'
import * as $ from "jquery"
import * as datetimepicker from 'eonasdan-bootstrap-datetimepicker'
import moment from 'moment';

export default class FormControlDatetime {
    constructor(element) {
        this.$component = $(element)
        let defaultDate = moment();
        defaultDate.add(2, 'days');
        defaultDate.hour(12)
        defaultDate.minute(0)
        this.$component.datetimepicker({
            defaultDate,
            format: 'YYYY-MM-DD HH:mm'
        })
    }
}
