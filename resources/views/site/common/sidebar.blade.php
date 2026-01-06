<aside
    class="fixed left-0 top-0 z-40 h-screen w-[290px] bg-white dark:bg-gray-900 border-r border-gray-900/10 dark:border-white/5 text-gray-900 dark:text-gray-300">
    <!-- Logo -->
    <div class="flex items-center justify-between px-3">
        <div class="flex items-center gap-3 px-6 py-6">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary">
                <span class="text-white font-bold">V</span>
            </div>
            <span class="text-xl font-semibold text-gray-900 dark:text-white">
                VueSoft
            </span>
        </div>
    </div>

    <!-- Menu -->
    <nav class="px-4">
        <p class="mb-3 px-2 text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">
            Menu
        </p>
        <ul class="space-y-1">
            @php
                $activeClass = 'bg-blue-500/10 text-primary dark:text-primary';
                $inactiveClass = 'text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white transition';
            @endphp
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium
                    {{ request()->routeIs('dashboard') ? $activeClass : $inactiveClass }}">
                    <i class="bi bi-bar-chart-line-fill text-xl"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('users') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium
                    {{ request()->routeIs('users') ? $activeClass : $inactiveClass }}">
                    <i class="bi bi-people-fill text-xl"></i>
                    Users
                </a>
            </li>
            <li>
                <a href="{{ route('services') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium
                    {{ request()->routeIs('services') ? $activeClass : $inactiveClass }}">
                    <i class="bi bi-gear-wide-connected text-xl"></i>
                    Services
                </a>
            </li>
        </ul>
    </nav>
</aside>