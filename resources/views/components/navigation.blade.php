<x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-nav-link>
<x-nav-link :href="route('index')" :active="request()->routeIs('index')">
    {{ __('Index') }}
</x-nav-link>