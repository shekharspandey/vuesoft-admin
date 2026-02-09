@extends('site.common.app')

@section('content')
    <div id="appContent"
        class="transition-all duration-300 ease-in-out
           ml-0 lg:ml-[290px] sidebar-collapsed:ml-[80px]
           pt-[72px] sm:pt-[88px] lg:pt-[96px]
           px-4 sm:px-6 pb-6 sm:pb-10
           bg-gray-50 dark:bg-gray-900 min-h-screen">

        <!-- Header -->
        <div class="mb-4 sm:mb-6">
            <x-bread-crumb title="Change Password" :breadcrumbs="[
                ['label' => 'Home', 'url' => route('dashboard')],
                ['label' => 'Profile', 'url' => route('profile')],
                ['label' => 'Change Password'],
            ]" />
        </div>

        <!-- HERO CARD -->
        <div class="relative rounded-2xl bg-white dark:bg-gray-800 shadow p-4 sm:p-6 mb-6 sm:mb-8 overflow-hidden">
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

                    @if ($errors->any())
                        <div class="mb-4 rounded-lg bg-red-500/10 px-4 py-2 text-sm text-red-600">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <form id="changePasswordForm" class="space-y-5">
                        @csrf

                        <!-- Current Password -->
                        <div class="relative">
                            <input type="password" id="currentPassword" name="current_password" required
                                placeholder="Enter Current Password"
                                class="w-full rounded-lg border border-gray-200 dark:border-gray-700
        px-4 pr-11 py-2 bg-transparent focus:ring-2 focus:ring-primary">

                            <button type="button" class="absolute inset-y-0 right-3 flex items-center text-gray-500"
                                onclick="toggleEye('currentPassword', this)">
                                <i class="bi bi-eye"></i>
                                <i class="bi bi-eye-slash hidden"></i>
                            </button>
                        </div>

                        <!-- New Password -->
                        <div class="relative">
                            <input type="password" id="newPassword" name="password" required
                                placeholder="Enter New Password"
                                class="w-full rounded-lg border border-gray-200 dark:border-gray-700
        px-4 pr-11 py-2 bg-transparent focus:ring-2 focus:ring-primary">

                            <button type="button" class="absolute inset-y-0 right-3 flex items-center text-gray-500"
                                onclick="toggleEye('newPassword', this)">
                                <i class="bi bi-eye"></i>
                                <i class="bi bi-eye-slash hidden"></i>
                            </button>
                        </div>

                        <!-- Confirm Password -->
                        <div class="relative">
                            <input type="password" id="confirmPassword" name="password_confirmation" required
                                placeholder="Confirm New Password"
                                class="w-full rounded-lg border border-gray-200 dark:border-gray-700
        px-4 pr-11 py-2 bg-transparent focus:ring-2 focus:ring-primary">

                            <button type="button" class="absolute inset-y-0 right-3 flex items-center text-gray-500"
                                onclick="toggleEye('confirmPassword', this)">
                                <i class="bi bi-eye"></i>
                                <i class="bi bi-eye-slash hidden"></i>
                            </button>
                        </div>

                        <!-- Footer -->
                        <div class="flex justify-end gap-3 pt-4">
                            <a href="{{ route('profile') }}"
                                class="px-4 py-2 rounded-lg bg-gray-100 text-gray-900
                            dark:bg-gray-700 dark:text-white">
                                Cancel
                            </a>
                            <button type="submit" class="px-4 py-2 rounded-lg bg-primary text-white shadow">
                                Update
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
                        <li>• Use uppercase & lowercase</li>
                        <li>• Include numbers & symbols</li>
                        <li>• Avoid common words</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <script>
        function toggleEye(inputId, btn) {
            const input = document.getElementById(inputId);
            const eyeOpen = btn.children[0];
            const eyeClose = btn.children[1];

            const isPassword = input.type === 'password';

            input.type = isPassword ? 'text' : 'password';
            eyeOpen.classList.toggle('hidden', isPassword);
            eyeClose.classList.toggle('hidden', !isPassword);
        }
    </script>

    <script>
        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('updatePassword') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function(res) {
                    showToast("Profile updated successfully", "error");
                    window.location.href = "{{ route('profile') }}";
                },
                error: function(xhr) {
                    showToast(xhr.responseJSON?.message || "Something went wrong", "error");
                }
            });
        });
    </script>
@endsection
