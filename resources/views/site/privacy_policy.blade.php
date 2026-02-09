@extends('site.common.app')

@section('content')
    <div id="appContent"
        class="transition-all duration-300 ease-in-out
           ml-0 lg:ml-[290px] sidebar-collapsed:ml-[80px]
           pt-[72px] sm:pt-[88px] lg:pt-[96px]
           px-4 sm:px-6 pb-6
           bg-white dark:bg-gray-900 min-h-screen">

        <!-- Header -->
        <div class="mb-4 sm:mb-6">
            <x-bread-crumb title="Privacy Policy" :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Privacy Policy']]" />
        </div>

        <!-- Form Card -->
        <div
            class="rounded-xl border border-gray-900/10 dark:border-white/10 shadow-xl bg-white dark:bg-gray-900 p-4 sm:p-6">

            <form id="privacyForm" class="text-gray-900 dark:text-white space-y-5">
                @csrf

                <!-- Title -->
                <div>
                    <label class="block mb-1 text-sm font-medium">Title</label>
                    <input type="text" name="title" value="{{ $title ?? '' }}" placeholder="Enter title"
                        class="w-full rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2 bg-transparent"
                        required>
                </div>

                <!-- Language -->
                <div>
                    <label class="block mb-1 text-sm font-medium">Language</label>
                    <select name="language"
                        class="w-full rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2 bg-transparent"
                        required>
                        <option value="en" {{ ($language ?? '') == 'en' ? 'selected' : '' }}>English</option>
                        <option value="hi" {{ ($language ?? '') == 'hi' ? 'selected' : '' }}>Hindi</option>
                    </select>
                </div>

                <!-- Content -->
                <div>
                    <label class="block mb-1 text-sm font-medium">Content</label>

                    <!-- Editor -->
                    <div id="editor"
                        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 min-h-[300px]">
                    </div>

                    <!-- Hidden input -->
                    <input type="hidden" name="content" id="content">
                </div>

                <!-- Save Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 rounded-lg bg-primary text-white font-medium">
                        Save Privacy Policy
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

    <script>
        // Init Quill
        const quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, 3, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    [{
                        list: 'ordered'
                    }, {
                        list: 'bullet'
                    }],
                    ['link'],
                    ['clean']
                ]
            }
        });

        // Load existing content
        quill.root.innerHTML = `{!! $content ?? '' !!}`;

        // Submit form
        $('#privacyForm').on('submit', function(e) {
            e.preventDefault();

            $('#content').val(quill.root.innerHTML);

            $.ajax({
                url: "{{ route('save.privacy.policy') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function() {
                    alert('Privacy Policy saved successfully');
                }
            });
        });
    </script>
@endsection
