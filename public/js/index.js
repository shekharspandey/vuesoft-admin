// Js For Testimonial Slider
const secondAnimateSlide = document.querySelector('.animate-slide');
const parentContainer = secondAnimateSlide.parentNode;

for (let i = 0; i < 3; i++) {
    const clonedDiv = secondAnimateSlide.cloneNode(true);
    parentContainer.appendChild(clonedDiv);
}

document.addEventListener('DOMContentLoaded', function () {
    const table = $('#usersTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        pageLength: 5,
        lengthChange: false,
        columnDefs: [
            { orderable: false, targets: [0, 5] }
        ]
    });

    // Select all
    const selectAll = document.getElementById('selectAll');

    selectAll.addEventListener('change', function () {
        document.querySelectorAll('.rowCheckbox')
            .forEach(cb => cb.checked = this.checked);
    });

    // Sync select all
    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('rowCheckbox')) {
            const all = document.querySelectorAll('.rowCheckbox');
            const checked = document.querySelectorAll('.rowCheckbox:checked');
            selectAll.checked = all.length === checked.length;
        }
    });
});
