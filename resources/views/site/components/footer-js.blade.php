@php
    $mapApiKey = false;

    if (App::environment() == 'dev') {
        // development Google Map API key
        // https://console.developers.google.com/apis/credentials?project=wax-app-testing-1501259534289
        $mapApiKey = 'AIzaSyDDjVAvhi_PMxqmPGpE_bjWdRM1a_uoZmk';
    }
@endphp

{{--<script src="https://maps.googleapis.com/maps/api/js?key={{ $mapApiKey }}&extension=.js"></script>--}}
{{--<script src="{{ mix('js/manifest.js') }}"></script>--}}
{{--<script src="{{ mix('js/app.js') }}"></script>--}}
{{--<script src="{{ mix('js/vendor.js') }}"></script>--}}
{{--<script src="{{ mix('js/bundle.js') }}"></script>--}}
{{--<script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>--}}
{{--{!! BugHerd::draw() !!}--}}
