<div class="max-w-3xl mx-auto my-10 text-gray-800 text-lg">
    <img src="https://event.udn.com/{{ $year }}news/img/main.png" alt="">
    <hr class="my-3">
    <input type="number" max="2028"
        class=" border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
        placeholder="2022" wire:model="year">

    <hr class="my-3">
    <h2 class="text-lg font-semibold text-gray-900 dark:text-white my-3">
        「{{ $year }} 記錄大事件 典藏優質報」活動已於 {{ $activity->end_at }} 截止投票。
        本報將進行此活動抽獎儀式，活動規劃獎項：</h2>
    <ul class="space-y-1 list-disc list-inside text-gray-500 dark:text-gray-400 my-3">
        @foreach ($prizes as $category => $value)
            <li>
                {{ $category }} :
                <ul class="space-y-1 list-disc list-inside text-gray-500 dark:text-gray-400">
                    @foreach ($value as $prize)
                        <li class=" ml-3">
                            {{ $prize->award }} : {{ $prize->prize }}，共 {{ $prize->amount }} 名。
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
    <h2 class="text-lg font-semibold text-gray-900 dark:text-white my-3">
        抽獎方式：以線上抽籤方式抽獎，現匯入總票數名單，並依序抽出@foreach ($prizes as $category => $prizes)
            {{ $category }}
        @endforeach。
    </h2>
    <div class="text-right">
        <x-button wire:click="check">開始線上抽獎</x-button>
    </div>

</div>
