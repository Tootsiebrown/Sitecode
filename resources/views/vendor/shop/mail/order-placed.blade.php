@extends('core::emails.base')

@section('body')
    <table class="email__inner" width="100%" cellpadding="40">
        <tbody>
        <tr>
            <td>
                <h1 class="email__headline">Thank You!</h1>
                <h2 class="email__subhead">Order #{{ $order['sequence'] }}</h2>
                <p>Thank you for your purchase; you can find the details below.</p>
                @foreach ($order['payments'] as $payment)
                    <p>
                        Your {{ $payment['brand'] }} card ending in {{ substr($payment['account'], -4) }} was
                        charged {{ Currency::format($payment['amount']) }}
                        on {{ \Carbon\Carbon::parse($payment['authorized_at'])->format('F j, Y') }}
                    </p>
                @endforeach
                <table class="email-cart" width="100%" cellpadding="0" cellspacing="0">
                    <tr style="background-color: #E9ECEF;">
                        <td class="email-cart__heading" style="font-weight: 700; padding: 16px;">Order
                            #{{ $order['sequence'] }}</td>
                        <td class="email-cart__date"
                            style="padding: 16px;">{{ \Carbon\Carbon::parse($order['placed_at'])->format('m/j/y') }}</td>
                    </tr>
                    @foreach ($order['items'] as $item)
                        <tr style="background-color: #F8F9FA;">
                            <td class="email-cart__product-name"
                                style="padding: 12px 16px; border-bottom: 1px solid #E9ECEF;">
                                <a href="{{ $item['url'] }}" class="email-cart__product-link">
                                    {{ $item['name'] }}
                                </a>
                            </td>
                            <td class="email-cart__product-val"
                                style="padding: 12px 16px; border-bottom: 1px solid #E9ECEF;">{{ Currency::format($item['subtotal']) }}</td>
                        </tr>
                    @endforeach
                </table>
                <table width="100%" cellpadding="20">
                    <tr>
                        <td colspan="2" align="right">
                            <ul style="list-style: none;">
                                <li style="font-weight: 700; margin-bottom: 8px;">
                                    Subtotal: {{ Currency::format($order['item_gross_subtotal']) }}</li>
                                @foreach ($order['bundles'] as $bundle)
                                    <li style="color: #0CA678; margin-bottom: 4px;">{{ $bundle['name'] }}:
                                        -{{ Currency::format($bundle['calculated_value']) }}</li>
                                @endforeach

                                @if (!empty($order['coupon']))
                                    <li style="margin-bottom: 4px;">{{ $order['coupon']['title'] }}
                                        '{{ $order['coupon']['code'] }}':
                                        -{{ Currency::format($order['coupon']['calculated_value']) }}</li>
                                @endif

                                @if ($order['tax_subtotal'] > 0)
                                    <li style="margin-bottom: 4px;">Sales Tax
                                        ({{ $order['default_shipment']['tax_desc'] }}):
                                        + {{ Currency::format($order['tax_subtotal']) }}</li>
                                @endif

                                <li style="font-size: 18px; font-weight: 700; margin-top: 8px;">
                                    Total: {{ Currency::format($order['total']) }}</li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
@endsection
