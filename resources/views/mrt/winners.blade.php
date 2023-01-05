<x-app-layout>
    <x-slot name="header">
        @include('mrt.herder')
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Table -->
            @livewire('show-winners')
        </div>

    </div>
</x-app-layout>
