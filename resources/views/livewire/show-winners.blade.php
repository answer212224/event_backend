<div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-2">
    <header class="px-5 py-4 border-b border-gray-100">
        <div class="flex flex-wrap items-center justify-between">

            <select wire:model='award'
                class="
                        rounded-md
                        border-gray-300
                        shadow-sm
                        focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                      ">
                <option value="2022-07-01,2022-07-07">第一週(07/01~07/07)</option>
                <option value="2022-07-08,2022-07-14">第二週(07/08~07/14)</option>
                <option value="2022-07-15,2022-07-21">第三週(07/15~07/21)</option>
                <option value="2022-07-22,2022-07-28">第四週(07/22~07/28)</option>
                <option value="2022-07-29,2022-08-04">第五週(07/29~08/04)</option>
                <option value="2022-08-05,2022-08-11">第六週(08/05~08/11)</option>
                <option value="2022-08-12,2022-08-18">第七週(08/12~08/18)</option>
                <option value="2022-08-19,2022-08-25">第八週(08/19~08/25)</option>
                <option value="2022-08-26,2022-09-01">第九週(08/26~09/01)</option>
                <option value="2022-09-02,2022-09-08">第十週(09/02~09/08)</option>
                <option value="2022-09-09,2022-09-15">第十一週(09/09~09/15)</option>
                <option value="2022-09-16,2022-09-22">第十二週(09/16~09/22)</option>
                <option value="2022-09-23,2022-09-29">第十三週(09/23~09/29)</option>
                <option value="2022-09-30,2022-10-06">第十四週(09/30~10/06)</option>
                <option value="2022-10-07,2022-10-13">第十五週(10/07~10/13)</option>
                <option value="2022-10-14,2022-10-20">第十六週(10/14~10/20)</option>
                <option value="2022-10-21,2022-10-27">第十七週(10/21~10/27)</option>
                <option value="2022-10-28,2022-10-31">第十八週(10/28~10/31)</option>
            </select>

        </div>
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
                            <div class="font-semibold text-left">卡號</div>
                        </th>

                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">姓名</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">電話</div>
                        </th>
                    </tr>
                </thead>

                <tbody class="text-sm divide-y divide-gray-100" id="mytable">
                    @foreach ($mrtWinners as $mrtWinner)
                        <tr>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">{{ $mrtWinner->award }}</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">{{ $mrtWinner->member->outer_code }}</div>
                            </td>

                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">{{ $mrtWinner->member->name }}</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">{{ $mrtWinner->member->phone }}</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>



</div>
