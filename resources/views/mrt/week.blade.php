<x-app-layout>
    <x-slot name="header">
        @include('mrt.herder')
    </x-slot>
    <form id="store" action="{{ route('mrt.week.store') }}" method="post">
        @csrf
    </form>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="flex flex-wrap">
                <div class="w-full max-w-2xl mx-auto text-right">
                    <button onclick="test()" class="hover:text-indigo-300"><i
                            class="fa-solid fa-floppy-disk fa-2xl"></i></button>
                </div>
                <!-- Table for 頭獎-->
                <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-2">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <p>頭獎 飛利浦智慧萬用鍋HD2195 1台 1名</p>
                    </header>
                    <div class="p-3">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">姓名</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">性別</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">電話</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">卡號</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">交易身分</div>
                                        </th>
                                        {{-- <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">搭乘時間</div>
                                        </th> --}}
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-100" id="mytable">

                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $mrtWinners[0]->member->name }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $mrtWinners[0]->member->gender }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $mrtWinners[0]->member->phone }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $mrtWinners[0]->outer_code }}
                                            </div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $mrtWinners[0]->type }}
                                            </div>
                                        </td>
                                        {{-- <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $mrtWinners[0]->recorded_at }}
                                            </div>
                                        </td> --}}
                                    </tr>


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- Table for 貳獎-->
                <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-2">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <p>貳獎 switch主機 1台 2名</p>
                    </header>
                    <div class="p-3">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">姓名</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">性別</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">電話</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">卡號</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">交易身分</div>
                                        </th>
                                        {{-- <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">搭乘時間</div>
                                        </th> --}}
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-100" id="mytable">
                                    @for ($i = 1; $i < 3; $i++)
                                        <tr>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->member->name }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->member->gender }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->member->phone }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->outer_code }}
                                                </div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->type }}
                                                </div>
                                            </td>
                                            {{-- <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->recorded_at }}
                                                </div>
                                            </td> --}}
                                        </tr>
                                    @endfor

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- Table for 參獎-->
                <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-2">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <p>參獎 饗饗假日晚餐券 2張 3名</p>
                    </header>
                    <div class="p-3">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">姓名</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">性別</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">電話</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">卡號</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">交易身分</div>
                                        </th>
                                        {{-- <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">搭乘時間</div>
                                        </th> --}}
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-100" id="mytable">
                                    @for ($i = 3; $i < 6; $i++)
                                        <tr>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->member->name }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->member->gender }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->member->phone }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->outer_code }}
                                                </div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->type }}
                                                </div>
                                            </td>
                                            {{-- <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->recorded_at }}
                                                </div>
                                            </td> --}}
                                        </tr>
                                    @endfor

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- Table for 肆獎-->
                <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-2">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <p>肆獎 悠遊卡1000元 1張 20名</p>
                    </header>
                    <div class="p-3">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">姓名</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">性別</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">電話</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">卡號</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">交易身分</div>
                                        </th>
                                        {{-- <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">搭乘時間</div>
                                        </th> --}}
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-100" id="mytable">
                                    @for ($i = 6; $i < 26; $i++)
                                        <tr>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->member->name }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->member->gender }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->member->phone }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->outer_code }}
                                                </div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->type }}
                                                </div>
                                            </td>
                                            {{-- <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->recorded_at }}
                                                </div>
                                            </td> --}}
                                        </tr>
                                    @endfor

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- Table for 普獎-->
                <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-2">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <p>普獎 悠遊卡500元 1張 20名</p>
                    </header>
                    <div class="p-3">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">姓名</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">性別</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">電話</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">卡號</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">交易身分</div>
                                        </th>
                                        {{-- <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">搭乘時間</div>
                                        </th> --}}
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-100" id="mytable">
                                    @for ($i = 26; $i < 46; $i++)
                                        <tr>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->member->name }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->member->gender }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->member->phone }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->outer_code }}
                                                </div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->type }}
                                                </div>
                                            </td>
                                            {{-- <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ $mrtWinners[$i]->recorded_at }}
                                                </div>
                                            </td> --}}
                                        </tr>
                                    @endfor

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </div>

    <script>
        var changes = true;

        function test() {

            Swal.fire({
                title: '確定要儲存得獎名單?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: '儲存',
                denyButtonText: `不儲存`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    changes = false;
                    document.getElementById("store").submit();
                } else if (result.isDenied) {
                    Swal.fire('此次抽獎未儲存', '', 'info')
                }
            })
        }

        window.onbeforeunload = function() {
            if (changes) {
                var message =
                    "Are you sure you want to navigate away from this page?\n\nYou have started writing or editing a post.\n\nPress OK to continue or Cancel to stay on the current page.";
                if (confirm(message)) return true;
                else return false;
            }
        }
    </script>

</x-app-layout>
