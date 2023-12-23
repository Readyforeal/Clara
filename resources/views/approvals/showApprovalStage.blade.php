<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ $approvalStage->name }}
        </h2>
    </x-slot>

    <div class="px-6">

        <p>{{ $approvalStage->description }}</p>

        <div class="mt-3 flex justify-between">
            <x-secondary-button-link icon="pen" url="/approval-stages/{{ $approvalStage->id }}/edit">Edit Approval Stage</x-secondary-button-link>
        </div>

        <div class="mt-3 p-3 bg-white border border-gray-300 rounded-md overflow-hidden">
            <div class="mt-3">
                @foreach ($approvalStage->approvals as $approval)
                    <p>{{ $approval }}</p>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>