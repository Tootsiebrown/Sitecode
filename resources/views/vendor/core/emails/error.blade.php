
@if ($exception instanceof Exception)
    {{ $exception->getMessage() }}
    on line {{ $exception->getLine() }} of {{ $exception->getFile() }}

    <pre>{{ $exception->getTraceAsString() }}</pre>
@else 
    {{ $exception }}
@endif
