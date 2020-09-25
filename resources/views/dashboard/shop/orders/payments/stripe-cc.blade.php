<div class="cc-info">
    <ul>
        <li>
            <strong>
                {{ $payment->brand }} XXXX{{ substr($payment->account, -4) }}:
                {{ Currency::format($payment->amount) }}
            </strong>
        </li>
        <li><em>Billing Address:</em><br> {!! \Wax\Data::formatAddress($payment) !!}</li>
        <li>
            @if (!empty($payment->captured_at))
                <em>Captured At:</em> {{ (new Carbon\Carbon($payment->captured_at))->format('F j, Y, g:i A') }}
            @else
                <em>Authorized At:</em> {{ (new Carbon\Carbon($payment->authorized_at))->format('F j, Y, g:i A') }}
            @endif
        </li>

        <li><em>Payment Id:</em> {{ $payment->transaction_ref }}</li>
        <li><em>Balance Transaction Id:</em> {{ $payment->auth_code }}</li>
    </ul>
</div>
