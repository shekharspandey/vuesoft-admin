@extends('site.common.app')

@section('content')
    <div id="appContent"
        class="transition-all duration-300 ease-in-out ml-[290px] pt-[96px] px-6 pb-6 bg-white dark:bg-gray-900 min-h-screen">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                Dashboard
            </h1>
            <p class="text-sm text-gray-400">
                Welcome back, here’s what’s happening today
            </p>
        </div>

        <!-- METRICS -->
        <div class="grid grid-cols-1 gap-x-6 lg:grid-cols-3">
            <!-- LEFT SIDE (2x2 cards) -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:col-span-2">
                @for ($i = 0; $i < 4; $i++)
                    <div class="relative rounded-3xl border border-gray-900/10 dark:border-white/10 p-6 shadow-xl">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gray-100 dark:bg-gray-800 text-white">
                            <i class="bi bi-people text-xl text-gray-900 dark:text-white"></i>
                        </div>
                        <p class="mt-5 text-sm text-gray-500">
                            Customers
                        </p>
                        <div class="mt-2 flex items-center justify-between">
                            <h3 class="text-4xl font-semibold text-gray-900 dark:text-white">
                                3,782
                            </h3>
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-emerald-500/15 px-3 py-1 text-sm font-medium text-emerald-500">
                                ↑ 11.01%
                            </span>
                        </div>
                    </div>
                @endfor
            </div>

            <!-- RIGHT SIDE (Monthly Target – spans 2 rows) -->
            <div class="relative row-span-2 rounded-3xl border border-gray-900/10 dark:border-white/10 p-6 shadow-xl">
                <!-- Header -->
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Monthly Target
                        </h3>
                    </div>
                </div>
                <!-- Gauge -->
                <div class="relative mt-10 flex justify-center">
                    <div class="relative w-64 h-32 overflow-hidden">
                        <div
                            class="absolute bottom-0 left-1/2 h-64 w-64 -translate-x-1/2 rounded-full border-[14px] border-gray-900/15 dark:border-white/15">
                        </div>
                        <div
                            class="absolute bottom-0 left-1/2 h-64 w-64 -translate-x-1/2 rounded-full border-[14px] border-primary border-l-transparent border-b-transparent rotate-[225deg]">
                        </div>
                        <div class="absolute inset-0 flex flex-col items-center justify-end pb-6">
                            <span class="text-4xl font-semibold text-gray-900 dark:text-white">
                                75.55%
                            </span>
                            <span
                                class="mt-2 inline-flex items-center rounded-full bg-emerald-500/15 px-3 py-1 text-sm font-medium text-emerald-500">
                                +10%
                            </span>
                        </div>
                    </div>
                </div>
                <p class="mt-6 text-center text-sm text-gray-400">
                    You earn <span class="font-medium text-gray-900 dark:text-white">$3,287</span> today
                </p>
                <div class="my-6 h-px bg-gray-900/10 dark:bg-white/10"></div>
                <div class="grid grid-cols-3 text-center">
                    <div>
                        <p class="text-sm text-gray-400">Target</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                            $20K <span class="text-red-500">↓</span>
                        </p>
                    </div>
                    <div class="border-x border-white/10">
                        <p class="text-sm text-gray-400">Revenue</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                            $20K <span class="text-emerald-500">↑</span>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Today</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                            $20K <span class="text-emerald-500">↑</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection