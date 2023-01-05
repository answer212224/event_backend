<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mothersday') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Table -->
            <div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100">
                    <form method="POST" action="{{ route('mothersday.export') }}">
                        @csrf
                        <x-button>
                            <i class="far fa-file-excel"></i>
                        </x-button>
                    </form>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                <tr>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">#</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">udn</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">email</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">award</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">timestamp</div>
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
                                            <div class="text-left">{{ $member->id }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->udn }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->email }}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->award_id }}</div>
                                        </td>


                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $member->updated_at }}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div x-data="{ memberId: {{ $member->id }} }">
                                                <button @click="sweetAlert({memberId})"><i
                                                        class="fa-regular fa-trash-can"></i></button>

                                                <form method="POST" id="myForm_{{ $member->id }}"
                                                    action="{{ route('mothersday.delete', $member->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
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

        {{-- <form method="POST" action="{{ route('mothersday.delete', $member->id) }}">
            @method('DELETE')
            @csrf
            <x-button class="ml-3">
                <i class="fa-solid fa-trash"></i>
            </x-button>
        </form> --}}



        <script>
            function sweetAlert({
                memberId
            }) {
                const myForm = document.getElementById("myForm_" + memberId)
                Swal.fire({
                    title: 'Are you sure #' + memberId + ' ?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        myForm.submit();
                    }
                })
            }
        </script>

    </div>
</x-app-layout>
