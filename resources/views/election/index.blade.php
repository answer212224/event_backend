<x-app-layout>

    <x-slot name="header">
        @include('election.header')
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center justify-between my-2">
                <p class="text-sm font-medium leading-5 text-gray-500">
                    總會員人數: {{ $users }}
                </p>
                <p class="text-sm font-medium leading-5 text-gray-500">
                    下載APP會員人數: {{ $users_app }}
                </p>
                <p class="text-sm font-medium leading-5 text-gray-500">
                    總遊玩次數: {{ $users_played }}
                </p>
                <p class="text-sm font-medium leading-5 text-gray-500">
                    新聞點擊次數: {{ $clicks }}
                </p>
            </div>
            <hr>
            <div class="flex flex-wrap items-center justify-around my-4">
                <form action="{{ route('election.activity') }}" method="post">
                    @csrf
                    <label>
                        <span class="text-sm font-medium leading-5 text-gray-500">活動開始</span>
                        <input class="rounded-md text-sm" value="{{ $activity->start_at }}" type="datetime-local" step=1
                            name="start">
                    </label>
                    <label>
                        <span class="text-sm font-medium leading-5 text-gray-500">活動結束</span>
                        <input class="rounded-md text-sm" value="{{ $activity->end_at }}" type="datetime-local" step=1
                            name="end">
                    </label>
                    <x-button>確認</x-button>
                </form>
            </div>

            <hr>


        </div>

        <div>
            {!! $chart->container() !!}
            <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
            {!! $chart->script() !!}
        </div>

    </div>
</x-app-layout>
