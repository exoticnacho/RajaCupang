<!-- resources/views/filament/resources/order-resource/widgets/order-status.blade.php -->

<x-filament-widgets::widget>
    <x-filament::section>
        <ul class="flex ml-auto border-b pb-4">
            @foreach(['pending', 'completed', 'cancelled'] as $status)
                <li class="mr-8">
                    {{ ucfirst($status) }}
                    <div class="absolute mt-[10px] mx-auto w-3 h-3 rounded-full ml-4
                        {{ $this->record->status === $status ? 'bg-[#1da1f2]' : 'bg-gray-300' }}"></div>
                </li>
            @endforeach
        </ul>
    </x-filament::section>
</x-filament-widgets::widget>
