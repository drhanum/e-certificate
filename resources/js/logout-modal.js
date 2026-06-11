document.addEventListener('DOMContentLoaded', function () {
    const logoutButton = document.getElementById('logoutButton');
    const logoutModal = document.getElementById('logoutModal');
    const logoutCancel = document.getElementById('logoutCancel');

    if (!logoutButton || !logoutModal || !logoutCancel) {
        return;
    }

    logoutButton.addEventListener('click', function () {
        logoutModal.classList.remove('hidden');
        logoutModal.classList.add('flex');
    });

    logoutCancel.addEventListener('click', function () {
        logoutModal.classList.add('hidden');
        logoutModal.classList.remove('flex');
    });

    logoutModal.addEventListener('click', function (event) {
        if (event.target === logoutModal) {
            logoutModal.classList.add('hidden');
            logoutModal.classList.remove('flex');
        }
    });
});
