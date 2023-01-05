<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('pets.index') }}">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('pets') }}
            </h2>
        </a>
    </x-slot>

    <div class="py-12">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <form method="GET" action="{{ route('pets.posts') }}">

                <input type="search"
                    class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Name" name="name" />
                <button
                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 hover:border-transparent rounded">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>

            </form>
            <!-- Table -->
            <div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-2">
                <header class="px-5 py-4 border-b border-gray-100">

                </header>

                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                <tr>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">name</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">story</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">from</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">votes</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">image</div>
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                                @foreach ($pets as $pet)
                                    <tr>
                                        <td class="p-2 ">
                                            <div class="text-left">{{ $pet->name }}</div>
                                        </td>
                                        <td class="p-2">
                                            <div class="text-left">{{ $pet->description }}</div>
                                        </td>
                                        <td class="p-2">
                                            <div class="text-left whitespace-nowrap">{{ $pet->member->udn }}</div>
                                            <div class="text-left whitespace-nowrap">{{ $pet->member->email }}
                                            </div>
                                        </td>
                                        <td class="p-2">
                                            <div class="text-left">{{ $pet->votes_count }}</div>
                                        </td>
                                        <td class="p-2">
                                            <div class="text-left max-w-xs"><img src="{{ $pet->image }}" alt="">
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            <div class="my-3">
                {{ $pets->links() }}
            </div>
        </div>
    </div>


</x-app-layout>
