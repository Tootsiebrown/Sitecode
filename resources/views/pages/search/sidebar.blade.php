<div class="search-sidebar col-xs-3" data-component="search-sidebar">
    <div class="search-sidebar__toggle-container">
        <span>Filters</span>
        <span class="search-sidebar__toggle btn btn-secondary" data-element="sidebarToggle">
            <span>Show</span> <i class="fa fa-chevron-down"></i>
        </span>
    </div>
    {{-- @if ($brand)--}}
    {{-- <div class="search-sidebar__brand">--}}
    {{-- <p class="label">--}}
    {{-- Brand--}}
    {{-- <a href="{{ route('search', array_merge($filterValues, ['brand' => null])) }}" class="clear-search">clear</a>--}}
    {{-- </p>--}}
    {{-- <ul>--}}
    {{-- <li><span class="selected">{{ $brand->name }}</span></li>--}}
    {{-- </ul>--}}
    {{-- </div>--}}
    {{-- @endif--}}
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
                <button id="buttonProperty"><a href="{{ route('search', array_merge($filterValues, ['type' => $type->value])) }}">{{ $type->label }} ({{ $type->extras['count'] }})</a></button>
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
            @foreach(collect($filterOptions['category'])->sortBy('label') as $category)
            @if ($category->extras['secret'] && !$category->isSelected && !$category->extras['childSelected'])
            @continue;
            @endif
            <li>
                @if ($category->isSelected)
                <button id="buttonProperty"><span class="selected">{{ $category->label }} ({{ $category->extras['count'] }})</span></button>
                @elseif ($category->extras['count'] > 0)
                <button id="buttonProperty"><a href="{{ route('search', array_merge($filterValues, ['category' => $category->value])) }}">
                    {{ $category->label }} ({{ $category->extras['count'] }})
                </a></button>
                @endif
                @if (!empty($category->extras['children']))
                <ul>
                    @foreach(collect($category->extras['children'])->sortBy('label') as $child)
                    <li>
                        @if ($child->isSelected)
                        <button id="buttonProperty"><span class="selected">{{ $child->label }} ({{ $child->extras['count'] }})</span></button>
                        @elseif ($child->extras['count'] > 0)
                        <button id="buttonProperty"><a href="{{ route('search', array_merge($filterValues, ['category' => $child->value])) }}">
                            {{ $child->label }} ({{ $child->extras['count'] }})
                        </a></button>
                        @endif
                        @if (!empty($child->extras['children']))
                        <ul>
                            @foreach(collect($child->extras['children'])->sortBy('label') as $grandchild)
                            <li>
                                @if ($grandchild->isSelected)
                                <span class="selected">{{ $grandchild->label }} ({{ $grandchild->extras['count'] }})</span></button>
                                @elseif ($grandchild->extras['count'] > 0)
                                <button id="buttonProperty"><a href="{{ route('search', array_merge($filterValues, ['category' => $grandchild->value])) }}" class="{{ $child->isSelected ? 'selected' : '' }}">
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


    <!-- Search Result Filters  -->

    <div class="search-sidebar__categories">

        @if (count($extraProperties) > 1)
            <p class="label">
                <span class="moreFilters">More Filters</span>

                @if(count($extraProperties) > 1)
                    @php
                        $params = [];
                        if(Request::hasAny(['category', 'search'])){
                            $params = Request::only(['category', 'search']);
                        }
                    @endphp
                    <a href="{{ route('search', $params) }}" class="clear-search">clear</a>
                @endif
	    </p>

 		@if(count($extraProperties['gender']) > 0)
                <div class="mt-3">
                    <div class="flex flex-col">
                        <div class="filter-parent">By Gender</div>
                        <div class="flex flex-wrap mt-2 text-red-500" id="gender-property">
                            @foreach($extraProperties['gender'] as $genderProperty)
                                @if(strlen($genderProperty) > 0)
                                    @php
                                        $url = request()->fullUrl();
                                        if(!in_array($genderProperty, $optionalParams['gender'])){
                                        if(Request::hasAny(['category', 'search', 'color', 'gender', 'size'])){
                                            $url = $url . "&";
                                        }else{
                                            $url = $url . "?";
                                        }
                                            $url = $url . http_build_query(['gender[]' => $genderProperty]);
                                        }else{
                                            if(in_array($genderProperty, $optionalParams['gender'])){
                                                $requestSize = Request::all();
                                                array_splice($requestSize['gender'], array_search($genderProperty, $requestSize['gender']), 1);
                                                $url =  url()->current() . '?';

                                                $url =  $url . http_build_query($requestSize);
                                            }else{
                                                $url = $url . http_build_query(['gender[]' => $genderProperty]);
                                            }
                                        }
                                    @endphp
                                    <button class="py-1 mx-1 mt-4 rounded-lg gender-property-class border-theme-green extra-prop"id="buttonProperty">
                                        <a href="{{ $url }}" class="@if(in_array($genderProperty, $optionalParams['gender']))
                                         text-white py-1 rounded bg-theme-green
                                        @endif px-3 py-2">{{ $genderProperty }}</a>
                                    </button>
                                @endif
                            @endforeach

                            @if($extraProperties['gender']->count() > 19)
                                <div class="mt-3 text-2xl font-bold cursor-pointer theme-green" onClick="showAllGenders()" id="moreGender">more..</div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif


            @if(count($extraProperties['size']) > 0)
                <div class="mt-3">
                    <div class="flex flex-col">
                        <div class="filter-parent font-bold-400">By Size</div>

                        <div class="flex flex-wrap mt-2 text-red-500" id="size-property">
                            @foreach($extraProperties['size'] as $size)
                                @if(strlen($size) > 0)
                                    @php
                                        $url = request()->fullUrl();
                                        if(!in_array($size, $optionalParams['size'])){
                                        if(Request::hasAny(['category', 'search', 'color', 'gender', 'size'])){
                                            $url = $url . "&";
                                        }else{
                                            $url = $url . "?";
                                        }
                                            $url = $url . http_build_query(['size[]' => $size]);
                                        }else{
                                            if(in_array($size, $optionalParams['size'])){
                                                $requestSize = Request::all();
                                                array_splice($requestSize['size'], array_search($size, $requestSize['size']), 1);
                                                $url =  url()->current() . '?';

                                                $url =  $url . http_build_query($requestSize);
                                            }else{
                                                $url = $url . http_build_query(['size[]' => $size]);
                                            }
                                        }
                                    @endphp
                                    <button class="py-1 mx-1 mt-4 rounded-lg border-theme-green extra-prop size-property-class"id="buttonProperty">
                                        <a href="{{ $url }}" class="@if(in_array($size, $optionalParams['size']))
                                         text-white py-1 rounded bg-theme-green
                                        @endif px-3 py-2">{{ $size }}</a>
                                    </button>
                                @endif
                            @endforeach

                            @if(count($extraProperties['size']) > 19)
                                <div class="my-auto mt-3 text-2xl font-bold cursor-pointer theme-green" onClick="showAllSizes()" id="moreSize">more..</div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            @if(count($extraProperties['color']) > 0)
                <div class="mt-3">
                    <div class="flex flex-col">
                        <div class="filter-parent font-bold-400">By Color</div>
                        <div class="flex flex-wrap mt-2 text-red-500" id="color-property">
                            @foreach($extraProperties['color'] as $colorProperty)
                                @if(strlen($colorProperty) > 0)
                                   @php
                                        $url = request()->fullUrl();
                                        if(!in_array($colorProperty, $optionalParams['color'])){
                                        if(Request::hasAny(['category', 'search', 'color', 'gender', 'size'])){
                                            $url = $url . "&";
                                        }else{
                                            $url = $url . "?";
                                        }
                                            $url = $url . http_build_query(['color[]' => $colorProperty]);
                                        }else{
                                            if(in_array($colorProperty, $optionalParams['color'])){
                                                $requestSize = Request::all();
                                                array_splice($requestSize['color'], array_search($colorProperty, $requestSize['color']), 1);
                                                $url =  url()->current() . '?';

                                                $url =  $url . http_build_query($requestSize);
                                            }else{
                                                $url = $url . http_build_query(['color[]' => $colorProperty]);
                                            }
                                        }
                                    @endphp
                                    <button class="py-1 mx-1 mt-4 rounded-lg color-property-class border-theme-green extra-prop"id="buttonProperty">
                                        <a href="{{ $url }}" class="@if(in_array($colorProperty, $optionalParams['color']))
                                         text-white py-1 rounded bg-theme-green
                                        @endif px-3 py-2">{{ $colorProperty }}</a>
                                    </botton>
                                @endif
                            @endforeach

                            @if(count($extraProperties['color']) > 19)
                                <div class="mt-3 text-2xl font-bold cursor-pointer theme-green" onClick="showAllColors()" id="moreColor">more..</div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endif

    </div>

    <script>

        //Show 8 properties
        let sizeProperty = document.querySelectorAll('#size-property .size-property-class');
        let colorProperty = document.querySelectorAll('#color-property .color-property-class');
        let genderProperty = document.querySelectorAll('#gender-property .gender-property-class');

        let fullSizeList = false;
        let fullColorList = false;
        let fullGenderList = false;


        function showAllSizes(){
            let iterate = (fullSizeList ? sizeProperty.length : 20);
            iterate = sizeProperty.length < 20 ? sizeProperty.length : iterate;
            for(let i=0; i < iterate; i++){

                if(!fullSizeList){
                    sizeProperty[i].classList.remove('hidden');
                    if(i==7){
                        for(let j=iterate; j < sizeProperty.length; j++){
                            sizeProperty[j].classList.add('hidden');
                        }
                    }
                    if(document.getElementById('moreSize')){
                        document.getElementById('moreSize').innerHTML="more..";
                    }
                }else{
                    sizeProperty[i].classList.remove('hidden');
                    if(document.getElementById('moreSize')){
                        document.getElementById('moreSize').innerHTML="less..";
                    }
                }
            }

            fullSizeList = !fullSizeList;
        }

        function showAllColors(){
            let iterate = (fullColorList ? colorProperty.length : 20);
            iterate = colorProperty.length < 20 ? colorProperty.length : iterate;
            for(let i=0; i < iterate; i++){

                if(!fullColorList){
                    colorProperty[i].classList.remove('hidden');
                    if(i==7){
                        for(let j=iterate; j < colorProperty.length; j++){
                            colorProperty[j].classList.add('hidden');
                        }
                    }
                    if(document.getElementById('moreColor')){
                        document.getElementById('moreColor').innerHTML="more..";
                    }
                }else{
                    if(document.getElementById('moreColor')){
                        document.getElementById('moreColor').innerHTML="less..";
                    }
                    colorProperty[i].classList.remove('hidden');
                }
            }

            fullColorList = !fullColorList;
        }

        function showAllGenders(){
            let iterate = (fullGenderList ? genderProperty.length : 20);
            iterate = genderProperty.length < 20 ? genderProperty.length : iterate;
            for(let i=0; i < iterate; i++){

                if(!fullGenderList){
                    genderProperty[i].classList.remove('hidden');
                    if(i==7){
                        for(let j=iterate; j < genderProperty.length; j++){
                            genderProperty[j].classList.add('hidden');
                        }
                    }
                    if(document.getElementById('moreGender')){
                        document.getElementById('moreGender').innerHTML="more..";
                    }
                }else{
                    if(document.getElementById('moreGender')){
                        document.getElementById('moreGender').innerHTML="less..";
                    }
                    genderProperty[i].classList.remove('hidden');
                }
            }

            fullGenderList = !fullGenderList;
        }

        showAllSizes();
        showAllColors();
        showAllGenders();

        let data= {};

        function loadQueryParams(filter, value){
            document.getElementById('form1').submit();
        }
    </script>
</div>
