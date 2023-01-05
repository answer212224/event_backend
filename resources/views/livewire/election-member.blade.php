<div>
    <!-- Table -->
    <div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-2">
        <header class="px-5 py-4 border-b border-gray-100">
            <div class="flex flex-wrap items-center justify-around">


                <a href="{{ route('election.export') }}"><i class="fa-solid fa-file-csv fa-2x fa-bounce"></i></a>

                <form action="{{ route('election.update') }}" method="post">
                    @csrf
                    <button><i class="fa-solid fa-sync fa-spin fa-xl"></i></button>
                </form>

                <select wire:model='select'
                    class="
                    block
                    w-full
                    text-center
                    mt-0
                    px-0.5
                    border-0 border-b-2 border-gray-200
                    focus:ring-0 focus:border-black
                  ">
                    <option value="all">所有會員</option>
                    <option value="winner">六都全中</option>
                </select>

            </div>
        </header>
        {{-- id, type, internal_code, outer_code, recorded_at --}}
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
                                <div class="font-semibold text-left">is app</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">prediction</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">ip</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">created_at</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left"></div>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="text-sm divide-y divide-gray-100" id="mytable">
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
                                        @if ($member->is_app)
                                            是
                                        @endif
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left text-blue-700">
                                        @if (count($member->votes))
                                            <a href="{{ route('election.votes', ['member' => $member]) }}">
                                                <p>see<p>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ $member->ip }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ $member->created_at }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <form action="{{ route('election.delete', ['member' => $member]) }}" method="post">
                                        @csrf
                                        <div class="text-left">
                                            <x-button><i class="fa-solid fa-trash"></i></x-button>
                                        </div>
                                    </form>
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
