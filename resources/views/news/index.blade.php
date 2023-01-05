<x-app-layout>
    <x-slot name="header">
        @include('news.header')

    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">

            @livewire('activity-form', ['name' => 'news'])

            <hr class="my-6">

            <div class="mx-auto">
                @isset($chart)
                    <div>
                        {!! $chart->container() !!}
                    </div>
                    <hr class="my-6">
                @endisset


                @isset($chartNews)
                    <div>
                        {!! $chartNews->container() !!}
                    </div>
                @endisset

                <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
                @isset($chart)
                    {!! $chart->script() !!}
                    {!! $chartNews->script() !!}
                @endisset

            </div>

        </div>


    </div>

</x-app-layout>
