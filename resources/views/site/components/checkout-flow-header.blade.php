<ul class="checkout-flow">
    @foreach ($steps as $step)
        <li class="{{ $step['status'] }}">
            @if ($step['status'] === 'past')
                <a href="{{ route($step['route']) }}">{{ $step['name'] }}</a>
            @else
                <span class="{{ $step['status'] }}">{{ $step['name'] }}</span>
            @endif
        </li>
    @endforeach
</ul>
