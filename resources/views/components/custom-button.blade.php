<button onclick="location.href='{{ route($route) }}'"
    class="relative inline-flex items-center justify-start {{ $px }} {{ $py }} overflow-hidden transition-all bg-primary rounded-xl group {{ $class }}">
    <span
        class="absolute top-0 right-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-secondary rounded group-hover:-mr-4 group-hover:-mt-4">
        <span class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
    </span>
    <span
        class="absolute bottom-0 left-0 w-full h-full transition-all duration-500 ease-in-out delay-200 -translate-x-full translate-y-full bg-primary rounded-2xl group-hover:mb-12 group-hover:translate-x-0"></span>
    <span class="relative w-full text-left text-white transition-colors duration-200 ease-in-out group-hover:text-white">
        {{ $text }} <i class="bi bi-arrow-right ml-1"></i>
    </span>
</button>
