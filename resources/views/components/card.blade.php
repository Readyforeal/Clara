<div {{ $attributes->merge(['class' => 'bg-gray-50 border border-white rounded-xl shadow overflow-hidden']) }}>
    
    @isset($head)
    <div class="p-3 font-semibold border-b border-gray-300">
        {{ $head }}
    </div>
    @endisset

    @isset($body)
    <div class="p-3">
        {{ $body }}
    </div>
    @endisset

    @isset($foot)
    <div class="p-3">
        {{ $foot }}
    </div>
    @endisset
</div>