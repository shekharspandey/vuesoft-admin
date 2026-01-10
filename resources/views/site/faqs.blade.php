@extends('site.common.app')

@section('content')
    <div id="appContent"
        class="transition-all duration-300 ease-in-out ml-[290px] pt-[96px] px-6 pb-6 bg-white dark:bg-gray-900 min-h-screen">

        <!-- Header -->
        <div class="mb-6">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                <x-bread-crumb title="FAQs" :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'FAQs']]" />

                <a href="javascript:void(0)" onclick="openAddFaq()"
                    class="bg-primary shadow-theme-xs hover:bg-brand-600 inline-flex items-center gap-2 rounded-lg px-4 py-3 text-sm font-medium text-white transition">
                    <i class="fa fa-plus"></i>
                    Add FAQ
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="relative rounded-xl border border-gray-900/10 dark:border-white/10 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table id="faqTable" class="w-full text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4 text-left">ID</th>
                            <th class="px-6 py-4 text-left">Question</th>
                            <th class="px-6 py-4 text-left">Answer</th>
                            <th class="px-6 py-4 text-left">Created At</th>
                            <th class="px-6 py-4 text-left">Category</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-left">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- FAQ Modal -->
    <div id="faqFormModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 backdrop-blur-sm">

        <div class="w-full max-w-2xl rounded-2xl bg-white dark:bg-gray-900 shadow-xl">

            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 id="faqFormTitle" class="text-lg text-gray-900 dark:text-white font-semibold">
                    Add FAQ
                </h3>
                <button type="button" onclick="closeFaqModal()"
                    class="text-gray-400 hover:text-gray-700 dark:hover:text-white">
                    ✕
                </button>
            </div>

            <!-- Form -->
            <form id="faqForm" class="px-6 py-5 text-gray-900 dark:text-white space-y-4">
                @csrf
                <input type="hidden" id="faq_id" name="faq_id">

                <div>
                    <label class="block mb-1 text-sm font-medium">Question</label>
                    <input type="text" name="question" id="question" required placeholder="Enter Question"
                        class="w-full rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2 bg-transparent">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Answer</label>
                    <textarea name="answer" id="answer" rows="4" required placeholder="Enter Answer"
                        class="w-full rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2 bg-transparent"></textarea>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Category</label>
                    <input type="text" name="category" id="category" placeholder="Enter Category"
                        class="w-full rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2 bg-transparent">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Status</label>
                    <select name="status" id="status"
                        class="w-full rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2 bg-transparent">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="closeFaqModal()"
                        class="px-4 py-2 rounded-lg bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-white">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-lg text-white bg-primary">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            const table = $('#faqTable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                autoWidth: false, // 🔥 THIS is mandatory
                ajax: "{{ route('faqs.data') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        width: '60px'
                    },
                    {
                        data: 'question',
                        width: '280px'
                    },
                    {
                        data: 'answer',
                        width: '380px'
                    },
                    {
                        data: 'category',
                        width: '140px'
                    },
                    {
                        data: 'created_at',
                        width: '140px'
                    },
                    {
                        data: 'status',
                        width: '120px'
                    },
                    {
                        data: 'action',
                        width: '120px'
                    }
                ],

                fixedColumns: false,

                pageLength: 10,
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

            $('#selectAll').on('change', function() {
                $('.rowCheckbox').prop('checked', this.checked);
            });
        });
    </script>

    <script>
        const faqModal = document.getElementById('faqFormModal');
        const faqForm = document.getElementById('faqForm');

        function openAddFaq() {
            document.getElementById('faqFormTitle').innerText = 'Add FAQ';
            faqForm.reset();
            document.getElementById('faq_id').value = '';
            showFaqModal();
        }

        function openEditFaq(faq) {
            document.getElementById('faqFormTitle').innerText = 'Edit FAQ';
            document.getElementById('faq_id').value = faq.id;
            document.getElementById('question').value = faq.question;
            document.getElementById('answer').value = faq.answer;
            document.getElementById('category').value = faq.category;
            document.getElementById('status').value = faq.status;
            showFaqModal();
        }

        function showFaqModal() {
            faqModal.classList.remove('hidden');
            faqModal.classList.add('flex');
        }

        function closeFaqModal() {
            faqModal.classList.add('hidden');
            faqModal.classList.remove('flex');
        }

        faqForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const id = document.getElementById('faq_id').value;
            const url = id ? `/faqs/${id}` : `/faqs`;
            const method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: $(this).serialize(),
                success: function() {
                    $('#faqTable').DataTable().ajax.reload(null, false);
                    closeFaqModal();
                }
            });
        });
    </script>
@endsection
