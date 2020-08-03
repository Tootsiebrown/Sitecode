import 'velocity-animate'
import 'velocity-animate/velocity.ui'
import BarcodeReader from 'component/barcode-reader'

$(document).ready(() => {
	//Site().init()

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	})
})
