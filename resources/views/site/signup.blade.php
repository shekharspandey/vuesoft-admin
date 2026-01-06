<!doctype html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <title>{{ $title ?? 'VueSoft - Your Solution for Modern Apps' }}</title>
    <meta name="description" content="{{ $description ?? 'VueSoft - Your Solution for Modern Apps' }}" />
    <meta name="keywords"
        content="VueSoft, modern web apps, scalable solutions, innovative technology, web development" />
    <meta name="author" content="VueSoft Team" />
    <!-- Open Graph for Social Media Sharing -->
    <meta property="og:title" content="VueSoft - Your Solution for Modern Apps" />
    <meta property="og:description"
        content="VueSoft is your go-to platform for modern, scalable, and innovative web solutions." />
    <meta property="og:image" content="/assets/og-image.png" />
    <meta property="og:url" content="https://www.vue-soft.com" />
    <meta property="og:type" content="website" />
    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="VueSoft - Your Solution for Modern Apps" />
    <meta name="twitter:description"
        content="VueSoft is your go-to platform for modern, scalable, and innovative web solutions." />
    <meta name="twitter:image" content="/assets/twitter-image.png" />
    <!-- Robots -->
    <meta name="robots" content="index, follow" />
    <!-- Canonical URL -->
    <link rel="canonical" href="https://www.vue-soft.com" />
    <!-- Additional Meta Tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="theme-color" content="#007BFF" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script>
        (function () {
            const theme = localStorage.getItem("theme");
            if (theme === "light") {
                document.documentElement.classList.remove("dark");
            }
        })();
    </script>
</head>

<body>
    <div class="relative p-6 bg-white z-1 dark:bg-gray-900 sm:p-0">
        <div
            class="relative flex flex-col justify-center items-center w-full h-screen dark:bg-gray-900 sm:p-0 lg:flex-row">
            <!-- Form Section -->
            <div
                class="flex flex-col w-full lg:max-w-lg border border-gray-200 shadow-xl rounded-3xl dark:border-gray-700">
                <div class="flex flex-col justify-center w-full max-w-md min-h-[650px] mx-auto">

                    <h1 class="mb-6 text-center font-bold text-primary text-sm sm:text-3xl">
                        VueSoft Admin
                    </h1>

                    <div class="mb-5 sm:mb-8">
                        <h2 class="mb-2 font-semibold text-gray-800 text-sm dark:text-white/90 sm:text-xl">
                            Create Account
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Set up your admin account to get started
                        </p>
                    </div>

                    <!-- Signup Form -->
                    <form method="POST" action="{{ route('signup') }}" autocomplete="off">
                        @csrf

                        <div class="space-y-5">

                            <!-- Name -->
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        First Name<span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="first_name" required placeholder="John"
                                        class="auth-input h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-blue-300 focus:ring-3 focus:ring-primary/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                </div>

                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Last Name<span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="last_name" required placeholder="Doe"
                                        class="auth-input h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-blue-300 focus:ring-3 focus:ring-primary/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Email<span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" required placeholder="info@gmail.com"
                                    class="auth-input h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-blue-300 focus:ring-3 focus:ring-primary/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                            </div>

                            <!-- Password -->
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Password<span class="text-red-500">*</span>
                                </label>
                                <input type="password" name="password" required placeholder="Create a strong password"
                                    class="auth-input h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-blue-300 focus:ring-3 focus:ring-primary/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Confirm Password<span class="text-red-500">*</span>
                                </label>
                                <input type="password" name="password_confirmation" required
                                    placeholder="Confirm your password"
                                    class="auth-input h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-blue-300 focus:ring-3 focus:ring-primary/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                            </div>

                            <!-- Submit -->
                            <button type="submit"
                                class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-primary hover:bg-secondary">
                                Create Account
                            </button>
                        </div>
                    </form>

                    <p class="mt-5 text-sm text-center text-gray-700 dark:text-gray-400 sm:text-start">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-primary hover:text-secondary">
                            Sign In
                        </a>
                    </p>

                </div>
            </div>

            <!-- Right Side -->
            <!-- <div class="relative hidden w-full h-full bg-gray-900 dark:bg-white/5 lg:grid lg:w-1/2 bg-cover bg-center bg-no-repeat before:absolute before:inset-0 before:bg-gray-900/70 before:content-['']" 
                style="background-image: url('/assets/site/auth-bg.jpg');">
                <div class="flex items-center justify-center z-10">
                    <div class="flex flex-col items-center max-w-xs">
                        <p class="mb-4 text-3xl font-semibold text-primary hover:text-secondary">
                            VueSoft Admin
                        </p>
                        <p class="text-center text-gray-400 dark:text-white/60">
                            Everything you need to manage your work thoughtfully designed for you
                        </p>
                    </div>
                </div>
                <div class="absolute bottom-6 right-6 z-20">
                    <button id="themeToggle"
                        class="relative flex items-center justify-center transition-colors text-white bg-primary rounded-full h-14 w-14">
                        <i class="bi bi-brightness-high hidden dark:block"></i>
                        <i class="bi bi-moon dark:hidden"></i>
                    </button>
                </div>
            </div> -->

            <!-- Theme Toggle Button -->
            <div class="absolute bottom-6 right-6 z-20">
                <button id="themeToggle"
                    class="relative flex items-center justify-center transition-colors text-white bg-primary rounded-full h-14 w-14">
                    <i class="bi bi-brightness-high hidden dark:block"></i>
                    <i class="bi bi-moon dark:hidden"></i>
                </button>
            </div>
        </div>
    </div>

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
</body>

</html>