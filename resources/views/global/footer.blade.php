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
    

<div class="board main-orange">
  <div class="top-block ">
    <div class="headline">Shipping Information</div>
  </div>
  <div class="description"><p>Find great Dealz on everything for Home/Garden, Electronics, Appliances, Clothes, Shoes and much more! New items are listed daily! Enjoy <b>FREE SHIPPING on purchases over $50</b> and easy <a href="/returns">returns</a>.</p>  <br> 
   <div> <p id="shipping">
   Shipping Cost
<br>
    $50 is
   FREE! |

    $30 is
   $8.99 |

    $10 is
   $5.99 |

    Less than $10 is
   $2.99
</p>
   </div>

  
    <div class="social-block main-orange">
      <div class="social-net">
        <div class="social-ball"><i class="fa fa-vk" aria-hidden="true"></i></div>
        <div class="social-ball"><i class="fa fa-facebook" aria-hidden="true"></i></div>
        <div class="social-ball"><i class="fa fa-instagram" aria-hidden="true"></i></div>
      </div>
      <div class="rating">
        <div class="social-ball"><i class="like fa fa-thumbs-o-up" aria-hidden="true"></i></div>
        <div class="social-ball bookmark"><i class="fa fa-bookmark" aria-hidden="true"></i></div>
      </div>
    </div>
    
  </div>
</div>
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
