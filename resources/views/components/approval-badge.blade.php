@props(['status' => ''])

@if ($status == 'Pending')
    <span class="py-1 px-3 text-yellow-800 bg-yellow-100 border border-yellow-300 rounded-xl text-xs"><i class="fa fa-fw fa-hourglass mr-1"></i>{{ $slot }}</span>
@endif

@if ($status == 'Approved')
    <span class="py-1 px-3 text-green-800 bg-green-100 border border-green-300 rounded-xl text-xs"><i class="fa fa-fw fa-thumbs-up mr-1"></i>{{ $slot }}</span>
@endif

@if ($status == 'Denied')
    <span class="py-1 px-3 text-red-800 bg-red-100 border border-red-300 rounded-xl text-xs"><i class="fa fa-fw fa-thumbs-down mr-1"></i>{{ $slot }}</span>
@endif