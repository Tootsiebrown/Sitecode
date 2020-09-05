<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="/assets/img/catchndealz.svg" title="{{get_option('site_name')}}" alt="{{get_option('site_name')}}" />
            </a>

            <!-- Search -->
            <div class="navbar-search-wrap more mobile-search">
                <form
                    action="{{route('search_redirect')}}"
                    class="form-inline"
                    method="get"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <div class="input-group focusable" data-component="focusable-input-group">
                        <input
                            type="text"
                            class="form-control searchKeyword"
                            name="q"
                            placeholder="@lang('app.what_are_u_looking_short')"
                            data-element="input"
                        >
                        <span class="input-group-btn">
                                <button class="btn btn-link" type="submit">@svg(magnifying-glass)</button>
                            </span>
                    </div>

                </form>
            </div>

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>


        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <div class="navbar-left">
                <div class="navbar-search-wrap more desktop-search ">
                    <form action="{{route('search_redirect')}}" class="form-inline" method="get" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group focusable" data-component="focusable-input-group">
                            <input
                                type="text"
                                class="form-control"
                                id="searchKeyword"
                                name="q"
                                placeholder="@lang('app.what_are_u_looking')"
                                data-element="input"
                            >
                            <span class="input-group-btn">
                                    <button class="btn btn-link" type="submit">@svg(magnifying-glass)</button>
                                </span>
                        </div>
                    </form>
                </div>

                @render(App\ViewComponents\TaxonomiesComponent::class)
            </div>



            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right nav-sarchbar">
                <li class="nav-cart__container" data-component="nav-cart">
                    <a href="/cart" class="btn btn-link nav-cart__button" data-element="link">
                        @render(App\ViewComponents\CartCountComponent::class)
                        @svg(cart)
                        <span>My Cart</span>
                    </a>
                    @render(App\ViewComponents\NavCartComponent::class)
                </li>

                <!-- Authentication Links -->
                <li>
                    <a href="{{ Auth::guest() ? route('login') : route('profile') }}" class="btn btn-link profile">
                        @svg(profile)
                        <span>{{ Auth::guest() ? trans('app.login') : 'My Profile' }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
