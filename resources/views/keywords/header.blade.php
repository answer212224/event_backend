<div class="flex justify-around">
    <x-nav-link :href="route('keywords.index')" :active="request()->routeIs('keywords.index')">
        {{ __('導航') }}
    </x-nav-link>
    <x-nav-link :href="route('keywords.members') . '?table[sorts][id]=desc&table[filters][year]=' . now()->format('Y')" :active="request()->routeIs('keywords.members')">
        {{ __('會員') }}
    </x-nav-link>
    <x-nav-link :href="route('keywords.prizes') .
        '?table[filters][year]=' .
        now()
            ->addYear()
            ->format('Y')" :active="request()->routeIs('keywords.prizes')">
        {{ __('獎項') }}
    </x-nav-link>
    <x-nav-link :href="route('keywords.lottery')" :active="request()->routeIs('keywords.lottery')">
        {{ __('抽獎') }}
    </x-nav-link>
    <x-nav-link href="https://money.udn.com/keywords/{{ now()->addYear()->format('Y') }}" target="_blank">
        {{ __('活動頁面') }}
    </x-nav-link>
</div>
