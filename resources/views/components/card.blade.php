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
    <div class="p-3 w-full justify-between border-t border-gray-300">
        {{ $foot }}
    </div>
    @endisset
</div>