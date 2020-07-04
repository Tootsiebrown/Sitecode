@if ($crumbs->count() > 0)
    <ul class="breadcrumbs">
    @foreach ($crumbs as $i => $crumb)
        <li>
        @if (($i < $crumbs->count() - 1 && strlen($crumb['url']) > 0) || $crumbs->count() === 1)
            <a href="{{ $crumb['url'] }}">
                @if($crumb['name'] == 'Home')
                    <i class="fa fa-home"></i>
                @else
                    {{ $crumb['name'] }}
                @endif
            </a>
        @else
            {{ $crumb['name'] }}
        @endif
        </li>
    @endforeach
    </ul>
@endif
