/**
 * Fahad Almansour Consultant Office (FSC) - Form Tools
 * =====================================================
 * Client-side JavaScript for form copying, printing, and PDF export.
 *
 * Features:
 * - Copy form data to clipboard (text/JSON)
 * - Print forms with professional styling
 * - Export to PDF (browser-based)
 * - Form validation with feedback
 * - Auto-save form progress
 *
 * @author Fahad Almansour Consultant Office
 * @version 2.0.0
 */

(function() {
    'use strict';

    // ============================================
    // Configuration
    // ============================================

    const CONFIG = {
        companyName: 'Fahad Almansour Consultant Office',
        companyNameAr: 'مكتب فهد المنصور للاستشارات',
        email: 'info@fahadalmansourconsulting.com',
        phone: '+966 57 013 1122',
        website: 'https://fahadalmansourconsulting.com',
        address: 'Riyadh, Saudi Arabia',
        workingHours: 'Sun - Thu: 9AM - 5PM (AST/UTC+3)',
        autoSaveKey: 'fsc_form_autosave',
        autoSaveInterval: 30000, // 30 seconds
    };

    const TRANSLATIONS = {
        en: {
            copySuccess: 'Copied to clipboard!',
            copyError: 'Failed to copy. Please try again.',
            printTitle: 'Discovery Call Request',
            formSubmitted: 'Form submitted successfully!',
            formError: 'Please fill in all required fields.',
            saved: 'Progress saved',
            restored: 'Previous data restored',
        },
        ar: {
            copySuccess: 'تم النسخ!',
            copyError: 'فشل النسخ. حاول مرة أخرى.',
            printTitle: 'طلب مكالمة استكشافية',
            formSubmitted: 'تم إرسال النموذج بنجاح!',
            formError: 'يرجى تعبئة جميع الحقول المطلوبة.',
            saved: 'تم حفظ التقدم',
            restored: 'تم استعادة البيانات السابقة',
        }
    };

    // Detect language
    const isRTL = document.documentElement.dir === 'rtl';
    const lang = isRTL ? 'ar' : 'en';
    const t = TRANSLATIONS[lang];

    // ============================================
    // Utility Functions
    // ============================================

    /**
     * Show notification toast
     */
    function showNotification(message, type = 'success', duration = 3000) {
        // Remove existing notifications
        const existing = document.querySelector('.fsc-notification');
        if (existing) existing.remove();

        const notification = document.createElement('div');
        notification.className = `fsc-notification fsc-notification-${type}`;
        notification.innerHTML = `
            <div class="fsc-notification-content">
                ${type === 'success' ? `
                    <svg class="fsc-notification-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                ` : type === 'error' ? `
                    <svg class="fsc-notification-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                ` : `
                    <svg class="fsc-notification-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                `}
                <span>${message}</span>
            </div>
        `;

        document.body.appendChild(notification);

        // Trigger animation
        requestAnimationFrame(() => {
            notification.classList.add('is-visible');
        });

        // Auto remove
        setTimeout(() => {
            notification.classList.remove('is-visible');
            setTimeout(() => notification.remove(), 300);
        }, duration);
    }

    /**
     * Format date for display
     */
    function formatDate(date = new Date()) {
        return date.toLocaleDateString(isRTL ? 'ar-SA' : 'en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    /**
     * Get form data as object
     */
    function getFormData(form) {
        const formData = new FormData(form);
        const data = {};

        for (const [key, value] of formData.entries()) {
            if (data[key]) {
                if (Array.isArray(data[key])) {
                    data[key].push(value);
                } else {
                    data[key] = [data[key], value];
                }
            } else {
                data[key] = value;
            }
        }

        // Add metadata
        data._submitted_at = new Date().toISOString();
        data._language = lang;

        return data;
    }

    /**
     * Get field label by ID
     */
    function getFieldLabel(form, fieldId) {
        const label = form.querySelector(`label[for="${fieldId}"]`);
        if (label) {
            return label.textContent.replace('*', '').trim();
        }
        return fieldId.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
    }

    // ============================================
    // Copy Functions
    // ============================================

    /**
     * Copy form data to clipboard as text
     */
    async function copyFormAsText(form) {
        const data = getFormData(form);
        let text = '';

        text += '═'.repeat(50) + '\n';
        text += (isRTL ? 'طلب مكالمة استكشافية' : 'DISCOVERY CALL REQUEST') + '\n';
        text += `${isRTL ? 'التاريخ:' : 'Submitted:'} ${formatDate()}\n`;
        text += '═'.repeat(50) + '\n\n';

        // Skip metadata fields
        const skipFields = ['_submitted_at', '_language', 'consent'];

        for (const [key, value] of Object.entries(data)) {
            if (skipFields.includes(key) || key.startsWith('_')) continue;

            const label = getFieldLabel(form, key);
            const displayValue = Array.isArray(value) ? value.join(', ') : value;

            if (displayValue) {
                text += `${label}: ${displayValue}\n`;
            }
        }

        text += '\n' + '─'.repeat(50) + '\n';
        text += `${CONFIG.companyName}\n`;
        text += `${CONFIG.email} | ${CONFIG.phone}\n`;
        text += CONFIG.website + '\n';

        try {
            await navigator.clipboard.writeText(text);
            showNotification(t.copySuccess, 'success');
            return true;
        } catch (err) {
            console.error('Copy failed:', err);
            showNotification(t.copyError, 'error');
            return false;
        }
    }

    /**
     * Copy form data to clipboard as JSON
     */
    async function copyFormAsJSON(form) {
        const data = getFormData(form);

        try {
            const json = JSON.stringify(data, null, 2);
            await navigator.clipboard.writeText(json);
            showNotification(t.copySuccess, 'success');
            return true;
        } catch (err) {
            console.error('Copy failed:', err);
            showNotification(t.copyError, 'error');
            return false;
        }
    }

    /**
     * Copy specific text to clipboard
     */
    async function copyText(text) {
        try {
            await navigator.clipboard.writeText(text);
            showNotification(t.copySuccess, 'success');
            return true;
        } catch (err) {
            console.error('Copy failed:', err);
            showNotification(t.copyError, 'error');
            return false;
        }
    }

    // ============================================
    // Print Functions
    // ============================================

    /**
     * Print form with professional styling
     */
    function printForm(form, title = t.printTitle) {
        const data = getFormData(form);
        const skipFields = ['_submitted_at', '_language', 'consent'];

        // Build print content
        let content = `
            <div class="print-document">
                <div class="print-header">
                    <div class="print-logo">
                        <strong>${CONFIG.companyName}</strong>
                        <span>${isRTL ? CONFIG.companyNameAr : CONFIG.companyName}</span>
                    </div>
                    <div class="print-meta">
                        <div>${CONFIG.email}</div>
                        <div>${CONFIG.phone}</div>
                        <div>${CONFIG.website}</div>
                    </div>
                </div>

                <h1 class="print-title">${title}</h1>
                <p class="print-date">${isRTL ? 'التاريخ:' : 'Date:'} ${formatDate()}</p>

                <div class="print-section">
                    <h2>${isRTL ? 'معلومات العميل' : 'Client Information'}</h2>
                    <table class="print-table">
                        <tbody>
        `;

        for (const [key, value] of Object.entries(data)) {
            if (skipFields.includes(key) || key.startsWith('_')) continue;

            const label = getFieldLabel(form, key);
            const displayValue = Array.isArray(value) ? value.join(', ') : value;

            if (displayValue && key !== 'message') {
                content += `
                    <tr>
                        <td class="print-label">${label}</td>
                        <td class="print-value">${displayValue}</td>
                    </tr>
                `;
            }
        }

        content += `
                        </tbody>
                    </table>
                </div>
        `;

        // Message section
        if (data.message) {
            content += `
                <div class="print-section">
                    <h2>${isRTL ? 'الرسالة' : 'Message'}</h2>
                    <div class="print-message">${data.message}</div>
                </div>
            `;
        }

        // Footer
        content += `
                <div class="print-footer">
                    <div class="print-footer-line"></div>
                    <p>${CONFIG.address}</p>
                    <p>${CONFIG.workingHours}</p>
                </div>
            </div>
        `;

        // Open print window
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <!DOCTYPE html>
            <html dir="${isRTL ? 'rtl' : 'ltr'}" lang="${lang}">
            <head>
                <meta charset="UTF-8">
                <title>${title} - ${CONFIG.companyName}</title>
                <style>
                    @page {
                        size: A4;
                        margin: 20mm;
                    }

                    * {
                        box-sizing: border-box;
                        margin: 0;
                        padding: 0;
                    }

                    body {
                        font-family: ${isRTL ? "'Tajawal', " : ''}'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                        font-size: 11pt;
                        line-height: 1.6;
                        color: #0f172a;
                        background: white;
                    }

                    .print-document {
                        max-width: 210mm;
                        margin: 0 auto;
                        padding: 20mm;
                    }

                    .print-header {
                        display: flex;
                        justify-content: space-between;
                        align-items: flex-start;
                        border-bottom: 2pt solid #0f172a;
                        padding-bottom: 15pt;
                        margin-bottom: 20pt;
                    }

                    .print-logo strong {
                        display: block;
                        font-size: 16pt;
                        font-weight: 700;
                        color: #0f172a;
                    }

                    .print-logo span {
                        display: block;
                        font-size: 9pt;
                        color: #64748b;
                    }

                    .print-meta {
                        text-align: ${isRTL ? 'left' : 'right'};
                        font-size: 9pt;
                        color: #64748b;
                    }

                    .print-meta div {
                        margin-bottom: 2pt;
                    }

                    .print-title {
                        font-size: 24pt;
                        font-weight: 300;
                        color: #0f172a;
                        margin-bottom: 8pt;
                    }

                    .print-date {
                        font-size: 10pt;
                        color: #64748b;
                        margin-bottom: 25pt;
                    }

                    .print-section {
                        margin-bottom: 25pt;
                    }

                    .print-section h2 {
                        font-size: 12pt;
                        font-weight: 600;
                        color: #0f172a;
                        border-bottom: 1pt solid #e2e8f0;
                        padding-bottom: 5pt;
                        margin-bottom: 12pt;
                    }

                    .print-table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    .print-table tr {
                        border-bottom: 1pt solid #f1f5f9;
                    }

                    .print-table td {
                        padding: 8pt 0;
                        vertical-align: top;
                    }

                    .print-label {
                        width: 30%;
                        font-weight: 600;
                        color: #64748b;
                        font-size: 10pt;
                    }

                    .print-value {
                        color: #0f172a;
                        font-size: 10pt;
                    }

                    .print-message {
                        background: #f8fafc;
                        border: 1pt solid #e2e8f0;
                        border-radius: 4pt;
                        padding: 12pt;
                        font-size: 10pt;
                        white-space: pre-wrap;
                    }

                    .print-footer {
                        margin-top: 40pt;
                        text-align: center;
                        font-size: 8pt;
                        color: #94a3b8;
                    }

                    .print-footer-line {
                        border-top: 1pt solid #e2e8f0;
                        margin-bottom: 10pt;
                    }

                    .print-footer p {
                        margin-bottom: 3pt;
                    }

                    @media print {
                        body {
                            print-color-adjust: exact;
                            -webkit-print-color-adjust: exact;
                        }
                    }
                </style>
            </head>
            <body>
                ${content}
                <script>
                    window.onload = function() {
                        window.print();
                        window.onafterprint = function() {
                            window.close();
                        };
                    };
                </script>
            </body>
            </html>
        `);
        printWindow.document.close();
    }

    /**
     * Print contact information card
     */
    function printContactCard() {
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <!DOCTYPE html>
            <html dir="${isRTL ? 'rtl' : 'ltr'}" lang="${lang}">
            <head>
                <meta charset="UTF-8">
                <title>Contact Card - ${CONFIG.companyName}</title>
                <style>
                    @page {
                        size: A4;
                        margin: 15mm;
                    }

                    * {
                        box-sizing: border-box;
                        margin: 0;
                        padding: 0;
                    }

                    body {
                        font-family: ${isRTL ? "'Tajawal', " : ''}'Inter', -apple-system, sans-serif;
                        background: white;
                        padding: 20mm;
                    }

                    h1 {
                        font-size: 14pt;
                        margin-bottom: 20pt;
                        color: #64748b;
                    }

                    .cards-grid {
                        display: grid;
                        grid-template-columns: repeat(2, 1fr);
                        gap: 10mm;
                    }

                    .contact-card {
                        width: 85mm;
                        height: 55mm;
                        border: 1pt solid #e2e8f0;
                        border-radius: 4pt;
                        padding: 8mm;
                        page-break-inside: avoid;
                    }

                    .card-company {
                        font-size: 12pt;
                        font-weight: 700;
                        color: #0f172a;
                        margin-bottom: 2pt;
                    }

                    .card-tagline {
                        font-size: 8pt;
                        color: #64748b;
                        margin-bottom: 10pt;
                        padding-bottom: 8pt;
                        border-bottom: 1pt solid #f1f5f9;
                    }

                    .card-info {
                        font-size: 8pt;
                        color: #334155;
                    }

                    .card-info div {
                        display: flex;
                        align-items: center;
                        gap: 5pt;
                        margin-bottom: 4pt;
                    }

                    .card-info svg {
                        width: 10pt;
                        height: 10pt;
                        flex-shrink: 0;
                    }

                    @media print {
                        body {
                            print-color-adjust: exact;
                            -webkit-print-color-adjust: exact;
                        }
                    }
                </style>
            </head>
            <body>
                <h1>${isRTL ? 'بطاقات الاتصال - اطبع واقص' : 'Contact Cards - Print & Cut'}</h1>
                <div class="cards-grid">
                    ${Array(8).fill(`
                        <div class="contact-card">
                            <div class="card-company">${CONFIG.companyName}</div>
                            <div class="card-tagline">${isRTL ? CONFIG.companyNameAr : ''} • Professional IT Consulting</div>
                            <div class="card-info">
                                <div>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span>${CONFIG.email}</span>
                                </div>
                                <div>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <span>${CONFIG.phone}</span>
                                </div>
                                <div>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <path d="M2 12h20M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>
                                    </svg>
                                    <span>${CONFIG.website.replace('https://', '')}</span>
                                </div>
                            </div>
                        </div>
                    `).join('')}
                </div>
                <script>
                    window.onload = function() {
                        window.print();
                        window.onafterprint = function() {
                            window.close();
                        };
                    };
                </script>
            </body>
            </html>
        `);
        printWindow.document.close();
    }

    // ============================================
    // PDF Export (Browser-based)
    // ============================================

    /**
     * Export form as PDF using browser print dialog
     */
    function exportFormAsPDF(form, title = t.printTitle) {
        // This uses the print function but saves as PDF
        printForm(form, title);
    }

    // ============================================
    // Auto-Save Functions
    // ============================================

    /**
     * Save form data to localStorage
     */
    function saveFormProgress(form) {
        const data = getFormData(form);
        try {
            localStorage.setItem(CONFIG.autoSaveKey, JSON.stringify(data));
            return true;
        } catch (err) {
            console.error('Auto-save failed:', err);
            return false;
        }
    }

    /**
     * Restore form data from localStorage
     */
    function restoreFormProgress(form) {
        try {
            const saved = localStorage.getItem(CONFIG.autoSaveKey);
            if (!saved) return false;

            const data = JSON.parse(saved);
            const skipFields = ['_submitted_at', '_language'];

            for (const [key, value] of Object.entries(data)) {
                if (skipFields.includes(key) || key.startsWith('_')) continue;

                const field = form.querySelector(`[name="${key}"]`);
                if (!field) continue;

                if (field.type === 'checkbox' || field.type === 'radio') {
                    const values = Array.isArray(value) ? value : [value];
                    const fields = form.querySelectorAll(`[name="${key}"]`);
                    fields.forEach(f => {
                        f.checked = values.includes(f.value);
                    });
                } else if (field.tagName === 'SELECT' || field.type === 'text' || field.type === 'email' || field.type === 'tel' || field.tagName === 'TEXTAREA') {
                    field.value = value;
                }
            }

            return true;
        } catch (err) {
            console.error('Restore failed:', err);
            return false;
        }
    }

    /**
     * Clear saved form data
     */
    function clearFormProgress() {
        try {
            localStorage.removeItem(CONFIG.autoSaveKey);
            return true;
        } catch (err) {
            return false;
        }
    }

    // ============================================
    // Form Validation
    // ============================================

    /**
     * Validate form and show feedback
     */
    function validateForm(form) {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');

        requiredFields.forEach(field => {
            const group = field.closest('.form-group') || field.parentElement;

            // Reset previous state
            group.classList.remove('has-error', 'has-success');
            field.classList.remove('is-invalid', 'is-valid');

            let fieldValid = false;

            if (field.type === 'checkbox' || field.type === 'radio') {
                const name = field.name;
                const checked = form.querySelector(`[name="${name}"]:checked`);
                fieldValid = !!checked;
            } else {
                fieldValid = field.value.trim() !== '';

                // Email validation
                if (field.type === 'email' && fieldValid) {
                    fieldValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value);
                }
            }

            if (!fieldValid) {
                isValid = false;
                group.classList.add('has-error');
                field.classList.add('is-invalid');
            } else {
                group.classList.add('has-success');
                field.classList.add('is-valid');
            }
        });

        return isValid;
    }

    // ============================================
    // Form Result Overlay
    // ============================================

    /**
     * Show success overlay
     */
    function showSuccessOverlay(container, message) {
        const overlay = document.createElement('div');
        overlay.className = 'form-result-overlay is-visible';
        overlay.innerHTML = `
            <div class="form-result-icon success">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div class="form-result-title">${isRTL ? 'شكراً لك!' : 'Thank You!'}</div>
            <div class="form-result-message">${message}</div>
            <button class="form-result-action" onclick="this.closest('.form-result-overlay').remove()">
                ${isRTL ? 'موافق' : 'Got it'}
            </button>
        `;
        container.style.position = 'relative';
        container.appendChild(overlay);
    }

    /**
     * Show error overlay
     */
    function showErrorOverlay(container, message) {
        const overlay = document.createElement('div');
        overlay.className = 'form-result-overlay is-visible';
        overlay.innerHTML = `
            <div class="form-result-icon error">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <div class="form-result-title">${isRTL ? 'خطأ' : 'Error'}</div>
            <div class="form-result-message">${message}</div>
            <button class="form-result-action" onclick="this.closest('.form-result-overlay').remove()">
                ${isRTL ? 'حاول مرة أخرى' : 'Try Again'}
            </button>
        `;
        container.style.position = 'relative';
        container.appendChild(overlay);
    }

    // ============================================
    // Initialize
    // ============================================

    function init() {
        // Add notification styles
        const notificationStyles = document.createElement('style');
        notificationStyles.textContent = `
            .fsc-notification {
                position: fixed;
                bottom: 20px;
                ${isRTL ? 'left' : 'right'}: 20px;
                z-index: 10000;
                transform: translateY(100px);
                opacity: 0;
                transition: all 0.3s ease;
            }

            .fsc-notification.is-visible {
                transform: translateY(0);
                opacity: 1;
            }

            .fsc-notification-content {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 12px 20px;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 500;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }

            .fsc-notification-success .fsc-notification-content {
                background: #dcfce7;
                color: #166534;
            }

            .fsc-notification-error .fsc-notification-content {
                background: #fef2f2;
                color: #991b1b;
            }

            .fsc-notification-info .fsc-notification-content {
                background: #f0f9ff;
                color: #0369a1;
            }

            .fsc-notification-icon {
                width: 20px;
                height: 20px;
                flex-shrink: 0;
            }
        `;
        document.head.appendChild(notificationStyles);

        // Find all forms and set up auto-save
        document.querySelectorAll('form').forEach(form => {
            // Restore saved data
            if (restoreFormProgress(form)) {
                showNotification(t.restored, 'info', 2000);
            }

            // Auto-save on input
            let autoSaveTimeout;
            form.addEventListener('input', () => {
                clearTimeout(autoSaveTimeout);
                autoSaveTimeout = setTimeout(() => {
                    if (saveFormProgress(form)) {
                        // Optional: show save indicator
                        // showNotification(t.saved, 'info', 1000);
                    }
                }, 2000);
            });

            // Clear saved data on submit
            form.addEventListener('submit', () => {
                clearFormProgress();
            });
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // ============================================
    // Export to global scope
    // ============================================

    window.FSCFormTools = {
        copyFormAsText,
        copyFormAsJSON,
        copyText,
        printForm,
        printContactCard,
        exportFormAsPDF,
        saveFormProgress,
        restoreFormProgress,
        clearFormProgress,
        validateForm,
        showSuccessOverlay,
        showErrorOverlay,
        showNotification,
        getFormData,
        CONFIG,
    };

})();
