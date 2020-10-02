<div class="search-sidebar col-xs-3" data-component="search-sidebar">
    <div class="search-sidebar__toggle-container">
        <span>Filters</span>
        <span
            class="search-sidebar__toggle btn btn-secondary"
            data-element="sidebarToggle"
        >
            <span>Show</span> <i class="fa fa-chevron-down"></i>
        </span>
    </div>
    @if ($brand)
        <div class="search-sidebar__brand">
            <p class="label">
                Brand
                <a href="{{ route('search', array_merge($filterValues, ['brand' => null])) }}" class="clear-search">clear</a>
            </p>
            <ul>
                <li><span class="selected">{{ $brand->name }}</span></li>
            </ul>
        </div>
    @endif
    <div class="search-sidebar_text">

        <p class="label">
            Refine By
            @if (isset($filterValues['search']))
                <a href="{{ route('search', array_merge($filterValues, ['search' => null])) }}" class="clear-search">clear</a>
            @endif
        </p>
        <form method="GET" action="{{ route('search') }}">
            @php $searchValue = '' @endphp
            @foreach ($filterValues as $filterName => $value)
                @if ($filterName === 'search')
                    @php $searchValue = $value @endphp
                    @continue
                @endif
                <input type="hidden" name="{{ $filterName }}" value="{{ $value }}">
            @endforeach

            <div class="input-group">
                <input type="text" class="form-control" name="search" value="{{ $searchValue }}">
                <span class="input-group-btn">
                    <button class="btn btn-link" type="submit">@svg(magnifying-glass)</button>
                </span>
            </div>


        </form>
    </div>
    <div class="search-sidebar__type">
        <p class="label">
            Type
            @if (isset($filterValues['type']))
                <a href="{{ route('search', array_merge($filterValues, ['type' => null])) }}" class="clear-search">clear</a>
            @endif
        </p>
        <ul>
            @foreach($filterOptions['type'] as $type)
                <li>
                    @if ($type->isSelected)
                        <span class="selected">{{ $type->label }} ({{ $type->extras['count'] }})</span>
                    @else
                        <a href="{{ route('search', array_merge($filterValues, ['type' => $type->value])) }}">{{ $type->label }} ({{ $type->extras['count'] }})</a>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <div class="search-sidebar__categories">
        <p class="label">
            Category
            @if (isset($filterValues['category']))
                <a href="{{ route('search', array_merge($filterValues, ['category' => null])) }}" class="clear-search">clear</a>
            @endif
        </p>
        <ul>
            @foreach($filterOptions['category'] as $category)
                <li>
                    @if ($category->isSelected)
                        <span class="selected">{{ $category->label }} ({{ $category->extras['count'] }})</span>
                    @else
                        <a
                          href="{{ route('search', array_merge($filterValues, ['category' => $category->value])) }}"
                        >
                            {{ $category->label }} ({{ $category->extras['count'] }})
                        </a>
                    @endif
                    @if (!empty($category->extras['children']))
                        <ul>
                            @foreach($category->extras['children'] as $child)
                                <li>
                                    @if ($child->isSelected)
                                        <span class="selected">{{ $child->label }} ({{ $child->extras['count'] }})</span>
                                    @else
                                        <a
                                          href="{{ route('search', array_merge($filterValues, ['category' => $child->value])) }}"
                                        >
                                            {{ $child->label }} ({{ $child->extras['count'] }})
                                        </a>
                                    @endif
                                    @if (!empty($child->extras['children']))
                                        <ul>
                                            @foreach($child->extras['children'] as $grandchild)
                                                <li>
                                                    @if ($grandchild->isSelected)
                                                        <span class="selected">{{ $grandchild->label }} ({{ $grandchild->extras['count'] }})</span>
                                                    @else
                                                        <a
                                                          href="{{ route('search', array_merge($filterValues, ['category' => $grandchild->value])) }}"
                                                          class="{{ $child->isSelected ? 'selected' : '' }}"
                                                        >
                                                            {{ $grandchild->label }} ({{ $grandchild->extras['count'] }})
                                                        </a>
                                                        @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
