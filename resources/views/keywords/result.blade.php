<x-app-layout>
    <x-slot name="header">
        @include('keywords.header')

    </x-slot>

    <div class="py-12">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @foreach ($prizesGbCate['預測王'] as $key => $prize)
                <details close>
                    <summary class="my-3 leading-6 text-slate-900 dark:text-white font-semibold">
                        {{ $prize->category }} {{ $prize->award }} {{ $prize->prize }}，共 {{ $prize->amount }} 名
                    </summary>

                    <div class="shadow overflow-y-scroll border-b border-gray-200 dark:border-gray-700 sm:rounded-lg">

                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        順位
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        姓名
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        行動電話
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Email
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        票選
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        時間
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($prize->amount <= 1)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            1
                                        </th>
                                        <td class="py-4 px-6">
                                            {{ $predictionWinners[$key]->name }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $predictionWinners[$key]->phone }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $predictionWinners[$key]->email }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $predictionWinners[$key]->vote_id }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $predictionWinners[$key]->created_at }}
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($predictionWinners[$key] as $k => $winner)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $k + 1 }}
                                            </th>
                                            <td class="py-4 px-6">
                                                {{ $winner->name }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $winner->phone }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $winner->email }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $winner->vote_id }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $winner->created_at }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        </ul>
                    </div>
                </details>
            @endforeach

            @foreach ($prizesGbCate['參加獎'] as $key => $prize)
                <details close>
                    <summary class="my-3 leading-6 text-slate-900 dark:text-white font-semibold">
                        {{ $prize->category }} {{ $prize->award }} {{ $prize->prize }}，共 {{ $prize->amount }} 名
                    </summary>

                    <div class="shadow overflow-y-scroll border-b border-gray-200 dark:border-gray-700 sm:rounded-lg">

                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        順位
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        姓名
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        行動電話
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Email
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        票選
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        時間
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($prize->amount <= 1)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            1
                                        </th>
                                        <td class="py-4 px-6">
                                            {{ $participateWinners[$key]->name }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $participateWinners[$key]->phone }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $participateWinners[$key]->email }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $participateWinners[$key]->vote_id }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $participateWinners[$key]->created_at }}
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($participateWinners[$key] as $k => $winner)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $k + 1 }}
                                            </th>
                                            <td class="py-4 px-6">
                                                {{ $winner->name }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $winner->phone }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $winner->email }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $winner->vote_id }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $winner->created_at }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        </ul>
                    </div>
                </details>
            @endforeach


        </div>
    </div>
    <script>
        window.onbeforeunload = function() {
            var changes = true;
            if (changes) {
                var message =
                    "Are you sure you want to navigate away from this page?\n\nYou have started writing or editing a post.\n\nPress OK to continue or Cancel to stay on the current page.";
                if (confirm(message)) return true;
                else return false;
            }
        }
    </script>

</x-app-layout>
