<div class="flex flex-wrap items-center justify-between">
    <p>每月</p>

    <select name="month" wire:model='month'
        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        <option @if ($hasWinner[0]) disabled @endif value="7">七月份</option>
        <option @if ($hasWinner[1]) disabled @endif value="8">八月份</option>
        <option @if ($hasWinner[2]) disabled @endif value="9">九月份</option>
        <option @if ($hasWinner[3]) disabled @endif value="10">十月份</option>
    </select>

    <x-button wire:click='monthCheck'>
        抽獎
    </x-button>

</div>
