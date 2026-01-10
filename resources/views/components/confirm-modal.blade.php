@props([
    'id' => 'confirmModal',
    'title' => 'Are you sure?',
    'message' => 'This action cannot be undone.',
    'confirmText' => 'Confirm',
    'confirmClass' => 'bg-red-500 hover:bg-red-600',
])

<div id="{{ $id }}"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-700/50 backdrop-blur-sm">

    <div class="w-full max-w-md rounded-2xl bg-white dark:bg-gray-900 shadow-xl">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-900/10 dark:border-white/10">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ $title }}
            </h3>
        </div>

        <!-- Body -->
        <div class="px-6 py-5">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ $message }}
            </p>
        </div>

        <!-- Footer -->
        <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-900/10 dark:border-white/10">
            <button data-confirm-cancel
                class="rounded-lg px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                Cancel
            </button>

            <button data-confirm-action class="rounded-lg px-4 py-2 text-sm font-medium text-white {{ $confirmClass }}">
                {{ $confirmText }}
            </button>
        </div>
    </div>
</div>
