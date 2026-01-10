@props([
    'title' => '',
    'breadcrumbs' => [],
])

<!-- Breadcrumb -->
<nav>
    <ol class="flex items-center gap-1.5">
        @foreach ($breadcrumbs as $index => $crumb)
            <li>
                @if (!$loop->last)
                    <a href="{{ $crumb['url'] }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500">
                        {{ $crumb['label'] }}
                        <i class="bi bi-chevron-right text-xs"></i>
                    </a>
                @else
                    <span class="text-sm text-gray-900 dark:text-white/90">
                        {{ $crumb['label'] }}
                    </span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
