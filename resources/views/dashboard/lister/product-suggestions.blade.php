<table class="table table-bordered table-striped table-responsive">

    @foreach($products as $product)
        <tr>
            <td width="100">
                <img src="{{ media_url($product->feature_img) }}" class="thumb-listing-table" alt="">
            </td>
            <td>
                {{ $product-> name }}
                <hr />

                <a href="{{ route('lister.newListing', $product->id) }}" class="btn btn-primary">Create Listing For This Product</a>
            </td>
        </tr>
    @endforeach

</table>
