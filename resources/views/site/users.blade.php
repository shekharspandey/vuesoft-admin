@extends('site.common.app')

@section('content')
    <div id="appContent"
        class="transition-all duration-300 ease-in-out ml-[290px] pt-[96px] px-6 pb-6 bg-white dark:bg-gray-900 min-h-screen">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                Users
            </h1>
            <p class="text-sm text-gray-400">
                Manage all registered users
            </p>
        </div>

        <!-- Table Card -->
        <div class="relative rounded-xl border border-gray-900/10 dark:border-white/10 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table id="customTable" class="w-full text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-4 !text-center">
                                <input type="checkbox" id="selectAll"
                                    class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                            </th>
                            <th class="px-6 py-4 text-left">User</th>
                            <th class="px-6 py-4 text-left">Email</th>
                            <th class="px-6 py-4 text-left">Role</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 !text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-900/10 dark:divide-white/10">
                        @for ($i = 1; $i <= 8; $i++)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                <td class="px-4 py-4 text-center">
                                    <input type="checkbox"
                                        class="rowCheckbox h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary"
                                        value="{{ $i }}">
                                </td>

                                <td class="px-6 py-4 flex items-center gap-3">
                                    <div
                                        class="h-10 w-10 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                            U
                                        </span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">
                                            User {{ $i }}
                                        </p>
                                        <p class="text-xs text-gray-400">
                                            Joined Jan {{ $i }}, 2025
                                        </p>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                                    user{{ $i }}@example.com
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex rounded-full bg-blue-500/15 px-3 py-1 text-xs font-medium text-blue-500">
                                        Admin
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex rounded-full bg-emerald-500/15 px-3 py-1 text-xs font-medium text-emerald-500">
                                        Active
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <button
                                        class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                        <i class="bi bi-pencil"></i>
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection