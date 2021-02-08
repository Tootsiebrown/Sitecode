<script>
    dataLayer = [];
</script>

@if (isset($googleAnalyticsDataLayer))
    @if (array_key_exists('ecommerce', $googleAnalyticsDataLayer))
        <script>
            dataLayer.push({!! json_encode($googleAnalyticsDataLayer) !!});
        </script>
    @else
        @foreach($googleAnalyticsDataLayer as $data)
            <script>
                dataLayer.push({!! json_encode($data) !!});
            </script>
        @endforeach
    @endif
@endif

@if (session('googleAnalyticsDataLayer'))
    <script>
        dataLayer.push({!! json_encode(session('googleAnalyticsDataLayer')) !!});
    </script>
@endif

@if(config('services.google_analytics.gtm_code'))
    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({
            'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','{{ config('services.google_analytics.gtm_code')}}');
    </script>
    <!-- End Google Tag Manager -->
@endif
