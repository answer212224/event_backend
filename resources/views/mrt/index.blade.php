<x-app-layout>
    <x-slot name="header">
        @include('mrt.herder')
    </x-slot>


    <div class="py-12">


        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="flex flex-wrap items">
                <!-- Table -->
                <div class="w-full max-w-xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-2">
                    <header class="px-5 py-4 border-b border-gray-100">
                        {{-- @livewire('form-elements') --}}
                    </header>

                    <div class="p-3">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">獎項</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">獎品</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">人數</div>
                                        </th>


                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-100">

                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            普獎
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            悠遊卡500元 1張
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            20名
                                        </td>

                                    </tr>

                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            肆獎
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            悠遊卡1000元 1張
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            20名
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            參獎
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            饗饗假日晚餐券 2張
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            3名
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            貳獎
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            switch主機 1台
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            2名
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            頭獎
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            飛利浦智慧萬用鍋HD2195 1台
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            1名
                                        </td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>

                <!-- Table -->
                <div class="w-full max-w-xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-2">
                    <header class="px-5 py-4 border-b border-gray-100">
                        {{-- @livewire('month-form') --}}
                    </header>

                    <div class="p-3">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">獎項</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">獎品</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">人數</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-100">

                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            特獎
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            Dyson V15 Detect™ 無線吸塵器 1台
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            1名
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="w-full max-w-xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-2">
                    <header class="px-5 py-4 border-b border-gray-100">
                        @livewire('every-month-form')
                    </header>

                    <div class="p-3">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">獎項</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">獎品</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">人數</div>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-100">

                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            全勤獎
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            悠遊卡500元 1張
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            1名
                                        </td>

                                    </tr>

                                    <tr>
                                        <td class="p-2 whitespace-nowrap">

                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            悠遊卡1000元 1張
                                        </td>
                                        <td class="p-2 whitespace-nowrap">

                                        </td>

                                    </tr>

                                    <tr>
                                        <td class="p-2 whitespace-nowrap">

                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            饗饗假日晚餐券 2張
                                        </td>
                                        <td class="p-2 whitespace-nowrap">

                                        </td>

                                    </tr>

                                    <tr>
                                        <td class="p-2 whitespace-nowrap">

                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            switch主機 1台
                                        </td>
                                        <td class="p-2 whitespace-nowrap">

                                        </td>

                                    </tr>

                                    <tr>
                                        <td class="p-2 whitespace-nowrap">

                                        </td>
                                        <td class="p-2 whitespace-nowrap">

                                            飛利浦智慧萬用鍋 1台

                                        </td>
                                        <td class="p-2 whitespace-nowrap">

                                        </td>

                                    </tr>

                                    <tr>
                                        <td class="p-2 whitespace-nowrap">

                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            Dyson V15 Detect™ 無線吸塵器 1台
                                        </td>
                                        <td class="p-2 whitespace-nowrap">

                                        </td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>



</x-app-layout>
