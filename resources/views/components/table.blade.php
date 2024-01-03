@props(['caption' => null, 'head' => null, 'body' => null])
<div {{ $attributes->merge(['class' => 'align-middle min-w-full overflow-x-auto rounded-xl border border-gray-300 overflow-hidden']) }}>
    <table class="min-w-full divide-y divide-gray-300 table-auto">
        
        @isset($caption)
        <caption class="text-left px-6 py-4 whitespace-no-wrap text-sm leading-5 bg-blue-500 text-white">
            {{ $caption }}
        </caption>
        @endisset

        <thead class="bg-gray-200">
            <tr>
                {{ $head }}
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-300">
            {{ $body }}
        </tbody>
    </table>
</div>