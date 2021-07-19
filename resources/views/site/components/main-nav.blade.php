@php
    $subnav = [
        [
            'title' => 'Sub Nav One',
            'url' => 'sub-nav-one'
        ],
        [
            'title' => 'Sub Nav Two',
            'url' => 'sub-nav-two'
        ],
        [
            'title' => 'Sub Nav Three',
            'url' => 'sub-nav-three'
        ],
    ]
@endphp

<nav class="main-nav" data-component="main-nav">
    <div class="container">
        <div class="main-nav__left">
            <a class="site-logo" href="/">Logo</a>
        </div>
        <div class="main-nav__right">
            <ul class="main-nav__list" data-element="list">
                <li data-element="item" class="main-nav__item">
                    <a class="main-nav__link" href="#">Link One</a>
                </li>
                <li data-element="item" class="main-nav__item">
                    <a class="main-nav__link" href="#">Link Two <i class="fa fa-chevron-down"></i></a>
                    @include('site.components.sub-nav', [
                        'items' => $subnav
                    ])
                </li>
                <li data-element="item" class="main-nav__item">
                    <a class="main-nav__link" href="#">Link Three</a>
                </li>
            </ul>
            <button
             class="main-nav__mobile-toggle hamburger--collapse"
             type="button"
             data-element="toggle"
            >
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
</nav>
