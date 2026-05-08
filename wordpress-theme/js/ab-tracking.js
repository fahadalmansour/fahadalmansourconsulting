/**
 * FSC A/B Testing - Client-side Tracking
 *
 * Tracks conversions for A/B tests
 * Privacy-respecting: No external services, cookie-based only
 */

(function() {
    'use strict';

    // Wait for DOM
    document.addEventListener('DOMContentLoaded', function() {
        initABTracking();
    });

    /**
     * Initialize A/B tracking
     */
    function initABTracking() {
        // Track form submissions as conversions
        trackFormSubmissions();

        // Track CTA button clicks
        trackCTAClicks();

        // Track contact link clicks
        trackContactClicks();

        // Log active variants (for debugging)
        if (window.location.search.includes('debug_ab=1')) {
            console.log('FSC A/B Variants:', fscAB.variants);
        }
    }

    /**
     * Track form submissions
     */
    function trackFormSubmissions() {
        var forms = document.querySelectorAll('form');

        forms.forEach(function(form) {
            form.addEventListener('submit', function() {
                // Track conversion for all active tests
                if (fscAB.variants) {
                    Object.keys(fscAB.variants).forEach(function(testId) {
                        fscTrackConversion(testId);
                    });
                }
            });
        });
    }

    /**
     * Track CTA button clicks
     */
    function trackCTAClicks() {
        // Track clicks on primary CTA buttons
        var ctaButtons = document.querySelectorAll(
            '.btn-primary, ' +
            '[class*="cta"], ' +
            'a[href*="contact"], ' +
            'a[href*="request"], ' +
            'button[type="submit"]'
        );

        ctaButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Track CTA-related tests
                if (fscAB.variants) {
                    ['cta_button', 'hero_headline', 'contact_cta'].forEach(function(testId) {
                        if (fscAB.variants[testId]) {
                            fscTrackConversion(testId);
                        }
                    });
                }
            });
        });
    }

    /**
     * Track contact link clicks (email, phone, WhatsApp)
     */
    function trackContactClicks() {
        var contactLinks = document.querySelectorAll(
            'a[href^="mailto:"], ' +
            'a[href^="tel:"], ' +
            'a[href*="whatsapp"], ' +
            'a[href*="wa.me"]'
        );

        contactLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                // Track as conversion for contact-related tests
                if (fscAB.variants) {
                    ['contact_cta', 'hero_headline', 'cta_button'].forEach(function(testId) {
                        if (fscAB.variants[testId]) {
                            fscTrackConversion(testId);
                        }
                    });
                }
            });
        });
    }

    /**
     * Track conversion for a specific test
     * Can be called manually: fscTrackConversion('test_id')
     */
    window.fscTrackConversion = function(testId) {
        if (!fscAB || !fscAB.ajaxurl || !fscAB.nonce) {
            console.warn('FSC A/B: Not initialized');
            return;
        }

        // Don't track if no variant assigned
        if (!fscAB.variants || !fscAB.variants[testId]) {
            return;
        }

        // Prevent duplicate tracking in same session
        var trackingKey = 'fsc_ab_converted_' + testId;
        if (sessionStorage.getItem(trackingKey)) {
            return;
        }

        // Mark as converted in session
        sessionStorage.setItem(trackingKey, '1');

        // Send conversion to server
        var formData = new FormData();
        formData.append('action', 'fsc_ab_conversion');
        formData.append('nonce', fscAB.nonce);
        formData.append('test_id', testId);

        fetch(fscAB.ajaxurl, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        }).then(function(response) {
            return response.json();
        }).then(function(data) {
            if (window.location.search.includes('debug_ab=1')) {
                console.log('FSC A/B Conversion tracked:', testId, data);
            }
        }).catch(function(error) {
            console.warn('FSC A/B: Conversion tracking failed', error);
        });
    };

    /**
     * Get current variant for a test
     * Usage: fscGetVariant('hero_headline') => 'a' or 'b'
     */
    window.fscGetVariant = function(testId) {
        if (!fscAB || !fscAB.variants) {
            return null;
        }
        return fscAB.variants[testId] || null;
    };

    /**
     * Check if user is in specific variant
     * Usage: fscIsVariant('hero_headline', 'b') => true/false
     */
    window.fscIsVariant = function(testId, variant) {
        return fscGetVariant(testId) === variant;
    };

})();
