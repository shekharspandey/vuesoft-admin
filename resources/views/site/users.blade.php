@extends('site.common.app')

@section('content')
    <div id="appContent"
        class="transition-all duration-300 ease-in-out ml-[290px] pt-[96px] px-6 pb-6 bg-white dark:bg-gray-900 min-h-screen">

        <!-- Header -->
        <div class="mb-6">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                <x-bread-crumb title="Users" :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Users']]" />

                <div class="flex gap-3">
                    <button
                        class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
                        <i class="bi bi-bell"></i>
                        Send Notification
                    </button>
                    {{-- <a href="javascript:void(0)" onclick="openAddUser()"
                        class="bg-primary shadow-theme-xs hover:bg-brand-600 inline-flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-sm font-medium text-white transition">
                        <i class="fa fa-plus"></i>
                        Add User
                    </a> --}}
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="relative rounded-xl border border-gray-900/10 dark:border-white/10 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table id="customTable" class="w-full text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-4 text-left">
                                <input type="checkbox" id="selectAll"
                                    class="h-4 w-4 rounded border-gray-300 accent-primary focus:ring-primary">
                            </th>
                            <th class="px-6 py-4 text-left">User</th>
                            <th class="px-6 py-4 text-left">Email</th>
                            <th class="px-6 py-4 text-left">Role</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-left">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Add / Edit User Modal -->
    <div id="userFormModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 backdrop-blur-sm">

        <div class="w-full max-w-xl rounded-2xl bg-white dark:bg-gray-900 shadow-xl">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-900/10 dark:border-white/10">
                <h3 id="userFormTitle" class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add User
                </h3>
                <button type="button" id="closeUserModal" class="text-gray-400 hover:text-gray-700 dark:hover:text-white">
                    ✕
                </button>
            </div>

            <!-- Form -->
            <form id="userForm" class="px-6 py-5 text-gray-900 dark:text-white space-y-4">
                @csrf
                <input type="hidden" id="user_id" name="user_id">

                <div>
                    <label class="block mb-1 text-sm font-medium">Name</label>
                    <input type="text" name="name" id="name" required placeholder="Enter Name"
                        class="w-full rounded-lg border px-4 py-2 bg-transparent dark:border-gray-700">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Email</label>
                    <input type="email" name="email" id="email" required placeholder="Enter Email"
                        class="w-full rounded-lg border px-4 py-2 bg-transparent dark:border-gray-700">
                </div>

                <div id="passwordWrapper">
                    <label class="block mb-1 text-sm font-medium">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter Email"
                        class="w-full rounded-lg border px-4 py-2 bg-transparent dark:border-gray-700">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Role</label>
                    <select name="role" id="role"
                        class="w-full rounded-lg border px-4 py-2 bg-transparent dark:border-gray-700">
                        <option value="User">User</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>

                <!-- Footer -->
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" id="cancelUserModal"
                        class="px-4 py-2 rounded-lg text-sm bg-gray-100 dark:bg-gray-800">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-lg text-sm text-white bg-primary">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            const table = $('#customTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.data') }}",

                columns: [{
                        data: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'user',
                        orderable: false
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'role',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],

                pageLength: 10,
                lengthChange: true,
                ordering: false,

                language: {
                    lengthMenu: "Showing _MENU_ records per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ records",
                    infoEmpty: "No record available",
                    zeroRecords: "No matching record found",
                    paginate: {
                        previous: "Prev",
                        next: "Next"
                    }
                },

                drawCallback: function() {
                    $('#selectAll').prop('checked', false);
                }
            });

            // Select All
            $('#selectAll').on('change', function() {
                $('.rowCheckbox').prop('checked', this.checked);
            });

            // Row checkbox sync
            $(document).on('change', '.rowCheckbox', function() {
                $('#selectAll').prop(
                    'checked',
                    $('.rowCheckbox:checked').length === $('.rowCheckbox').length
                );
            });
        });
    </script>

    <script>
        const userModal = document.getElementById('userFormModal');
        const userForm = document.getElementById('userForm');
        const title = document.getElementById('userFormTitle');
        const passwordWrapper = document.getElementById('passwordWrapper');

        function openAddUser() {
            title.innerText = 'Add User';
            userForm.reset();
            document.getElementById('user_id').value = '';
            passwordWrapper.classList.remove('hidden');
            showUserModal();
        }

        function openEditUser(user) {
            title.innerText = 'Edit User';
            document.getElementById('user_id').value = user.id;
            document.getElementById('name').value = user.name;
            document.getElementById('email').value = user.email;
            document.getElementById('role').value = user.role || 'User';

            passwordWrapper.classList.add('hidden'); // password optional on edit
            showUserModal();
        }

        function showUserModal() {
            userModal.classList.remove('hidden');
            userModal.classList.add('flex');
        }

        function closeUserModal() {
            userModal.classList.add('hidden');
            userModal.classList.remove('flex');
        }

        document.getElementById('closeUserModal').onclick = closeUserModal;
        document.getElementById('cancelUserModal').onclick = closeUserModal;

        // Submit (same for add & edit)
        userForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const id = document.getElementById('user_id').value;
            const url = id ? `/users/${id}` : `/users`;
            const method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: $(this).serialize(),
                success: function() {
                    $('#customTable').DataTable().ajax.reload(null, false);
                    closeUserModal();
                }
            });
        });
    </script>
@endsection
