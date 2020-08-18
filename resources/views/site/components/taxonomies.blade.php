<ul class="nav-taxonomies">
    <li>
        <a href="#">Shop By Category <i class="fa fa-sort-desc"></i></a>
        <ul>
            @foreach($categories as $category)
                <li>
                    <a href="{{ $category->url }}"><h2>{{ $category->name }}</h2></a>
                    @if ($category->hasChildren())
                        <ul>
                            @foreach($category->children as $child)
                                <li>
                                    <a href="{{ $child->url }}">{{ $child->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </li>
    <li>
        <a href="#">Shop By Brand <i class="fa fa-sort-desc"></i></a>
        <ul>

        </ul>
    </li>
</ul>
