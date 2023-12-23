<div
    x-data="{ show: {{ session('message') ? 'true' : 'false' }} }"
    x-show="show"
    x-init="setTimeout(() => show = false, 5000)"
    {{ $attributes->merge(["class" => "fixed bottom-3 right-3 p-3 flex rounded shadow"]) }}
>
    <i class="mt-1 fa fa-fw mr-2 fa-{{ session('message.type') == 'success' ? 'check' : 'circle-exclamation' }}"></i>
    <p>{{ session('message.body') }}</p>
</div>