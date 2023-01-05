<x-app-layout>
    <x-slot name="header">
        @include('keywords.header')

    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">

            @livewire('activity-form', ['name' => 'keywords'])

            <hr class="my-6">


            <div class="mx-auto">
                <div>
                    {!! $chart->container() !!}

                </div>
                <hr class="my-6">
                <div>
                    {!! $chartWord->container() !!}
                </div>


                <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
                {!! $chart->script() !!}
                {!! $chartWord->script() !!}

            </div>


        </div>
    </div>
</x-app-layout>
