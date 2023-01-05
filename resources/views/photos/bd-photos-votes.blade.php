<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('photos.index') }}">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('photos') }}
            </h2>
        </a>
    </x-slot>

    <div class="py-12">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">


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
                                        <div class="font-semibold text-left">datetime</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">ip</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">image</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                                @foreach ($votes as $vote)
                                    <tr>
                                        <td class="p-2 ">
                                            <div class="text-left">{{ $vote->pet->name }}</div>
                                        </td>

                                        <td class="p-2">
                                            <div class="text-left">{{ $vote->created_at }}</div>
                                        </td>
                                        <td class="p-2">
                                            <div class="text-left">{{ $vote->ip }}</div>
                                        </td>
                                        <td class="p-2">
                                            <div class="text-left max-w-xs"><img src="{{ $vote->pet->image }}" alt="">
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
                {{ $votes->links() }}
            </div>
        </div>
    </div>


</x-app-layout>
