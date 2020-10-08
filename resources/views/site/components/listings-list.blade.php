<div class="listing-boxes__container @if (!isset($container) || $container === true) container @endif">
    @foreach($listings as $listing)
        @include('site.components.listings-list-item', ['listing' => $listing])
    @endforeach
</div>
