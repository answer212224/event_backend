<div class="flex flex-wrap items-center justify-between">
    <p>每週</p>

    <select wire:model='week'
        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        <option @if ($hasWinner[0]) disabled @endif value="2022-07-01,2022-07-07">第一週(07/01~07/07)</option>
        <option @if ($hasWinner[1]) disabled @endif value="2022-07-08,2022-07-14">第二週(07/08~07/14)</option>
        <option @if ($hasWinner[2]) disabled @endif value="2022-07-15,2022-07-21">第三週(07/15~07/21)</option>
        <option @if ($hasWinner[3]) disabled @endif value="2022-07-22,2022-07-28">第四週(07/22~07/28)</option>
        <option @if ($hasWinner[4]) disabled @endif value="2022-07-29,2022-08-04">第五週(07/29~08/04)</option>
        <option selected @if ($hasWinner[5]) disabled @endif value="2022-08-05,2022-08-11">第六週(08/05~08/11)
        </option>
        <option @if ($hasWinner[6]) disabled @endif value="2022-08-12,2022-08-18">第七週(08/12~08/18)</option>
        <option @if ($hasWinner[7]) disabled @endif value="2022-08-19,2022-08-25">第八週(08/19~08/25)
        </option>
        <option @if ($hasWinner[8]) disabled @endif value="2022-08-26,2022-09-01">第九週(08/26~09/01)
        </option>
        <option @if ($hasWinner[9]) disabled @endif value="2022-09-02,2022-09-08">第十週(09/02~09/08)
        </option>
        <option @if ($hasWinner[10]) disabled @endif value="2022-09-09,2022-09-15">第十一週(09/09~09/15)
        </option>
        <option @if ($hasWinner[11]) disabled @endif value="2022-09-16,2022-09-22">第十二週(09/16~09/22)
        </option>
        <option @if ($hasWinner[12]) disabled @endif value="2022-09-23,2022-09-29">第十三週(09/23~09/29)
        </option>
        <option @if ($hasWinner[13]) disabled @endif value="2022-09-30,2022-10-06">第十四週(09/30~10/06)
        </option>
        <option @if ($hasWinner[14]) disabled @endif value="2022-10-07,2022-10-13">第十五週(10/07~10/13)
        </option>
        <option @if ($hasWinner[15]) disabled @endif value="2022-10-14,2022-10-20">第十六週(10/14~10/20)
        </option>
        <option @if ($hasWinner[16]) disabled @endif value="2022-10-21,2022-10-27">第十七週(10/21~10/27)
        </option>
        <option @if ($hasWinner[17]) disabled @endif value="2022-10-28,2022-10-31">第十八週(10/28~10/31)
        </option>
    </select>
    <x-button wire:click='weekCheck'>抽獎</x-button>

</div>
