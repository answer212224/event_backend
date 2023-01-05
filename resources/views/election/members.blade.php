<x-app-layout>
    <x-slot name="header">
        @include('election.header')
    </x-slot>

    <div class="py-12">
        <div class="flex flex-wrap items-center justify-end">


            <a href="{{ route('election.export') }}" class="mr-3"><i
                    class="fa-solid fa-file-csv fa-2x fa-bounce"></i></a>

            <form action="{{ route('election.update') }}" method="post" class="mr-3">
                @csrf
                <button><i class="fa-solid fa-sync fa-spin fa-xl"></i></button>
            </form>



        </div>
        <livewire:election-member-table />


    </div>
</x-app-layout>
