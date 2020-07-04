<div class="sub-nav">
    <ul class="sub-nav__list">
        @foreach ($items as $item)
            <li class="sub-nav__item">
                <a class="sub-nav__link" href="{{ $item['url'] }}">{{ $item['title'] }}</a>
            </li>
        @endforeach
    </ul>
</div>