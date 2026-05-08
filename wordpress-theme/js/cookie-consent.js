/**
 * Fahad Almansour Consultant Office - Cookie Consent System (Vanilla JS)
 * Compliant with PDPL (Saudi Arabia) & ePrivacy Directive
 */

(function () {
    'use strict';

    // Constants
    const STORAGE_KEY_CONSENT = 'fsc-cookie-consent';
    const STORAGE_KEY_PREFS = 'fsc-cookie-preferences';
    const DEFAULT_PREFS = {
        essential: true,
        analytics: false,
        functional: false,
        marketing: false
    };

    // State
    let state = {
        isOpen: false,
        isBannerVisible: false,
        preferences: { ...DEFAULT_PREFS }
    };

    // DOM Elements
    let bannerEl, modalEl;

    // Initialization
    function init() {
        // Check if user has already consented
        const hasConsent = localStorage.getItem(STORAGE_KEY_CONSENT);
        const savedPrefs = localStorage.getItem(STORAGE_KEY_PREFS);

        if (savedPrefs) {
            try {
                state.preferences = JSON.parse(savedPrefs);
            } catch (e) {
                console.error('Error parsing cookie preferences', e);
            }
        }

        // Initialize scripts based on saved preferences
        if (hasConsent) {
            applyConsent(state.preferences);
        } else {
            // Show banner after delay
            setTimeout(() => {
                showBanner();
            }, 1000);
        }

        // Inject HTML
        injectStyles();
        injectHTML();
        bindEvents();
    }

    // Apply Consent (Load Scripts)
    function applyConsent(prefs) {
        // Save to storage
        localStorage.setItem(STORAGE_KEY_CONSENT, 'true');
        localStorage.setItem(STORAGE_KEY_PREFS, JSON.stringify(prefs));
        state.preferences = prefs;

        // Check for fscParams
        const params = window.fscParams || {};

        // 1. Analytics (Google Analytics)
        if (prefs.analytics && params.ga_id) {
            console.log('FSC: Enabling Google Analytics');
            loadGoogleAnalytics(params.ga_id);
        }

        // 2. Functional
        if (prefs.functional) {
            console.log('FSC: Functional Cookies Enabled');
            // Add functional logic if needed
        }

        // 3. Marketing (Meta Pixel & GTM)
        if (prefs.marketing) {
            if (params.gtm_id) {
                console.log('FSC: Enabling GTM');
                loadGTM(params.gtm_id);
            }
            if (params.pixel_id) {
                console.log('FSC: Enabling Meta Pixel');
                loadMetaPixel(params.pixel_id);
            }
        }
    }

    // Helper: Load Google Analytics
    function loadGoogleAnalytics(id) {
        if (document.getElementById('fsc-ga')) return;

        const script = document.createElement('script');
        script.id = 'fsc-ga';
        script.async = true;
        script.src = `https://www.googletagmanager.com/gtag/js?id=${id}`;
        document.head.appendChild(script);

        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', id);
    }

    // Helper: Load GTM
    function loadGTM(id) {
        if (document.getElementById('fsc-gtm')) return;

        (function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', id);

        // Mark as loaded
        const marker = document.createElement('div');
        marker.id = 'fsc-gtm';
        marker.style.display = 'none';
        document.body.appendChild(marker);
    }

    // Helper: Load Meta Pixel
    function loadMetaPixel(id) {
        if (document.getElementById('fsc-pixel')) return;

        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
            n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', id);
        fbq('track', 'PageView');

        // Mark as loaded
        const marker = document.createElement('div');
        marker.id = 'fsc-pixel';
        marker.style.display = 'none';
        document.body.appendChild(marker);
    }

    // UI Renderers
    function injectStyles() {
        const css = `
            #fsc-cookie-banner {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background: white;
                border-top: 1px solid #e2e8f0;
                padding: 1.5rem;
                z-index: 9999;
                box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1);
                display: none;
                font-family: system-ui, -apple-system, sans-serif;
            }
            #fsc-cookie-banner.visible { display: block; }

            .fsc-banner-content {
                max-width: 80rem;
                margin: 0 auto;
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }

            @media (min-width: 768px) {
                .fsc-banner-content {
                    flex-direction: row;
                    align-items: center;
                    justify-content: space-between;
                }
            }

            .fsc-btn {
                padding: 0.75rem 1.5rem;
                border-radius: 9999px;
                font-weight: 500;
                font-size: 0.875rem;
                cursor: pointer;
                transition: all 0.2s;
            }

            .fsc-btn-primary {
                background: #0f172a;
                color: white;
                border: 1px solid #0f172a;
            }

            .fsc-btn-secondary {
                background: white;
                color: #0f172a;
                border: 1px solid #cbd5e1;
            }

            .fsc-btn-tertiary {
                background: transparent;
                color: #475569;
                border: none;
                text-decoration: underline;
            }

            .fsc-actions {
                display: flex;
                gap: 0.75rem;
                flex-wrap: wrap;
            }

            /* Modal */
            #fsc-cookie-modal {
                position: fixed;
                inset: 0;
                background: rgba(15, 23, 42, 0.5);
                backdrop-filter: blur(4px);
                z-index: 10000;
                display: none;
                align-items: center;
                justify-content: center;
                padding: 1rem;
            }

            #fsc-cookie-modal.visible { display: flex; }

            .fsc-modal-content {
                background: white;
                border-radius: 1rem;
                max-width: 42rem;
                width: 100%;
                max-height: 90vh;
                overflow-y: auto;
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            }

            .fsc-modal-header {
                padding: 1.5rem;
                border-bottom: 1px solid #e2e8f0;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .fsc-modal-body {
                padding: 1.5rem;
            }

            .fsc-modal-footer {
                padding: 1.5rem;
                border-top: 1px solid #e2e8f0;
                background: #f8fafc;
                display: flex;
                justify-content: flex-end;
                gap: 0.75rem;
            }

            .fsc-cookie-row {
                display: flex;
                justify-content: space-between;
                align-items: start;
                padding: 1rem 0;
                border-bottom: 1px solid #f1f5f9;
            }

            .fsc-switch {
                position: relative;
                display: inline-block;
                width: 44px;
                height: 24px;
            }

            .fsc-switch input {
                opacity: 0;
                width: 0;
                height: 0;
            }

            .fsc-slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #cbd5e1;
                transition: .4s;
                border-radius: 34px;
            }

            .fsc-slider:before {
                position: absolute;
                content: "";
                height: 20px;
                width: 20px;
                left: 2px;
                bottom: 2px;
                background-color: white;
                transition: .4s;
                border-radius: 50%;
            }

            input:checked + .fsc-slider {
                background-color: #0f172a;
            }

            input:checked + .fsc-slider:before {
                transform: translateX(20px);
            }

            input:disabled + .fsc-slider {
                opacity: 0.5;
                cursor: not-allowed;
            }
        `;

        const style = document.createElement('style');
        style.innerHTML = css;
        document.head.appendChild(style);
    }

    function injectHTML() {
        // Banner HTML
        const bannerHTML = `
            <div id="fsc-cookie-banner">
                <div class="fsc-banner-content">
                    <div style="flex: 1;">
                        <h3 style="font-weight: 600; margin-bottom: 0.5rem; font-size: 1rem;">Cookie Preferences</h3>
                        <p style="color: #475569; font-size: 0.875rem; line-height: 1.5;">
                            We use cookies to improve your experience and analyze site traffic.
                            Essential cookies are always enabled.
                        </p>
                    </div>
                    <div class="fsc-actions">
                        <button id="btn-customize" class="fsc-btn fsc-btn-tertiary">Customize</button>
                        <button id="btn-reject-all" class="fsc-btn fsc-btn-secondary">Reject all</button>
                        <button id="btn-accept-all" class="fsc-btn fsc-btn-primary">Accept all</button>
                    </div>
                </div>
            </div>
        `;

        // Modal HTML
        const modalHTML = `
            <div id="fsc-cookie-modal">
                <div class="fsc-modal-content">
                    <div class="fsc-modal-header">
                        <h2 style="font-size: 1.25rem; font-weight: 600;">Cookie Settings</h2>
                        <button id="btn-close-modal" style="background:none; border:none; cursor:pointer; font-size: 1.5rem;">&times;</button>
                    </div>
                    <div class="fsc-modal-body">
                        <p style="color: #64748b; font-size: 0.875rem; margin-bottom: 1.5rem;">
                            Manage your cookie preferences here. Essential cookies are required for the site to function.
                        </p>

                        <!-- Essential -->
                        <div class="fsc-cookie-row">
                            <div>
                                <div style="font-weight: 500;">Essential</div>
                                <div style="font-size: 0.875rem; color: #64748b;">Required for site security and functionality.</div>
                            </div>
                            <label class="fsc-switch">
                                <input type="checkbox" checked disabled>
                                <span class="fsc-slider"></span>
                            </label>
                        </div>

                        <!-- Analytics -->
                        <div class="fsc-cookie-row">
                            <div>
                                <div style="font-weight: 500;">Analytics</div>
                                <div style="font-size: 0.875rem; color: #64748b;">Help us understand how visitors use the site.</div>
                            </div>
                            <label class="fsc-switch">
                                <input type="checkbox" id="chk-analytics">
                                <span class="fsc-slider"></span>
                            </label>
                        </div>

                        <!-- Functional -->
                        <div class="fsc-cookie-row">
                            <div>
                                <div style="font-weight: 500;">Functional</div>
                                <div style="font-size: 0.875rem; color: #64748b;">Remember your preferences (language, etc).</div>
                            </div>
                            <label class="fsc-switch">
                                <input type="checkbox" id="chk-functional">
                                <span class="fsc-slider"></span>
                            </label>
                        </div>

                        <!-- Marketing -->
                        <div class="fsc-cookie-row">
                            <div>
                                <div style="font-weight: 500;">Marketing</div>
                                <div style="font-size: 0.875rem; color: #64748b;">Used for advertising and tracking.</div>
                            </div>
                            <label class="fsc-switch">
                                <input type="checkbox" id="chk-marketing">
                                <span class="fsc-slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="fsc-modal-footer">
                        <button id="btn-save-prefs" class="fsc-btn fsc-btn-primary">Save preferences</button>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', bannerHTML);
        document.body.insertAdjacentHTML('beforeend', modalHTML);

        bannerEl = document.getElementById('fsc-cookie-banner');
        modalEl = document.getElementById('fsc-cookie-modal');
    }

    function bindEvents() {
        // Banner Buttons
        document.getElementById('btn-accept-all').addEventListener('click', () => {
            const allPrefs = { essential: true, analytics: true, functional: true, marketing: true };
            applyConsent(allPrefs);
            hideBanner();
        });

        document.getElementById('btn-reject-all').addEventListener('click', () => {
            const minPrefs = { essential: true, analytics: false, functional: false, marketing: false };
            applyConsent(minPrefs);
            hideBanner();
        });

        document.getElementById('btn-customize').addEventListener('click', () => {
            showModal();
        });

        // Modal Buttons
        document.getElementById('btn-close-modal').addEventListener('click', hideModal);

        document.getElementById('btn-save-prefs').addEventListener('click', () => {
            const newPrefs = {
                essential: true,
                analytics: document.getElementById('chk-analytics').checked,
                functional: document.getElementById('chk-functional').checked,
                marketing: document.getElementById('chk-marketing').checked
            };
            applyConsent(newPrefs);
            hideModal();
            hideBanner();
        });
    }

    // Helper Functions
    function showBanner() {
        bannerEl.classList.add('visible');
    }

    function hideBanner() {
        bannerEl.classList.remove('visible');
    }

    function showModal() {
        // Load current state into checkboxes
        document.getElementById('chk-analytics').checked = state.preferences.analytics;
        document.getElementById('chk-functional').checked = state.preferences.functional;
        document.getElementById('chk-marketing').checked = state.preferences.marketing;

        modalEl.classList.add('visible');
    }

    function hideModal() {
        modalEl.classList.remove('visible');
    }

    // Run init
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
