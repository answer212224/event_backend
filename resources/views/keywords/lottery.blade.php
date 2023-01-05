<x-app-layout>
    <x-slot name="header">
        @include('keywords.header')
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            @livewire('keyword-lottery')
        </div>
</x-app-layout>
