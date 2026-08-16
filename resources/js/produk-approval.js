window.openApproveModal = function (action, productName) {
    const modal = document.getElementById('approveModal');
    const form = document.getElementById('approveForm');
    const name = document.getElementById('approveProductName');

    form.action = action;
    name.textContent = productName;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
};

window.closeApproveModal = function () {
    const modal = document.getElementById('approveModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');
};

window.openRejectModal = function (action, productName) {
    const modal = document.getElementById('rejectModal');
    const form = document.getElementById('rejectForm');
    const name = document.getElementById('rejectProductName');

    form.action = action;
    name.textContent = productName;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
};

window.closeRejectModal = function () {
    const modal = document.getElementById('rejectModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');
};