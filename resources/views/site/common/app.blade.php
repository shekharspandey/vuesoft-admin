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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>


    <script>
        (function() {
            const theme = localStorage.getItem("theme");
            if (theme === "light") {
                document.documentElement.classList.remove("dark");
            }
        })();
    </script>
</head>

<body>
    @include('site.common.header')

    @include('site.common.sidebar')

    <main>
        @yield('content')
    </main>

    @include('site.common.footer')
</body>

</html>
