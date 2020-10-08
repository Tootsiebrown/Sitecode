<table class="dashboard-table">
    <tr>
        <th>Edit</th>
        <th>Name</th>
        <th>Listings</th>
        <th>Products</th>
        <th>Children</th>
    </tr>
    @foreach ($categories as $category)
        <tr>
            <td>
                <a href="{{ route('dashboard.categories.show', ['id' => $category->id]) }}">
                    <i class="fa fa-edit"></i>
                </a>
            </td>
            <td>
                {{ $category->name }}
            </td>
            <td>
                {{ $category->listings->count() }}
            </td>
            <td>
                {{ $category->products->count() }}
            </td>
            <td>
                {{ $category->children->count() }}
            </td>
        </tr>
    @endforeach
</table>
