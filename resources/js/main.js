import 'velocity-animate'
import 'velocity-animate/velocity.ui'
import Site from 'site'

$(document).ready(() => {
	Site().init()

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	})
})