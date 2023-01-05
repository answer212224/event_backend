<div class="flex justify-around">
    <x-nav-link :href="route('news.index')" :active="request()->routeIs('news.index')">
        {{ __('導航') }}
    </x-nav-link>
    <x-nav-link :href="route('news.members') . '?table[sorts][id]=desc&table[filters][year]=' . now()->format('Y')" :active="request()->routeIs('news.members')">
        {{ __('會員') }}
    </x-nav-link>
    <x-nav-link :href="route('news.prizes') . '?table[filters][year]=' . now()->format('Y')" :active="request()->routeIs('news.prizes')">
        {{ __('獎項') }}
    </x-nav-link>
    <x-nav-link :href="route('news.lottery')" :active="request()->routeIs('news.lottery')">
        {{ __('抽獎') }}
    </x-nav-link>
    <x-nav-link href="https://event.udn.com/{{ now()->format('Y') }}news/prize.html" target="_blank">
        {{ __('活動頁面') }}
    </x-nav-link>
</div>
