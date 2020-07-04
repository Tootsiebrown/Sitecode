<footer class="page-footer">
    <div class="container">
        <p class="page-footer__company">&copy; {{ date('Y') . ' ' . config('app.name') }}, All Rights Reserved</p>
        <ul class="page-footer__links">
            <li><a href="/site-information">Site Information</a></li>
            <li><a href="/terms-and-conditions">Terms and Conditions</a></li>
            <li><a href="/site-map">Site Map</a></li>
            <li>@include('site.components.ooh-logo')</li>
        </ul>
    </div>
</footer>