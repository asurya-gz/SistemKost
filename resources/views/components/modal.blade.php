<!-- Custom Modal Component -->
<div id="customModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.5)] border border-gray-200 max-w-2xl w-full mx-4 max-h-[90vh] overflow-hidden transform transition-all duration-300 scale-95 opacity-0" id="modalContainer">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-900" id="modalTitle">Modal Title</h3>
            <button type="button" class="text-gray-400 hover:text-gray-600 transition-colors" onclick="closeModal()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Modal Content -->
        <div class="p-6 overflow-y-auto max-h-[calc(90vh-140px)]" id="modalContent">
            <p>Modal content goes here...</p>
        </div>
        
        <!-- Modal Footer -->
        <div class="flex gap-3 p-6 border-t border-gray-200" id="modalFooter">
            <button type="button" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-4 rounded-lg transition-colors duration-200" onclick="closeModal()">
                Batal
            </button>
            <button type="button" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200" onclick="submitModal()">
                Simpan
            </button>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div id="loadingModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.5)] border border-gray-200 p-8 mx-4">
        <div class="flex items-center space-x-4">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-red-600"></div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Loading...</h3>
                <p class="text-sm text-gray-600" id="loadingMessage">Please wait...</p>
            </div>
        </div>
    </div>
</div>

<script>
let modalCallback = null;

// Show custom modal
function showModal(options = {}) {
    const {
        title = 'Modal',
        content = '<p>Modal content goes here...</p>',
        showFooter = true,
        confirmText = 'Simpan',
        cancelText = 'Batal',
        size = 'default', // small, default, large, full
        onConfirm = null,
        onCancel = null,
        customFooter = null
    } = options;

    const modalElement = document.getElementById('customModal');
    const modalContainer = document.getElementById('modalContainer');
    const modalTitle = document.getElementById('modalTitle');
    const modalContent = document.getElementById('modalContent');
    const modalFooter = document.getElementById('modalFooter');

    // Set content
    modalTitle.textContent = title;
    modalContent.innerHTML = content;

    // Set modal size
    let sizeClass = 'max-w-2xl';
    switch (size) {
        case 'small':
            sizeClass = 'max-w-md';
            break;
        case 'large':
            sizeClass = 'max-w-4xl';
            break;
        case 'full':
            sizeClass = 'max-w-7xl';
            break;
        default:
            sizeClass = 'max-w-2xl';
    }
    
    modalContainer.className = modalContainer.className.replace(/max-w-\w+/, sizeClass);

    // Set footer
    if (showFooter) {
        if (customFooter) {
            modalFooter.innerHTML = customFooter;
        } else {
            modalFooter.innerHTML = `
                <button type="button" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-4 rounded-lg transition-colors duration-200" onclick="closeModal()">
                    ${cancelText}
                </button>
                <button type="button" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200" onclick="submitModal()">
                    ${confirmText}
                </button>
            `;
        }
        modalFooter.classList.remove('hidden');
    } else {
        modalFooter.classList.add('hidden');
    }

    // Set callbacks
    modalCallback = { onConfirm, onCancel };

    // Show modal
    modalElement.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    
    setTimeout(() => {
        modalContainer.classList.remove('scale-95', 'opacity-0');
        modalContainer.classList.add('scale-100', 'opacity-100');
    }, 50);
}

// Close modal
function closeModal() {
    const modalElement = document.getElementById('customModal');
    const modalContainer = document.getElementById('modalContainer');
    
    modalContainer.classList.remove('scale-100', 'opacity-100');
    modalContainer.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modalElement.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }, 300);

    if (modalCallback && modalCallback.onCancel) {
        modalCallback.onCancel();
    }
    modalCallback = null;
}

// Submit modal
function submitModal() {
    if (modalCallback && modalCallback.onConfirm) {
        modalCallback.onConfirm();
    }
    closeModal();
}

// Show loading modal
function showLoading(message = 'Please wait...') {
    const loadingModal = document.getElementById('loadingModal');
    const loadingMessage = document.getElementById('loadingMessage');
    
    loadingMessage.textContent = message;
    loadingModal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

// Hide loading modal
function hideLoading() {
    const loadingModal = document.getElementById('loadingModal');
    loadingModal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Show form in modal
function showFormModal(options = {}) {
    const {
        title = 'Form',
        formFields = [],
        onSubmit = null,
        submitText = 'Simpan',
        cancelText = 'Batal'
    } = options;

    let formHTML = '<form id="modalForm" class="space-y-4">';
    
    formFields.forEach(field => {
        const { 
            name, 
            label, 
            type = 'text', 
            required = false, 
            placeholder = '', 
            value = '',
            options = [] // For select fields
        } = field;

        formHTML += `<div>`;
        formHTML += `<label for="${name}" class="block text-sm font-medium text-gray-700 mb-2">${label}${required ? ' *' : ''}</label>`;
        
        if (type === 'select') {
            formHTML += `<select id="${name}" name="${name}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" ${required ? 'required' : ''}>`;
            formHTML += `<option value="">Pilih ${label}</option>`;
            options.forEach(option => {
                const selected = option.value === value ? 'selected' : '';
                formHTML += `<option value="${option.value}" ${selected}>${option.text}</option>`;
            });
            formHTML += `</select>`;
        } else if (type === 'textarea') {
            formHTML += `<textarea id="${name}" name="${name}" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="${placeholder}" ${required ? 'required' : ''}>${value}</textarea>`;
        } else {
            formHTML += `<input type="${type}" id="${name}" name="${name}" value="${value}" placeholder="${placeholder}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" ${required ? 'required' : ''}>`;
        }
        
        formHTML += `</div>`;
    });
    
    formHTML += '</form>';

    showModal({
        title: title,
        content: formHTML,
        confirmText: submitText,
        cancelText: cancelText,
        onConfirm: () => {
            const form = document.getElementById('modalForm');
            if (form.checkValidity()) {
                const formData = new FormData(form);
                const data = Object.fromEntries(formData);
                if (onSubmit) onSubmit(data);
            } else {
                form.reportValidity();
                return false; // Prevent modal from closing
            }
        }
    });
}

// Global modal functions
window.customModal = showModal;
window.customLoading = { show: showLoading, hide: hideLoading };
window.customFormModal = showFormModal;

// Close modal on backdrop click
document.addEventListener('click', function(e) {
    if (e.target.id === 'customModal') {
        closeModal();
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('customModal');
        const loading = document.getElementById('loadingModal');
        
        if (!modal.classList.contains('hidden')) {
            closeModal();
        }
        if (!loading.classList.contains('hidden')) {
            hideLoading();
        }
    }
});
</script>