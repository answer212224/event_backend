<div>
    <details class="" open>
        <summary class="leading-6 text-slate-900 dark:text-white font-semibold select-none">
            add
        </summary>
        <div class="leading-6 text-slate-600 dark:text-slate-400 dark:text-white">
            <div class="px-6 py-4 bg-gray-200 dark:bg-gray-800 my-3">
                <div class="font-semibold flex justify-between">
                    <div>
                        <input type="number" wire:model="year"
                            class=" border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="year" min="2022">
                        <select wire:model="category"
                            class="border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="預測王">預測王</option>
                            <option value="參加獎">參加獎</option>
                        </select>
                        <input type="text" wire:model="award"
                            class=" border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="award">
                        <input type="text" wire:model="prize"
                            class=" border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="prize">
                        <input type="number" wire:model="amount"
                            class=" border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="amout">

                    </div>
                    <div>
                        <x-button wire:click='check'>
                            add
                        </x-button>
                    </div>
                </div>
            </div>

        </div>

    </details>
</div>
