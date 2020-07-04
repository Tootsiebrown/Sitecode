@impersonating
    <p>You're already impersonating. Nesting impersonation is not supported.</p>
@else
    <p><a href="{{ route('core::startImpersonation', ['userId' => $user['id']]) }}">Impersonate</a> user <em>{{ $user['email'] }}</em></p>
    <p>(Any unsaved changes on this page will be lost)</p>
@endImpersonating
