</html>
</html>
    <div class="footer__top">
        
        <div class="container">
            <!-- Branding Image -->
            <a class="footer__brand" href="{{ route('home') }}">
                <img src="/assets/img/catchndealz.svg" title="{{get_option('site_name')}}" alt="{{get_option('site_name')}}" />
            </a>

            <div class="footer__social-links">
                <p>Follow Us On:</p>
                @php
                    $facebook_url = get_option('facebook_url');
                    // $twitter_url = get_option('twitter_url');
                    // $linked_in_url = get_option('linked_in_url');
                    // $dribble_url = get_option('dribble_url');
                    // $google_plus_url = get_option('google_plus_url');
                    // $youtube_url = get_option('youtube_url');
                    // $instagram_url = get_option('instagram_url');
                @endphp
                <ul>
{{--                    @if($instagram_url)--}}
{{--                        <li><a href="{{$instagram_url}}"><i class="fa fa-instagram"></i> </a> </li>--}}
{{--                    @endif--}}
                    @if($facebook_url)
                        <li><a href="{{$facebook_url}}"><i class="fab fa-facebook-f"></i></a></li>
                    @endif
{{--                    @if($twitter_url)--}}
{{--                        <li><a href="{{$twitter_url}}"><i class="fa fa-twitter"></i> </a> </li>--}}
{{--                    @endif--}}
{{--                    @if($google_plus_url)--}}
{{--                        <li><a href="{{$google_plus_url}}"><i class="fa fa-google-plus"></i> </a> </li>--}}
{{--                    @endif--}}
{{--                    @if($youtube_url)--}}
{{--                        <li><a href="{{$youtube_url}}"><i class="fa fa-youtube"></i> </a> </li>--}}
{{--                    @endif--}}
{{--                    @if($linked_in_url)--}}
{{--                        <li><a href="{{$linked_in_url}}"><i class="fa fa-linkedin"></i> </a> </li>--}}
{{--                    @endif--}}
{{--                    @if($dribble_url)--}}
{{--                        <li><a href="{{$dribble_url}}"><i class="fa fa-dribbble"></i> </a> </li>--}}
{{--                    @endif--}}
                </ul>
            </div>

        </div>
    </div>
    <div class="footer__middle">
        <div class="container">
        <div class="welcome-copy">
                <p>Find great Dealz on everything for Home/Garden, Electronics, Appliances, Clothes, Shoes and much more! New items are listed daily! Enjoy <b>FREE SHIPPING on purchases over $50</b> and easy <a href="/returns">returns</a>.</p>
                <table class="home-shipping">
                    <thead>
                        <tr>
                            <th>Spend</th>
                            <th>Shipping Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>$50</td>
                            <td>FREE!</td>
                        </tr>
                        <tr>
                            <td>$30</td>
                            <td>$8.99</td>
                        </tr>
                        <tr>
                            <td>$10</td>
                            <td>$5.99</td>
                        </tr>
                        <tr>
                            <td>Less than $10</td>
                            <td>$2.99</td>
                        </tr>
                    </tbody>
                </table>
                <p class="a-us-company">A USA Made Company</p>
            </div>

            <ul class="footer__menu">
                @php $pagesRepository = app(Wax\Pages\Contracts\PagesRepositoryContract::class) @endphp
                @foreach($pagesRepository->getTopLevel() as $page)
                    <li>
                        <a href="{{ $page->url }}">
                            {{ $page->title }} @svg(arrow)
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
            <!-- Search -->
  
    <div class="footer__corporate">
        <div class="container">
            &copy;{{ date('Y') }} Catch N Dealz. All rights reserved.
            <a href="/privacy">Privacy</a>
        </div>
    </div>
</div>
