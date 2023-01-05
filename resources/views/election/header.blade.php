<div class="flex justify-around">

    <x-nav-link :href="route('election.index')" :active="request()->routeIs('election.index')">
        {{ __('導覽') }}
    </x-nav-link>

    <x-nav-link :href="route('election.members') . '?table[sorts][created_at]=desc'" :active="request()->routeIs('election.members')">
        {{ __('活動會員') }}
    </x-nav-link>

    <x-nav-link :href="route('election.candidates')" :active="request()->routeIs('election.candidates')">
        {{ __('候選人') }}
    </x-nav-link>


    <x-nav-link href="https://event.udn.com/predicting2022/" target="_blank">
        {{ __('活動頁面') }}
    </x-nav-link>

</div>
