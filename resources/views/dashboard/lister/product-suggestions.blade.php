<table class="table table-bordered table-striped table-responsive">

    @foreach($products as $product)
        <tr class="product-suggestion" data-component="product-suggestion">
            <td width="100">
                <img src="{{ $product->featured_image ? $product->featured_image->thumb_url : media_url() }}" class="thumb-listing-table" alt="">
            </td>
            <td>
                <a
                  href="#modal-product-details-{{ $product->id }}"
                  data-element="modalTrigger"
                >{{ $product-> name }} <i class="fa fa-info-circle"></i></a>
                <hr />

                <ul class="product-suggestion__actions">
                    <li>
                        <a
                            href="{{ route('lister.newListing', ['product' => $product->id]) }}"
                            class=""
                        ><i class="fa fa-plus"></i> Create Listing For This Product</a>
                    </li>

                    <li>
                        <a
                            href="{{ route('lister.cloneProduct', ['product' => $product->id]) }}"
                            class=""
                        ><i class="fa fa-clone"></i> Clone Product for Listing</a>
                    </li>

                    <li>
                        <a
                            href="{{ route('lister.productForm', ['product' => $product->id, 'action' => 'edit']) }}"
                            class=""
                        ><i class="fa fa-edit"></i> Edit Existing Product for New Listing</a>
                    </li>
                </ul>

                <div id="modal-product-details-{{ $product->id }}" class="white-popup mfp-hide">
                    <div class="product-suggestion__details-container">
                        <h1>{{ $product->name }}</h1>
                        <p>UPC: {{ $product->upc }}</p>
                        <p>Original Price: {{ $product->original_price }}</p>
                        <p>Listing Price: {{ $product->price }}</p>
                        <p>Condition: {{ $product->condition }}</p>
                        <p class="product-suggestion__label">Description</p>
                        <div class="product-suggestion__wysiwyg"><p>{!! $product->description !!}</p></div>
                        <p class="product-suggestion__label">Features</p>
                        <div class="product-suggestion__wysiwyg">{!! $product->features !!}</div>
                        <p>Brand: {{ $product->brand ? $product->brand->name : '' }}</p>
                        <p class="product-suggestion__label">Categories:</p>
                        <ul>
                            @foreach($product->categories as $category)
                                <li>{{ $category->name }}</li>
                            @endforeach
                        </ul>
                        <p class="product-suggestion__label">Images</p>
                        <ul>
                            @foreach($product->images as $image)
                                <li><img src="{{ Storage::url('uploads/images/' . $image->media_name) }}"></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach

</table>
