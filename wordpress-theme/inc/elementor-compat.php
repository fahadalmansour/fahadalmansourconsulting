<?php
/**
 * Elementor Compatibility Layer
 *
 * Detection helpers to allow FSC theme and Elementor to coexist.
 * When Elementor built a page, we yield rendering to the_content().
 * When it didn't, FSC's native shortcodes/templates take over.
 *
 * @package FSC_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Check if Elementor plugin is active and loaded
 */
function fsc_is_elementor_active() {
    return did_action('elementor/loaded');
}

/**
 * Check if a specific page/post was built with Elementor
 */
function fsc_is_elementor_page($post_id = null) {
    if (!fsc_is_elementor_active()) {
        return false;
    }

    if (!$post_id) {
        $post_id = get_the_ID();
    }

    if (!$post_id) {
        return false;
    }

    $document = \Elementor\Plugin::$instance->documents->get($post_id);

    return $document && $document->is_built_with_elementor();
}

/**
 * Check if current page uses Elementor Canvas template (no header/footer)
 */
function fsc_is_elementor_canvas() {
    if (!fsc_is_elementor_active()) {
        return false;
    }

    $template = get_page_template_slug();

    return $template === 'elementor_canvas';
}

/**
 * Check if Elementor Theme Builder has a template for a given location
 * (e.g., 'header', 'footer', 'single', 'archive')
 */
function fsc_has_elementor_location($location) {
    if (!fsc_is_elementor_active()) {
        return false;
    }

    if (!class_exists('\ElementorPro\Modules\ThemeBuilder\Module')) {
        return false;
    }

    $conditions_manager = \ElementorPro\Modules\ThemeBuilder\Module::instance()->get_conditions_manager();
    $documents = $conditions_manager->get_documents_for_location($location);

    return !empty($documents);
}
