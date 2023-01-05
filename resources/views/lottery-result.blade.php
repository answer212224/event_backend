<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('lottery') }}">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lottery') }}
            </h2>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if ($data['lotterys'][0]['input']['award'] && $data['lotterys'][0]['input']['prize'] && $data['lotterys'][0]['input']['count'])
                <div class="flex justify-end">

                    <form method="get" action="{{ route('lottery.export') }}">

                        <x-button>
                            <i class="far fa-file-excel"></i>
                        </x-button>
                    </form>
                </div>
            @endif
            @foreach ($data['lotterys'] as $lotterys)
                @if ($lotterys['input']['award'] && $lotterys['input']['prize'] && $lotterys['input']['count'])
                    <!-- Table -->
                    <div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-2">
                        <header class="px-5 py-4 border-b border-gray-100 flex justify-between">
                            <h1 class="text-xl font-bold">{{ $lotterys['input']['award'] }} :
                                {{ $lotterys['input']['prize'] }}</h1>
                            <h1 class="text-xl font-bold">共 {{ $lotterys['input']['count'] }} 名</h1>
                        </header>

                        <div class="p-3">
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full">
                                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                        <tr>
                                            <th class="p-2 whitespace-nowrap">

                                                <div class="font-semibold text-left">流水號</div>
                                            </th>
                                            @foreach ($data['columns'] as $column)
                                                <th class="p-2 whitespace-nowrap">

                                                    <div class="font-semibold text-left">{{ $column }}</div>
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100">


                                        @foreach ($lotterys['lotteryMembers'] as $id => $lotteryMember)
                                            <tr>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left">{{ $id + 1 }}
                                                    </div>
                                                </td>
                                                @foreach ($data['columns'] as $column)
                                                    <td class="p-2 whitespace-nowrap">

                                                        <div class="text-left">{{ $lotteryMember->{$column} }}
                                                        </div>
                                                    </td>
                                                @endforeach

                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                @endif
            @endforeach


        </div>
    </div>


</x-app-layout>
