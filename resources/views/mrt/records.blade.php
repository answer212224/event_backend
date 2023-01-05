<x-app-layout>
    <x-slot name="header">
        @include('mrt.herder')
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <form method="GET" action="{{ route('mrt.records') }}">

                <input type="search"
                    class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="卡號" name="outer_code" />
                <button
                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 hover:border-transparent rounded">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>

            </form>
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
                                        <div class="font-semibold text-left">種類</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">卡號</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">搭乘時間</div>
                                    </th>

                                </tr>
                            </thead>

                            <tbody class="text-sm divide-y divide-gray-100" id="mytable">
                                @foreach ($members as $member)
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->type }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left text-blue-700">
                                                <a
                                                    href="{{ route('mrt.members', ['outer_code' => $member->outer_code]) }}">
                                                    <p>{{ $member->outer_code }}<p>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->recorded_at }}</div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>



            </div>
            <div class="my-3">
                {{ $members->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
