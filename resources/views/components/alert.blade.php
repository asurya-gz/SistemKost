<!-- Custom Alert Component -->
<div id="customAlert" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.5)] border border-gray-200 max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="alertModal">
        <div class="p-6">
            <!-- Alert Icon -->
            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full" id="alertIcon">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="alertSvg">
                    <!-- Default warning icon -->
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.502 0L4.732 14.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            
            <!-- Alert Content -->
            <div class="text-center">
                <h3 class="text-xl font-bold text-gray-900 mb-2" id="alertTitle">Alert</h3>
                <p class="text-gray-600 mb-6" id="alertMessage">This is an alert message.</p>
            </div>
            
            <!-- Alert Buttons -->
            <div class="flex gap-3" id="alertButtons">
                <button type="button" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-4 rounded-lg transition-colors duration-200" onclick="closeAlert()">
                    Batal
                </button>
                <button type="button" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200" onclick="confirmAlert()">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Custom Toast Notification -->
<div id="toastContainer" class="fixed top-4 right-4 z-50 space-y-3"></div>

<script>
let alertCallback = null;

// Show custom alert
function showAlert(options = {}) {
    const {
        title = 'Alert',
        message = 'This is an alert message.',
        type = 'warning', // success, error, warning, info
        confirmText = 'OK',
        cancelText = 'Batal',
        showCancel = true,
        onConfirm = null,
        onCancel = null
    } = options;

    const alertElement = document.getElementById('customAlert');
    const alertModal = document.getElementById('alertModal');
    const alertIcon = document.getElementById('alertIcon');
    const alertSvg = document.getElementById('alertSvg');
    const alertTitle = document.getElementById('alertTitle');
    const alertMessage = document.getElementById('alertMessage');
    const alertButtons = document.getElementById('alertButtons');

    // Set content
    alertTitle.textContent = title;
    alertMessage.textContent = message;

    // Set icon and colors based on type
    let iconClass = '';
    let svgPath = '';
    
    switch (type) {
        case 'success':
            iconClass = 'bg-green-100 text-green-600';
            svgPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
            break;
        case 'error':
            iconClass = 'bg-red-100 text-red-600';
            svgPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
            break;
        case 'info':
            iconClass = 'bg-blue-100 text-blue-600';
            svgPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
            break;
        default: // warning
            iconClass = 'bg-yellow-100 text-yellow-600';
            svgPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.502 0L4.732 14.5c-.77.833.192 2.5 1.732 2.5z"></path>';
    }

    alertIcon.className = `flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full ${iconClass}`;
    alertSvg.innerHTML = svgPath;

    // Set buttons
    if (showCancel) {
        alertButtons.innerHTML = `
            <button type="button" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-4 rounded-lg transition-colors duration-200" onclick="closeAlert()">
                ${cancelText}
            </button>
            <button type="button" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200" onclick="confirmAlert()">
                ${confirmText}
            </button>
        `;
    } else {
        alertButtons.innerHTML = `
            <button type="button" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200" onclick="confirmAlert()">
                ${confirmText}
            </button>
        `;
    }

    // Set callbacks
    alertCallback = { onConfirm, onCancel };

    // Show alert
    alertElement.classList.remove('hidden');
    setTimeout(() => {
        alertModal.classList.remove('scale-95', 'opacity-0');
        alertModal.classList.add('scale-100', 'opacity-100');
    }, 50);
}

// Close alert
function closeAlert() {
    const alertElement = document.getElementById('customAlert');
    const alertModal = document.getElementById('alertModal');
    
    alertModal.classList.remove('scale-100', 'opacity-100');
    alertModal.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        alertElement.classList.add('hidden');
    }, 300);

    if (alertCallback && alertCallback.onCancel) {
        alertCallback.onCancel();
    }
    alertCallback = null;
}

// Confirm alert
function confirmAlert() {
    if (alertCallback && alertCallback.onConfirm) {
        alertCallback.onConfirm();
    }
    closeAlert();
}

// Show toast notification
function showToast(message, type = 'info', duration = 3000) {
    const toastContainer = document.getElementById('toastContainer');
    const toastId = 'toast_' + Date.now();
    
    let bgColor = '';
    let textColor = '';
    let icon = '';
    
    switch (type) {
        case 'success':
            bgColor = 'bg-green-500';
            textColor = 'text-white';
            icon = '✓';
            break;
        case 'error':
            bgColor = 'bg-red-500';
            textColor = 'text-white';
            icon = '✗';
            break;
        case 'warning':
            bgColor = 'bg-yellow-500';
            textColor = 'text-white';
            icon = '⚠';
            break;
        default: // info
            bgColor = 'bg-blue-500';
            textColor = 'text-white';
            icon = 'ℹ';
    }
    
    const toast = document.createElement('div');
    toast.id = toastId;
    toast.className = `${bgColor} ${textColor} px-6 py-4 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full opacity-0 flex items-center space-x-3 min-w-80`;
    toast.innerHTML = `
        <span class="text-lg">${icon}</span>
        <span class="flex-1">${message}</span>
        <button onclick="removeToast('${toastId}')" class="ml-3 ${textColor} hover:opacity-75">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    `;
    
    toastContainer.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full', 'opacity-0');
        toast.classList.add('translate-x-0', 'opacity-100');
    }, 100);
    
    // Auto remove
    if (duration > 0) {
        setTimeout(() => {
            removeToast(toastId);
        }, duration);
    }
}

// Remove toast
function removeToast(toastId) {
    const toast = document.getElementById(toastId);
    if (toast) {
        toast.classList.remove('translate-x-0', 'opacity-100');
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => {
            toast.remove();
        }, 300);
    }
}

// Replace browser alerts globally
window.customAlert = showAlert;
window.customToast = showToast;

// Override native confirm for delete operations
window.confirmDelete = function(message = 'Yakin ingin menghapus user ini?', onConfirm) {
    showAlert({
        title: 'Konfirmasi Hapus',
        message: message,
        type: 'error',
        confirmText: 'Hapus',
        cancelText: 'Batal',
        onConfirm: onConfirm
    });
};
</script>