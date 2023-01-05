<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('nbabingo.index') }}">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('nbabingo') }}
            </h2>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Table -->
            <div class="w-full max-w-md mx-auto bg-white shadow-lg rounded-sm border border-gray-200 my-3">
                <header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-800">nbabingoShow</h2>
                </header>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                <tr>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">question</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">index</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-right">date</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                                @foreach ($selections as $selection)
                                    <tr @class([
                                        'bg-green-100' => $selection->is_win,
                                    ])>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $selection->nbaBingoQuestion->question }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $selection->index }}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-right">{{ $selection->created_at }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>

        </div>
    </div>

</x-app-layout>
