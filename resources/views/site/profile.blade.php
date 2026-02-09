@extends('site.common.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div id="appContent"
        class="transition-all duration-300 ease-in-out
           ml-0 lg:ml-[290px] sidebar-collapsed:ml-[80px]
           pt-[72px] sm:pt-[88px] lg:pt-[96px]
           px-4 sm:px-6 pb-6 sm:pb-10
           bg-gray-50 dark:bg-gray-900 min-h-screen">

        <!-- Header -->
        <div class="mb-4 sm:mb-6">
            <x-bread-crumb title="My Profile" :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Profile']]" />
        </div>

        <!-- PROFILE HERO -->
        <div
            class="relative rounded-2xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow p-4 sm:p-6 mb-6 sm:mb-8 overflow-hidden">

            <!-- Gradient bg -->
            <div class="absolute inset-0 bg-gradient-to-r from-primary/5 via-transparent to-purple-500/5"></div>

            <div class="relative flex flex-col md:flex-row md:items-center gap-6">

                <!-- Avatar -->
                <div
                    class="h-24 w-24 rounded-full overflow-hidden shadow-lg ring-4 ring-white dark:ring-gray-800 bg-gray-200">

                    @if ($user->profile_image)
                        <img src="{{ asset('storage/profile/' . $user->profile_image) }}" alt="Profile Image"
                            class="h-full w-full object-cover">
                    @else
                        <div
                            class="h-full w-full flex items-center justify-center bg-gradient-to-br from-primary to-purple-600 text-white text-3xl font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <!-- Info -->
                <div class="flex-1">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        {{ $user->name }}
                        <span class="text-xs px-2 py-1 rounded-full bg-purple-100 text-purple-700">
                            Admin
                        </span>
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $user->email }}
                    </p>

                    <div class="flex flex-wrap gap-2 mt-4">
                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 flex items-center gap-1">
                            <span class="h-2 w-2 rounded-full bg-green-500"></span>
                            Active
                        </span>

                        <span class="px-3 py-1 text-xs rounded-full bg-gray-100 dark:bg-gray-700">
                            Joined {{ $user->created_at }}
                        </span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-2">
                    <button onclick="openEditProfile()"
                        class="px-4 py-2 text-sm rounded-lg bg-primary text-white shadow hover:opacity-90">
                        Edit Profile
                    </button>
                </div>

            </div>
        </div>

        <!-- CONTENT GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 text-gray-900 dark:text-white">

            <!-- LEFT COLUMN -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Security -->
                <div class="rounded-xl bg-white dark:bg-gray-800 shadow p-6">
                    <h3 class="text-sm font-semibold mb-4 text-gray-700 dark:text-gray-300">
                        Security
                    </h3>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="flex items-center gap-2">
                                <i class="bi bi-lock"></i>
                                Password
                            </span>
                            <a href="{{ route('changePassword') }}"
                                class="text-xs font-medium text-primary hover:underline">
                                Change Password
                            </a>
                        </div>

                        <!-- Devices -->
                        <div class="flex justify-between items-center">
                            <span class="flex items-center gap-2">
                                <i class="bi bi-laptop"></i>
                                Logged-in Devices
                            </span>
                            {{-- <span
                                class="text-xs font-medium px-2 py-1 rounded-full
                                {{ $deviceCount > 1 ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                {{ $deviceCount }} Device{{ $deviceCount > 1 ? 's' : '' }}
                            </span> --}}
                            <span class="text-xs font-medium text-green-700">
                                1 Device
                            </span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="flex items-center gap-2">
                                <i class="bi bi-shield-lock"></i>
                                Two Factor Authentication
                            </span>
                            <span class="text-gray-500 text-xs">Disabled</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN -->
            <div class="space-y-6">
                <!-- Activity -->
                <div class="rounded-xl bg-white dark:bg-gray-800 shadow p-6">
                    <h3 class="text-sm font-semibold mb-4 text-gray-700 dark:text-gray-300">
                        Activity
                    </h3>

                    <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400">
                        <div>• Last login:
                            {{ $user->last_login_at ? Carbon::parse($user->last_login_at)->diffForHumans() : 'Never' }}
                        </div>
                        <div>• Password updated:
                            {{ $user->password_updated_at ? Carbon::parse($user->password_updated_at)->diffForHumans() : 'Never' }}
                        </div>
                        <div>• Profile updated:
                            {{ $user->updated_at ? Carbon::parse($user->updated_at)->diffForHumans() : 'Never' }}</div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div id="profileFormModal"
        class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 backdrop-blur-sm">

        <div class="w-full max-w-xl rounded-2xl bg-white dark:bg-gray-900 shadow-xl">

            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Profile
                </h3>
                <button type="button" onclick="closeProfileModal()"
                    class="text-gray-400 hover:text-gray-700 dark:hover:text-white">
                    ✕
                </button>
            </div>

            <!-- Form -->
            <form id="profileForm" class="px-6 py-5 text-gray-900 dark:text-white space-y-4" enctype="multipart/form-data">
                @csrf

                <!-- Image Upload -->
                <div class="flex items-center gap-4">
                    <div class="h-20 w-20 rounded-full overflow-hidden bg-gray-200 border dark:border-gray-700">
                        <img id="profilePreview"
                            src="{{ $user->profile_image ? asset('storage/profile/' . $user->profile_image) : asset('/assets/site/no-image.jpg') }}"
                            class="h-full w-full object-cover">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Profile Image</label>
                        <input type="file" name="profile_image" id="profile_image" accept="image/*" class="text-sm">
                        <p class="text-xs text-gray-500 mt-1">PNG, JPG (max 2MB)</p>
                    </div>
                </div>

                <!-- Name -->
                <div>
                    <label class="block mb-1 text-sm font-medium">Name</label>
                    <input type="text" name="name" id="profile_name" required
                        class="w-full rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2 bg-transparent">
                </div>

                <!-- Email -->
                <div>
                    <label class="block mb-1 text-sm font-medium">Email</label>
                    <input type="email" name="email" id="profile_email" required
                        class="w-full rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2 bg-transparent">
                </div>

                <!-- Footer -->
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="closeProfileModal()"
                        class="px-4 py-2 rounded-lg bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-white">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-lg text-white bg-primary">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const profileModal = document.getElementById('profileFormModal');
        const profileForm = document.getElementById('profileForm');

        function openEditProfile() {
            document.getElementById('profile_name').value = @json($user->name);
            document.getElementById('profile_email').value = @json($user->email);

            profileModal.classList.remove('hidden');
            profileModal.classList.add('flex');
        }

        function closeProfileModal() {
            profileModal.classList.add('hidden');
            profileModal.classList.remove('flex');
        }

        // Image preview
        document.getElementById('profile_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                document.getElementById('profilePreview').src = URL.createObjectURL(file);
            }
        });

        // Submit
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('updateProfile') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function() {
                    location.reload();
                }
            });
        });
    </script>
@endsection
