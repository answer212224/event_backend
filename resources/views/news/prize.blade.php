<x-app-layout>
    <x-slot name="header">
        @include('news.header')

    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">

            <livewire:add-news-prize />

            <hr class=" my-3">
            <livewire:newsprize-table />

        </div>
    </div>


</x-app-layout>
