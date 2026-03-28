@props([
    'amount' => 0,
    'period' => null,
])

<span {{ $attributes }}>
    {{ \App\Support\KenyaCurrency::format($amount) }}
    @if ($period)
        <span class="font-medium text-emerald-100">/{{ $period }}</span>
    @endif
</span>
