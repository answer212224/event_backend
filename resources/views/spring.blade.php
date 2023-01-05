<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('spring.index') }}">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('spring') }}
            </h2>
        </a>
    </x-slot>

    <div class="py-12">

        <!-- Table -->
        <div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-2">
            <header class="px-5 py-4 border-b border-gray-100">
                <div class="flex justify-around">
                    <div></div>
                    <form action="{{ route('spring.index') }}" method="GET">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="isPrize"
                                class="
                            rounded
                            border-gray-300
                            text-indigo-600
                            shadow-sm
                            focus:border-indigo-300
                            focus:ring
                            focus:ring-offset-0
                            focus:ring-indigo-200
                            focus:ring-opacity-50
                        "
                                onchange="this.form.submit()" @if (request()->isPrize) checked @endif>
                            <span class="ml-2">Prize</span>
                        </label>
                    </form>

                    <form method="POST" action="{{ route('spring.export') }}">
                        @csrf
                        <x-button>
                            <i class="far fa-file-excel"></i>
                        </x-button>
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
                                    <div class="font-semibold text-left">udn</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">email</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">prize</div>
                                </th>

                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">timestamp</div>
                                </th>

                                {{-- <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left"></div>
                                </th> --}}

                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @foreach ($members as $member)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $member->udn }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $member->email }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $member->prize }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            {{ $member->created_at }}
                                        </div>
                                    </td>

                                    {{-- <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            <form method="POST"
                                                action="{{ route('spring.destroy', [
                                                    'spring' => $member,
                                                ]) }}">
                                                @method('delete')
                                                @csrf
                                                <x-button>
                                                    <i class="far fa-trash-alt"></i>
                                                </x-button>
                                            </form>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="my-3 px-2">
                {{ $members->links() }}
            </div>
        </div>

    </div>



</x-app-layout>
