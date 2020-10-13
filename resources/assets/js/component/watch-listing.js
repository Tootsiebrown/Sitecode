import selectComponent from "../utilities/select-component"
import route from 'ziggy';
import * as $ from "jquery";
import { Ziggy } from "../ziggy";
window.Ziggy = Ziggy; // this was missing from your setup

export default class WatchListing {
    constructor(element) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        this.$component = selectComponent(element)
        this.$component.on('click', this.handleClick)

    }

    handleClick = (event) => {
        event.preventDefault()
        let id = this.$component.data('id');

        $.ajax({
            type : 'POST',
            url : route('watchListing'),
            data : { id : id, action: 'add' },
            success : (data) => {
                if (data.status == 1){
                    this.$component.html(data.msg);
                }else {
                    if (data.redirect_url){
                        location.href= data.redirect_url;
                    }
                }
            }
        });
    }
}
