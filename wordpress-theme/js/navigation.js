/**
 * Fahad Almansour Consultant Office (FSC) - Navigation Script
 *
 * Handles mobile menu toggle, smooth scrolling, and language switching
 */

(function () {
    'use strict';

    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function () {
        initMobileMenu();
        initSmoothScroll();
        initStickyHeader();
        initLanguageSwitcher();
    });

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        const menuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        if (!menuToggle || !mobileMenu) return;

        menuToggle.addEventListener('click', function () {
            const isHidden = mobileMenu.classList.contains('hidden');

            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                menuToggle.setAttribute('aria-expanded', 'true');
            } else {
                mobileMenu.classList.add('hidden');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        });

        // Close menu when clicking a link
        const menuLinks = mobileMenu.querySelectorAll('a');
        menuLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                mobileMenu.classList.add('hidden');
                menuToggle.setAttribute('aria-expanded', 'false');
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', function (event) {
            if (!mobileMenu.contains(event.target) && !menuToggle.contains(event.target)) {
                mobileMenu.classList.add('hidden');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /**
     * Smooth Scroll for Anchor Links
     * Handles both "#section" and "/#section" formats
     */
    function initSmoothScroll() {
        // Select all links that contain a hash
        const anchorLinks = document.querySelectorAll('a[href*="#"]');

        anchorLinks.forEach(function (link) {
            link.addEventListener('click', function (e) {
                const href = this.getAttribute('href');

                // Skip if it's just "#" or external links
                if (href === '#' || !href) return;

                // Extract the hash part (e.g., "#how-we-work" from "/#how-we-work")
                const hashIndex = href.indexOf('#');
                if (hashIndex === -1) return;

                const targetId = href.substring(hashIndex);
                const pathPart = href.substring(0, hashIndex);

                // Check if the path is for current page (empty, "/", or matches current path)
                const currentPath = window.location.pathname;
                const isCurrentPage = pathPart === '' ||
                                      pathPart === '/' ||
                                      pathPart === currentPath ||
                                      (pathPart === '' && currentPath === '/');

                // If not current page, let the browser handle navigation
                if (!isCurrentPage && pathPart !== '') {
                    return;
                }

                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    e.preventDefault();

                    // Account for fixed header
                    const headerHeight = document.querySelector('.site-header')?.offsetHeight || 80;
                    const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Update URL without jumping
                    history.pushState(null, null, targetId);
                }
            });
        });

        // Handle initial page load with hash in URL
        if (window.location.hash) {
            setTimeout(function() {
                const targetElement = document.querySelector(window.location.hash);
                if (targetElement) {
                    const headerHeight = document.querySelector('.site-header')?.offsetHeight || 80;
                    const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            }, 100);
        }
    }

    /**
     * Sticky Header Behavior
     */
    function initStickyHeader() {
        const header = document.querySelector('.site-header');
        if (!header) return;

        let lastScrollTop = 0;
        const scrollThreshold = 100;

        window.addEventListener('scroll', function () {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // Add shadow when scrolled
            if (scrollTop > 10) {
                header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.boxShadow = 'none';
            }

            lastScrollTop = scrollTop;
        }, { passive: true });
    }

    /**
     * Back to Top functionality
     */
    const backToTopLinks = document.querySelectorAll('a[href="#page"]');
    backToTopLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });

    /**
     * Language Switcher (Cookie-based fallback when Polylang not installed)
     */
    function initLanguageSwitcher() {
        // Check for saved language preference
        const savedLang = getCookie('fsc_language');
        if (savedLang) {
            // Visual indicator only - actual switching requires Polylang
            console.log('Language preference:', savedLang);
        }
    }

    function getCookie(name) {
        const value = '; ' + document.cookie;
        const parts = value.split('; ' + name + '=');
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

})();

/**
 * Global Language Switcher Function
 * Called from header buttons when Polylang is not installed
 */
window.fscSetLanguage = function(lang) {
    // Set cookie for 30 days
    const expires = new Date();
    expires.setTime(expires.getTime() + (30 * 24 * 60 * 60 * 1000));
    document.cookie = 'fsc_language=' + lang + ';expires=' + expires.toUTCString() + ';path=/;SameSite=Lax';

    // Show user feedback
    const message = lang === 'ar'
        ? 'للحصول على دعم كامل للغة العربية، يرجى تثبيت إضافة Polylang'
        : 'For full multilingual support, please install the Polylang plugin';

    // Create toast notification
    const toast = document.createElement('div');
    toast.className = 'fixed bottom-4 right-4 bg-slate-900 text-white px-6 py-4 rounded-lg shadow-xl z-50 max-w-sm';
    toast.innerHTML = '<p class="text-sm font-medium mb-1">' + (lang === 'ar' ? 'تغيير اللغة' : 'Language Change') + '</p>' +
                      '<p class="text-xs text-slate-300">' + message + '</p>';

    document.body.appendChild(toast);

    // Remove toast after 4 seconds
    setTimeout(function() {
        toast.style.opacity = '0';
        toast.style.transition = 'opacity 0.3s ease';
        setTimeout(function() {
            toast.remove();
        }, 300);
    }, 4000);

    // If WordPress admin or Polylang detected, reload page
    if (window.pll || document.querySelector('.polylang-languages')) {
        window.location.reload();
    }
};
