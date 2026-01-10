@extends('site.common.app')

@section('content')
    <div id="appContent"
        class="transition-all duration-300 ease-in-out ml-[290px] pt-[96px] px-6 pb-6 bg-gray-50 dark:bg-gray-900 min-h-screen">

        <!-- Header -->
        <div class="mb-6 flex items-center justify-between">
            <x-bread-crumb title="User Details" :breadcrumbs="[
                ['label' => 'Home', 'url' => route('dashboard')],
                ['label' => 'Users', 'url' => route('users')],
                ['label' => 'View'],
            ]" />
        </div>

        <!-- Profile Card -->
        <div class="relative overflow-hidden rounded-xl bg-white dark:bg-gray-800 shadow p-6 mb-6">

            <!-- Soft Gradient Background -->
            <div
                class="absolute inset-0 bg-gradient-to-r from-primary/5 via-transparent to-purple-500/5 pointer-events-none">
            </div>

            <!-- Status Badge -->
            <span
                class="absolute top-5 right-5 flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold
        {{ $user->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                <span class="h-2 w-2 rounded-full
            {{ $user->status ? 'bg-green-500' : 'bg-red-500' }}">
                </span>
                {{ $user->status ? 'Active' : 'Inactive' }}
            </span>

            <div class="relative flex items-center gap-6">

                <!-- Avatar -->
                <div
                    class="h-24 w-24 rounded-full bg-gradient-to-br from-primary to-secondary
                   text-white flex items-center justify-center text-3xl font-bold shadow-lg ring-4 ring-white dark:ring-gray-800">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <!-- Info -->
                <div class="flex-1">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        {{ $user->name }}

                        @if ($user->role === 'Admin')
                            <i class="bi bi-shield-check text-purple-600 text-lg"></i>
                        @endif
                    </h2>

                    <p class="text-sm text-gray-500 dark:text-gray-300 mt-1 flex items-center gap-2">
                        <i class="bi bi-envelope"></i>
                        {{ $user->email }}
                    </p>

                    <!-- Meta Pills -->
                    <div class="flex flex-wrap gap-2 mt-4">

                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 text-xs rounded-full
                    {{ $user->role === 'Admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                            <i class="bi bi-person-badge"></i>
                            {{ $user->role }}
                        </span>

                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700 dark:bg-gray-600 dark:text-gray-200">
                            <i class="bi bi-calendar-event"></i>
                            Joined {{ $user->created_at }}
                        </span>

                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700 dark:bg-gray-600 dark:text-gray-200">
                            <i class="bi bi-clock-history"></i>
                            Last Updated {{ $user->updated_at }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Account Info -->
            <div class="rounded-xl bg-white dark:bg-gray-800 shadow p-5">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">
                    Account Information
                </h3>

                <div class="space-y-4 text-sm text-gray-900 dark:text-gray-300">
                    <div class="flex justify-between">
                        <span class="text-gray-700 dark:text-gray-400">User ID</span>
                        <span class="font-medium">#{{ $user->id }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-700 dark:text-gray-400">Email</span>
                        <span class="font-medium">{{ $user->email }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-700 dark:text-gray-400">Role</span>
                        <span class="font-medium">{{ $user->role }}</span>
                    </div>
                </div>
            </div>

            <!-- Meta Info -->
            <div class="rounded-xl bg-white dark:bg-gray-800 shadow p-5">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">
                    Activity
                </h3>

                <div class="space-y-4 text-sm text-gray-900 dark:text-gray-300">
                    <div class="flex justify-between">
                        <span class="text-gray-700 dark:text-gray-400">Status</span>
                        <span class="font-medium">
                            {{ $user->status ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-700 dark:text-gray-400">Created At</span>
                        <span class="font-medium">
                            {{ $user->created_at }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-700 dark:text-gray-400">Last Updated</span>
                        <span class="font-medium">
                            {{ $user->updated_at }}
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
