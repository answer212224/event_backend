<x-app-layout>
    <x-slot name="header">
        @include('election.header')
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Table -->
            <div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-2">
                <header class="px-5 py-4 border-b border-gray-100">

                </header>
                {{-- id, type, internal_code, outer_code, recorded_at --}}
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                <tr>

                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">city</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">party</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">name</div>
                                    </th>

                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">ip</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">updated_at</div>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="text-sm divide-y divide-gray-100" id="mytable">
                                @foreach ($member->votes as $vote)
                                    <tr @class([
                                        'bg-green-100' => $vote->is_win,
                                    ])>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $vote->candidate->city }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $vote->candidate->party }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $vote->candidate->name }}</div>
                                        </td>


                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $vote->ip }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $vote->updated_at }}</div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
</x-app-layout>
