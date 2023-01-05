<x-app-layout>
    <x-slot name="header">
        @include('mrt.herder')
    </x-slot>

    <form id="store" action="{{ route('mrt.everyMonth.store') }}" method="post">
        @csrf
    </form>

    <div class="py-12">
        <div class="w-full max-w-2xl mx-auto text-right my-4">
            <button onclick="test()" class="hover:text-indigo-300"><i class="fa-solid fa-floppy-disk fa-2xl"></i></button>
        </div>
        <div class="flex flex-wrap">
            <!-- Table for 特獎-->

            <div class="w-full max-w-xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100">
                    <p>全勤獎</p>
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

                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100" id="mytable">

                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $mrtWinner->member->name }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $mrtWinner->member->gender }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $mrtWinner->member->phone }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $mrtWinner->outer_code }}</div>
                                    </td>

                                </tr>


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
