<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('nbabingo.index') }}">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('nbabingo') }}
            </h2>
        </a>
    </x-slot>

    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Table -->
            <div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-2">
                <header class="px-5 py-4 border-b border-gray-100">

                    <div class="flex justify-between">

                        <form method="POST" class="" action="{{ route('nbabingo.update') }}">
                            @csrf
                            <x-button>
                                <i class="fas fa-sync"></i>
                            </x-button>
                        </form>

                        <form method="POST" action="{{ route('nbabingo.export') }}">
                            @csrf
                            <x-button>
                                <i class="far fa-file-excel"></i>
                            </x-button>
                        </form>

                        <form action="{{ route('nbabingo.index') }}" method="get">
                            <select
                                class="
                                block
                                border-0 border-b-2 border-gray-200
                                focus:ring-0 focus:border-black
                                "
                                name="order_by" onchange="this.form.submit()">
                                <option value="id">newest</option>
                                <option @if (request()->order_by == 'line') selected @endif>line</option>
                                <option @if (request()->order_by == 'score') selected @endif>score</option>
                            </select>
                        </form>

                        <!-- Alert Success -->
                        @if (session('success'))
                            <div class="bg-green-200 px-6 py-1 mx-2 rounded-md text-lg flex items-center">
                                <svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
                                    <path fill="currentColor"
                                        d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                                    </path>
                                </svg>
                                <span class="text-green-800"> {{ session('success') }} </span>
                            </div>
                        @endif
                        <!-- End Alert Success -->


                    </div>
                </header>

                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                <tr>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">name</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">email</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">phone</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">line</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">score</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">view</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">isAgree</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                                @foreach ($members as $member)
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->name }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->email }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->phone }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->line }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->score }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left text-blue-500">
                                                @if ($member->selections->isNotEmpty())
                                                    <a href="{{ route('nbabingo.show', ['member' => $member]) }}"><i
                                                            class="fas fa-eye fa-lg"></i></a>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">
                                                @if ($member->is_agree)
                                                    y
                                                @else
                                                    n
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            <div class="my-3">
                {{ $members->links() }}
            </div>
        </div>
    </div>


</x-app-layout>
