import selectComponent from '../utilities/select-component'
import * as $ from "jquery"
import * as datetimepicker from 'eonasdan-bootstrap-datetimepicker'
import moment from 'moment';

export default class FormControlDate {
    constructor(element) {
        this.$component = $(element)
        this.$component.datetimepicker({
            format: 'YYYY-MM-DD'
        })
    }
}
