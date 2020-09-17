<div class="search-sidebar col-xs-3">
    @if ($brand)
        <div class="search-sidebar__brand">
            <p class="label">Brand</p><br>
            {{ $brand->name }}
            <a href="{{ route('search', array_merge($searchState, ['brand' => null])) }}" class="btn btn-secondary cancel-search">x</a>
        </div>
    @endif
    <div class="search-sidebar_text">
        <p class="label">Refine By</p>
        <form method="GET" action="{{ route('search') }}">
            @if ($searchState['category'])
                <input type="hidden" name="category" value="{{ $searchState['category'] }}">
            @endif
            @if ($searchState['brand'])
                <input type="hidden" name="brand" value="{{ $searchState['brand'] }}">
            @endif
            @if ($searchState['type'])
                <input type="hidden" name="type" value="{{ $searchState['type'] }}">
            @endif
            <div class="input-group">
                <input type="text" class="form-control" name="search" value="{{ $searchState['search'] }}">
                <span class="input-group-btn">
                                            <button class="btn btn-link" type="submit">@svg(magnifying-glass)</button>
                                        </span>
            </div>


        </form>
    </div>
    <div class="search-sidebar__categories">
        <p class="label">Category</p>
        <ul>
            @if($categoryLevel === 1)
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('search', array_merge($searchState, ['category' => $category['id']])) }}">{{ $category['name'] }}</a>
                        @if ($level1Cat && $level1Cat->id === $category['id'])
                            <a href="{{ route('search', array_merge($searchState, ['category' => null])) }}" class="btn btn-secondary cancel-search">x</a>
                            <ul>
                                @php
                                    $level2Categories = $categories->filter(function($category) use ($level1Cat) {
                                        return $category['id'] === $level1Cat->id;
                                    })
                                    ->first()['children'];
                                @endphp
                                @foreach($level2Categories as $category)
                                    <li>
                                        <a href="{{ route('search', array_merge($searchState, ['category' => $category['id']])) }}">{{ $category['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @else
                <li><a href="{{ $level1Cat->url }}">{{ $level1Cat->name }}</a></li>
                @php
                    $level2Categories = $categories->filter(function($category) use ($level1Cat) {
                        return $category['id'] === $level1Cat->id;
                    })
                    ->first()['children'];
                @endphp
                <ul>
                    @if ($categoryLevel === 2)
                        @foreach($level2Categories as $category)
                            <li>
                                <a href="{{ route('search', array_merge($searchState, ['category' => $category['id']])) }}">{{ $category['name'] }}</a>
                                @if ($level2Cat && $level2Cat->id === $category['id'])
                                    <a href="{{ route('search', array_merge($searchState, ['category' => $level1Cat->id])) }}" class="btn btn-secondary cancel-search">x</a>
                                @endif
                            </li>
                        @endforeach
                    @else
                        @php
                            $level3Categories = $level2Categories->filter(function($category) use ($level2Cat) {
                                return $category['id'] === $level2Cat->id;
                            })
                            ->first()['children'];
                        @endphp
                        <li><a href="{{ route('search', array_merge($searchState, ['category' => $level2Cat->id])) }}">{{ $level2Cat->name }}</a></li>
                        <ul>
                            @foreach($level3Categories as $category)
                                <li>
                                    <a href="{{ route('search', array_merge($searchState, ['category' => $category['id']])) }}">{{ $category['name'] }}</a>
                                    @if ($level3Cat && $level3Cat->id === $category['id'])
                                        <a href="{{ route('search', ['category' => $level2Cat->id]) }}" class="btn btn-secondary cancel-search">x</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </ul>
            @endif
        </ul>
    </div>
</div>
