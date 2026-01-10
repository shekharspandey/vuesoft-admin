@extends('site.common.app')

@section('content')
    <div id="appContent"
        class="transition-all duration-300 ease-in-out ml-[290px] pt-[96px] px-6 pb-10 bg-gray-50 dark:bg-gray-900 min-h-screen">

        <!-- Header -->
        <div class="mb-6">
            <x-bread-crumb title="Change Password" :breadcrumbs="[
                ['label' => 'Home', 'url' => route('dashboard')],
                ['label' => 'Profile', 'url' => route('profile')],
                ['label' => 'Change Password'],
            ]" />
        </div>

        <!-- HERO CARD -->
        <div class="relative rounded-2xl bg-white dark:bg-gray-800 shadow p-6 mb-8 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/5 via-transparent to-purple-500/5"></div>

            <div class="relative flex items-center gap-4">
                <div
                    class="h-14 w-14 flex items-center justify-center rounded-xl
                bg-primary/10 text-primary text-2xl">
                    <i class="bi bi-shield-lock"></i>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Secure Your Account
                    </h2>
                    <p class="text-sm text-gray-500">
                        Update your password to keep your account safe
                    </p>
                </div>
            </div>
        </div>

        <!-- CONTENT GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- FORM -->
            <div class="lg:col-span-2">
                <div class="rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow p-6">
                    <h3 class="font-semibold mb-6">
                        Change Password
                    </h3>

                    <form id="changePasswordForm" class="space-y-5">
                        @csrf

                        <!-- Current Password -->
                        <div>
                            <label class="block mb-1 text-sm font-medium">
                                Current Password
                            </label>
                            <input type="password" name="current_password" required
                                class="w-full rounded-lg border border-gray-200 dark:border-gray-700
                            px-4 py-2 bg-transparent focus:ring-2 focus:ring-primary">
                        </div>

                        <!-- New Password -->
                        <div>
                            <label class="block mb-1 text-sm font-medium">
                                New Password
                            </label>
                            <input type="password" name="password" required
                                class="w-full rounded-lg border border-gray-200 dark:border-gray-700
                            px-4 py-2 bg-transparent focus:ring-2 focus:ring-primary">
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="block mb-1 text-sm font-medium">
                                Confirm New Password
                            </label>
                            <input type="password" name="password_confirmation" required
                                class="w-full rounded-lg border border-gray-200 dark:border-gray-700
                            px-4 py-2 bg-transparent focus:ring-2 focus:ring-primary">
                        </div>

                        <!-- Footer -->
                        <div class="flex justify-end gap-3 pt-4">
                            <a href="{{ route('profile') }}"
                                class="px-4 py-2 rounded-lg bg-gray-100 text-gray-900
                            dark:bg-gray-700 dark:text-white">
                                Cancel
                            </a>
                            <button type="submit" class="px-4 py-2 rounded-lg bg-primary text-white shadow">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- RIGHT INFO -->
            <div class="space-y-6">
                <div class="rounded-xl bg-white dark:bg-gray-800 shadow p-6">
                    <h3 class="text-sm font-semibold mb-4 text-gray-700 dark:text-gray-300">
                        Password Tips
                    </h3>

                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                        <li>• Minimum 8 characters</li>
                        <li>• Use uppercase & lowercase letters</li>
                        <li>• Include numbers & symbols</li>
                        <li>• Avoid common words</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('changePassword') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function(res) {
                    alert('Password updated successfully');
                    window.location.href = "{{ route('profile') }}";
                },
                error: function(xhr) {
                    alert(xhr.responseJSON?.message || 'Something went wrong');
                }
            });
        });
    </script>
@endsection
