<x-app-layout>
    <x-slot name="header">
        @include('mrt.herder')
    </x-slot>

    <div class="py-12">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <form method="GET" action="{{ route('mrt.members') }}">

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
                    <div class="flex flex-wrap items-center justify-between">
                        <form method="POST" action="{{ route('mrt.memberExport') }}">
                            @csrf
                            <x-button>
                                <i class="far fa-file-excel"></i>
                            </x-button>
                        </form>

                        <p class="font-semibold">
                            台北通 點擊次數 {{ $count }}
                        </p>
                    </div>

                </header>

                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                <tr>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">ID</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">姓名</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">性別</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">聯絡電話</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">悠遊卡號</div>
                                    </th>

                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">交通工具</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">因疫情</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">為了抽獎</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">ip</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">建立時間</div>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="text-sm divide-y divide-gray-100" id="mytable">
                                @foreach ($members as $member)
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->id }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->name }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->gender }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->phone }}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left text-blue-700">
                                                <a
                                                    href="{{ route('mrt.records', ['outer_code' => $member->outer_code]) }}">
                                                    <p>{{ $member->outer_code }}<p>
                                                </a>
                                            </div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->transportation }}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->is_covid }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->is_lottery }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->ip }}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->created_at }}</div>
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
