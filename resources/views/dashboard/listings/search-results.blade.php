<table class="table table-bordered table-striped table-responsive">

    @foreach($listings as $listing)
        <tr class="listing-result" data-component="listing-result">
            <td width="100">
                <img src="{{ $listing->featured_image ? $listing->featured_image->thumb_url : media_url() }}" class="thumb-listing-table" alt="">
            </td>
            <td>
                <a
                  href="#modal-listing-details-{{ $listing->id }}"
                  data-element="modalTrigger"
                >{{ $listing->title }} <i class="fa fa-info-circle"></i></a>
                <p>Listing SKU: {{ $listing->id }}</p>
                <p>Product SKU: {{ $listing->product_id }}</p>
                <hr />

                <ul class="listing-results__actions">
                    <li>
                        <a
                            href="{{ route('dashboard.listings.showEdit', ['id' => $listing->id]) }}"
                            class=""
                        ><i class="fa fa-edit"></i> Edit Listing</a>
                    </li>

                    <li>
                        <a
                            href="{{ route('dashboard.listings.delete', ['id' => $listing->id]) }}"
                            class=""
                        ><i class="fa fa-trash"></i> Delete (not implemented)</a>
                    </li>
                </ul>

                <div id="modal-listing-details-{{ $listing->id }}" class="white-popup mfp-hide">
                    <div class="listing-results__details-container">
                        <h1>{{ $listing->title }}</h1>
                        <p>Product SKU: {{ $listing->id }}</p>
                        <p>UPC: {{ $listing->upc }}</p>
                        <p>Original Price: {{ $listing->original_price }}</p>
                        <p>Listing Price: {{ $listing->price }}</p>
                        <p>Condition: {{ $listing->condition }}</p>
                        <p class="listing-results__label">Description</p>
                        <div class="listing-results__wysiwyg"><p>{!! $listing->description !!}</p></div>
                        <p class="listing-results__label">Features</p>
                        <div class="listing-results__wysiwyg">{!! $listing->features !!}</div>
                        <p>Brand: {{ $listing->brand ? $listing->brand->name : '' }}</p>
                        <p class="listing-results__label">Categories:</p>
                        <ul>
                            @foreach($listing->categories as $category)
                                <li>{{ $category->name }}</li>
                            @endforeach
                        </ul>

                        <p class="listing-results__label">Optional Fields:</p>
                        <ul>
                            @foreach ([
                                'gender' => 'Gender',
                                'model_number' => 'Model Number',
                                'color' => 'Color',
                                'bin' => 'Bin',
                                'expiration_date' => 'Expiration Date',
                                'dimensions' => 'Dimensions',
                            ] as $fieldName => $fieldLabel)
                                @if( $listing->$fieldName)
                                    <li>{{ $fieldLabel }}: {{ $listing->$fieldName }}</li>
                                @endif
                            @endforeach
                        </ul>
                        <p class="listing-results__label">Images</p>
                        <ul class="listing-results__images">
                            @foreach($listing->images as $image)
                                <li><img src="{{ $image->url }}"></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach

</table>
