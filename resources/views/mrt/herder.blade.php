<div class="flex justify-around">
    <x-nav-link :href="route('mrt.index')" :active="request()->routeIs('mrt.index')">
        {{ __('搭公車抽獎活動') }}
    </x-nav-link>
    <x-nav-link :href="route('mrt.members')" :active="request()->routeIs('mrt.members')">
        {{ __('活動會員') }}
    </x-nav-link>
    <x-nav-link :href="route('mrt.records')" :active="request()->routeIs('mrt.records')">
        {{ __('搭乘紀錄') }}
    </x-nav-link>
    <x-nav-link :href="route('mrt.winners')" :active="request()->routeIs('mrt.winners')">
        {{ __('得獎名單') }}
    </x-nav-link>

    <x-nav-link href="https://event.udn.com/taipeibus2022/" target="_blank">
        {{ __('活動頁面') }}
    </x-nav-link>

</div>
