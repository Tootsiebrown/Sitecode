
@if ($exception instanceof Exception)
    {{ $exception->getMessage() }}

    @if ($exception instanceof GuzzleHttp\Exception\RequestException)
        {{ $exception->getResponse()->getBody()->getContents() }}
    @endif

    on line {{ $exception->getLine() }} of {{ $exception->getFile() }}

    <pre>{{ $exception->getTraceAsString() }}</pre>
@else
    {{ $exception }}
@endif
