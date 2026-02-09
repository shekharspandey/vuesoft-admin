<aside id="sidebar"
    class="fixed left-0 top-0 z-50 h-screen w-[290px] sidebar-collapsed:w-[80px] bg-white dark:bg-gray-900 border-r border-gray-900/10 dark:border-white/5 text-gray-900 dark:text-gray-300
-translate-x-full sidebar-collapsed:translate-x-0 lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <div id="sidebarOverlay" class="fixed inset-0 z-40 bg-black/30 hidden lg:hidden sidebar-collapsed:left-[80px]"
        style="left: 290px;"></div>
    <!-- Logo -->
    <div class="flex items-center justify-between px-3">
        <div class="flex items-center gap-3 px-6 py-6 sidebar-logo">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary">
                <span class="text-white font-bold">V</span>
            </div>
            <span class="text-xl font-semibold text-gray-900 dark:text-white">
                VueSoft
            </span>
        </div>
    </div>
    <!-- Logo - ON SIDEBAR COLLAPSED -->
    <div class="flex items-center justify-between px-3">
        <div class="flex items-center gap-3 px-2 py-6 sidebar-slogo">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary">
                <span class="text-white font-bold">V</span>
            </div>
        </div>
    </div>

    <!-- Menu -->
    <nav class="px-3 sm:px-4">
        <p class="mb-3 px-2 text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">
            Menu
        </p>
        <ul class="space-y-1">
            @php
                $activeClass = 'bg-blue-500/10 text-primary dark:text-primary';
                $inactiveClass =
                    'text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white transition';
            @endphp
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium
                    {{ request()->routeIs('dashboard') ? $activeClass : $inactiveClass }}">
                    <i class="bi bi-bar-chart-line-fill text-lg sm:text-xl"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('users') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium
                    {{ request()->routeIs('users') || request()->routeIs('userDetails') ? $activeClass : $inactiveClass }}">
                    <i class="bi bi-people-fill text-xl"></i>
                    <span class="sidebar-text">Users</span>
                </a>
            </li>
            <li>
                <!-- Toggle -->
                <button id="staticContentToggle"
                    class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium
                    {{ request()->is('faqs*', 'privacy-policy*', 'terms*') ? $activeClass : $inactiveClass }}">

                    <i class="bi bi-file-text-fill text-xl"></i>
                    <span class="sidebar-text flex-1 text-left">Static Content</span>
                    <i id="staticChevron" class="bi bi-chevron-down transition-transform"></i>
                </button>

                <!-- Submenu -->
                <ul id="staticContentMenu" class="mt-1 ml-3 space-y-1 hidden">

                    <li>
                        <a href="{{ route('faqs') }}"
                            class="block rounded-lg px-4 py-2 text-sm
                            {{ request()->routeIs('faqs') ? $activeClass : $inactiveClass }}">
                            <i class="bi bi-question-circle-fill text-lg mr-2"></i>
                            <span class="sidebar-text flex-1 text-left">FAQs</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('privacyPolicy') }}"
                            class="block rounded-lg px-4 py-2 text-sm
                            {{ request()->routeIs('privacyPolicy') ? $activeClass : $inactiveClass }}">
                            <i class="bi bi-shield-lock-fill text-lg mr-2"></i>
                            <span class="sidebar-text flex-1 text-left">Privacy Policy</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('terms') }}"
                            class="block rounded-lg px-4 py-2 text-sm
                            {{ request()->routeIs('terms') ? $activeClass : $inactiveClass }}">
                            <i class="bi bi-file-earmark-text-fill text-lg mr-2"></i>
                            <span class="sidebar-text flex-1 text-left">Terms & Conditions</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>

<script>
    const staticToggle = document.getElementById('staticContentToggle');
    const staticMenu = document.getElementById('staticContentMenu');
    const staticChevron = document.getElementById('staticChevron');

    if (staticToggle) {
        staticToggle.addEventListener('click', () => {
            staticMenu.classList.toggle('hidden');
            staticChevron.classList.toggle('rotate-180');
        });
    }

    // Auto-open if active page
    if (
        "{{ request()->is('faqs*', 'privacy-policy*', 'terms*') }}" === "1"
    ) {
        staticMenu.classList.remove('hidden');
        staticChevron.classList.add('rotate-180');
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const sidebar = document.getElementById("sidebar");
        const sidebarToggle = document.getElementById("sidebarToggle");
        const appContent = document.getElementById("appContent");
        const header = document.querySelector("header");

        function applySidebarState(collapsed) {
            if (collapsed) {
                sidebar.classList.add("sidebar-collapsed");

                appContent.classList.remove("lg:ml-[290px]");
                appContent.classList.add("lg:ml-[80px]");

                header.classList.remove("xl:ml-[290px]", "xl:w-[calc(100%-290px)]");
                header.classList.add("xl:ml-[80px]", "xl:w-[calc(100%-80px)]");
            } else {
                sidebar.classList.remove("sidebar-collapsed");

                appContent.classList.remove("lg:ml-[80px]");
                appContent.classList.add("lg:ml-[290px]");

                header.classList.remove("xl:ml-[80px]", "xl:w-[calc(100%-80px)]");
                header.classList.add("xl:ml-[290px]", "xl:w-[calc(100%-290px)]");
            }
        }

        // Restore state on refresh
        const isCollapsed = localStorage.getItem("sidebarCollapsed") === "true";
        applySidebarState(isCollapsed);

        // Toggle on click
        sidebarToggle?.addEventListener("click", () => {
            const collapsed = !sidebar.classList.contains("sidebar-collapsed");
            localStorage.setItem("sidebarCollapsed", collapsed);
            applySidebarState(collapsed);
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("sidebarOverlay");
        const mobileSidebarToggle = document.getElementById("mobileSidebarToggle"); // mobile hamburger button

        function openSidebar() {
            sidebar.classList.remove("-translate-x-full");
            overlay.classList.remove("hidden");
        }

        function closeSidebar() {
            sidebar.classList.add("-translate-x-full");
            overlay.classList.add("hidden");
        }

        // Mobile toggle button
        mobileSidebarToggle?.addEventListener("click", () => {
            if (sidebar.classList.contains("-translate-x-full")) {
                openSidebar();
            } else {
                closeSidebar();
            }
        });

        // Click overlay to close
        overlay?.addEventListener("click", closeSidebar);

        // When switching to desktop
        window.addEventListener("resize", () => {
            if (window.innerWidth >= 1024) {
                overlay.classList.add("hidden");
                sidebar.classList.remove("-translate-x-full");
            } else {
                sidebar.classList.add("-translate-x-full");
            }
        });
    });
</script>
