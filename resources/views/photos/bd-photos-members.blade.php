<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('photos.index') }}">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('photos') }}
            </h2>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <!-- Table -->
            <div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-2">
                <header class="px-5 py-4 border-b border-gray-100">

                    <div class="flex justify-between">

                        <form method="POST" action="{{ route('photos.export') }}">
                            @csrf
                            <x-button>
                                <i class="far fa-file-excel"></i>
                            </x-button>
                        </form>
                        <div>
                            <a class="text-indigo-400" href="{{ route('photos.posts') }}">所有投稿</a>
                        </div>
                        <form action="{{ route('photos.index') }}" method="GET">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="hasVoted"
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
                                    onchange="this.form.submit()" @if (request()->hasVoted) checked @endif>
                                <span class="ml-2">has Voted</span>
                            </label>

                        </form>
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
                                        <div class="font-semibold text-left">posts</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">votes</div>
                                    </th>
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
                                            <div class="text-left">
                                                <a href="{{ route('photos.show', ['member' => $member]) }}"><i
                                                        class="fas fa-eye fa-lg text-blue-500"></i>
                                                </a>
                                            </div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left;">
                                                <a href="{{ route('photos.vote', ['member' => $member]) }}"
                                                    class="text-blue-600 ">
                                                    {{ $member->votes_count }}
                                                </a>
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
