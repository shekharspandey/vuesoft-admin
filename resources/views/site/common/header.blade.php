<header
    class="fixed top-0 right-0 z-50 h-[72px] bg-white dark:bg-gray-900 backdrop-blur border-b border-gray-900/10 dark:border-white/5 transition-all duration-300 ease-in-out ml-[290px] w-[calc(100%-290px)]">
    <div class="flex h-full items-center justify-between px-6">
        <!-- LEFT -->
        <div class="flex items-center gap-4">
            <!-- Desktop Sidebar Toggle Button (visible on xl and up) -->
            <button id="sidebarToggle"
                class="hidden xl:flex items-center justify-center w-10 h-10 text-gray-500 border border-gray-200 rounded-lg dark:border-gray-800 dark:text-gray-400 lg:h-11 lg:w-11"
                aria-label="Toggle Sidebar">
                <i class="bi bi-list"></i>
            </button>
        </div>
        <!-- RIGHT -->
        <div class="flex items-center gap-3">
            <!-- Theme Toggle Button -->
            <button id="themeToggle"
                class="relative flex items-center justify-center text-gray-500 transition-colors bg-white border border-gray-200 rounded-full hover:text-dark-900 h-11 w-11 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                <i class="bi bi-brightness-high hidden dark:block"></i>
                <i class="bi bi-moon dark:hidden"></i>
            </button>

            <!-- User -->
            <div class="relative" id="profileDropdownWrapper">
                <!-- Trigger -->
                <button id="profileToggle"
                    class="flex items-center gap-3 rounded-xl px-3 py-2 transition focus:outline-none">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary">
                        <span class="text-white font-bold">S</span>
                    </div>
                    <span class="hidden sm:block text-sm font-medium text-gray-900 dark:text-white">
                        Shekhar Pandey
                    </span>
                    <i id="profileArrow" class="bi bi-chevron-down text-gray-400 transition-transform"></i>
                </button>

                <!-- Dropdown -->
                <div id="profileDropdown"
                    class="absolute right-0 mt-3 w-72 hidden rounded-2xl bg-white dark:bg-gray-900 border border-gray-900/10 dark:border-white/10">

                    <div class="px-5 py-4">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">Shekhar Pandey</p>
                        <p class="text-xs text-gray-400">shekhar@pandey.com</p>
                    </div>

                    <div class="h-px bg-gray-900/10 dark:bg-white/10"></div>

                    <ul class="p-2 space-y-1">
                        <li>
                            <a href="#"
                                class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800">
                                Profile
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800">
                                Change Password
                            </a>
                        </li>
                    </ul>

                    <div class="h-px bg-gray-900/10 dark:bg-white/10"></div>

                    <div class="p-2">
                        <a href="{{ route('login') }}"
                            class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm text-red-500 hover:bg-red-500/10">
                            Sign out
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</header>

<script>
    const toggleBtn = document.getElementById("profileToggle");
    const dropdown = document.getElementById("profileDropdown");
    const arrow = document.getElementById("profileArrow");

    toggleBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        dropdown.classList.toggle("hidden");
        arrow.classList.toggle("rotate-180");
    });

    document.addEventListener("click", () => {
        dropdown.classList.add("hidden");
        arrow.classList.remove("rotate-180");
    });
</script>

<script>
    const themeToggle = document.getElementById("themeToggle");

    if (themeToggle) {
        themeToggle.addEventListener("click", () => {
            const html = document.documentElement;

            if (html.classList.contains("dark")) {
                html.classList.remove("dark");
                localStorage.setItem("theme", "light");
            } else {
                html.classList.add("dark");
                localStorage.setItem("theme", "dark");
            }
        });
    }
</script>