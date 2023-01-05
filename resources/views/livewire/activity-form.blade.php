<div class="md:flex md:justify-end mb-4 px-4 md:p-0 items-center">
    <p class="mx-2">活動日期設置 : </p>
    <div class="w-full mb-4 md:mb-0 md:w-2/4 md:flex space-y-4 md:space-y-0 md:space-x-2">

        <input wire:model="start" type="datetime-local" value="{{ $start }}"
            class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md "
            step="1">

        <input wire:model="end" type="datetime-local" value="{{ $end }}"
            class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md "
            step="1">
        <x-button wire:click='check'>
            confirm
        </x-button>

    </div>


</div>
