<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('lottery') }}">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lottery') }}
            </h2>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('lottery.result') }}" method="get">


                        <label>
                            <span class="text-gray-700">資料表</span>
                            <input type="text" name="table" value="{{ old('table') }}"
                                class="
                                mx-1
                                my-8
                                rounded-md
                                border-gray-300
                                shadow-sm
                                focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                "
                                placeholder="">
                        </label>

                        <div class="grid gap-4 grid-cols-3 gap-x-8 gap-y-8">

                            @for ($i = 0; $i < 10; $i++)
                                <label>
                                    <span class="text-gray-700">獎項</span>
                                    <input type="text" name="awards[{{ $i }}]"
                                        value="{{ old("awards.$i") }}"
                                        class="
                                        mx-1
                                        mt-1
                                        rounded-md
                                        border-gray-300
                                        shadow-sm
                                        focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                        "
                                        placeholder="">
                                </label>

                                <label>
                                    <span class="text-gray-700">獎品</span>
                                    <input type="text" name="prizes[{{ $i }}]"
                                        value="{{ old("prizes.$i") }}"
                                        class="
                                        mx-1
                                        mt-1
                                        rounded-md
                                        border-gray-300
                                        shadow-sm
                                        focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                        "
                                        placeholder="">

                                </label>

                                <label>
                                    <span class="text-gray-700">數量</span>
                                    <input type="number" name="counts[{{ $i }}]"
                                        value="{{ old("counts.$i") }}"
                                        class="
                                    mx-1
                                    mt-1
                                    rounded-md
                                    border-gray-300
                                    shadow-sm
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                    "
                                        placeholder="">
                                </label>
                            @endfor

                        </div>
                        <div class="flex justify-center mt-5">
                            <x-button>開始線上抽獎</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
