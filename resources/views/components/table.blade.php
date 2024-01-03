<div {{ $attributes->merge(['class' => 'align-middle min-w-full overflow-x-auto rounded-xl border border-gray-300 overflow-hidden']) }}>
    <table class="min-w-full divide-y divide-gray-300">
        <thead>
            <tr>
                {{ $head }}
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-300">
            {{ $body }}
        </tbody>
    </table>
</div>