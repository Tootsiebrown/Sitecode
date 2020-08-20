<ul class="nav navbar-nav nav-taxonomies">
    <li data-component="taxonomy-nav">
        <a href="#" data-element="link">Shop By Category <i class="fa fa-sort-desc"></i></a>
        <div class="scroll-container">
            <ul>
                @foreach($categories as $category)
                    <li class="top-cat">
                        <a href="{{ $category->url }}">{{ $category->name }}</h2></a>
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
        </div>
    </li>
    <li data-component="taxonomy-nav">
        <a href="#" data-element="link">Shop By Brand <i class="fa fa-sort-desc"></i></a>
        <div class="scroll-container">
            <ul>
                @foreach($brands as $brand)
                    <li>
                        <a href="{{ $brand->url }}">{{ $brand->name }}</h2></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </li>
</ul>
