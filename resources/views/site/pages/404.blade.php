@extends('site.layouts.gencon', [
	'page' => array_merge_recursive($page ?? [], [
		'title' => 'Page Not Found'
	])
])

@section('content')
	<div class="editable-content">
    	<p>The requested content was not found.</p>
    </div>
@endsection