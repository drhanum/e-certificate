document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-clear-target]').forEach(function (button) {
        button.addEventListener('click', function () {
            var selector = button.getAttribute('data-clear-target');
            var input = document.querySelector(selector);

            if (input && input.type === 'file') {
                input.value = '';

                if (selector === '#templateInput') {
                    var preview = document.getElementById('template-preview');
                    if (preview) {
                        preview.src = '';
                    }
                }
            }
        });
    });
});
