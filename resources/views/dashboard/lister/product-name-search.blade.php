<form class="form-horizontal" method="POST" action="{{ route('lister.index') }}">
    @csrf

    <input type="hidden" name="upc" value="{{ $upc }}">

    <div class="form-group {{ $errors->has('name')? 'has-error':'' }}">
        <label for="name" class="col-sm-4 control-label">Name</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="name" value="{{ request('name') }}" name="name" placeholder="">
            {!! $errors->has('name')? '<p class="help-block">'.$errors->first('name').'</p>':'' !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>
