@extends('site.common.app')

@section('content')
    <div class="bg-white flex flex-col items-center justify-center min-h-screen">
        <div class="max-w-6xl text-center">
            <img src="{{ asset('assets/site/404.svg') }}" alt="404 Not Found" loading="lazy" class="mx-auto w-full mb-3">
        </div>
        <p class="text-lg text-gray-700">The page you’re looking for doesn’t exist or may have been moved!</p>
    </div>
@endsection
