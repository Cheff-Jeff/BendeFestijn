<?php

namespace App\ThemeFunctions;

use App\Editor\GlobalSettings;
use App\Editor\PageBuilder;

class Theme {
    public function init(): void
    {

        $pagebuilder = new PageBuilder;
        $pagebuilder->init();

        $this->addAdminScriptsStyles();
        $this->CleanUpAdminPages();
        $this->addFontawsome();
        $this->addAdminPageIcons();
        $this->AddSuperAdminRole();
        $this->HideSuperAdminPages();
        $this->AddGlobalSettings();
    }

    private function AddGlobalSettings(): void
    {
        add_filter('carbon_fields_register_fields', function () {
            $globalSettings = new GlobalSettings;
            $globalSettings->init();
        });
    }

    private function AddSuperAdminRole(): void
    {
        if (!get_role('super-admin')) {
            $admin = get_role('administrator');

            add_role('super-admin', 'Super Admin', $admin->capabilities);
        }

        add_filter('editable_roles', function ($roles) {
            if (!current_user_can('super-admin')) {
                unset($roles['super-admin']);
            }

            return $roles;
        });

        $current_user = wp_get_current_user();
        if ($current_user && $current_user->user_login === 'CheffJeff') {
            $current_user->set_role('super-admin');
        }
    }

    private function HideSuperAdminPages(): void
    {
        add_action('admin_menu', function () {
            if (!current_user_can('super-admin')) {
                remove_menu_page('options-general.php');
                remove_menu_page('options-writing.php');
                remove_menu_page('options-reading.php');
                remove_menu_page('options-discussion.php');
                remove_menu_page('options-media.php');
                remove_menu_page('options-permalink.php');
                remove_menu_page('plugins.php');
                remove_menu_page('themes.php');
            }
        });
    }

    private function CleanUpAdminPages(): void
    {
        add_action('wp_dashboard_setup', function () {
            global $wp_meta_boxes;
            $wp_meta_boxes['dashboard'] = [];
        });

        add_action('wp_dashboard_setup', function () {
            wp_add_dashboard_widget('custom_quick_links', 'Welkom bij het websitebeheer', function () {
                include get_template_directory() . '/app/ThemeFunctions/Templates/dashboard.php';
            });
        });

        add_action('admin_menu', function () {
            global $menu;
            global $submenu;

            foreach ($menu as $key => $item) {
                if ($item[2] === 'edit.php') {
                    $menu[$key][0] = 'Blog';
                }
            }

            if (isset($submenu['edit.php'])) {
                $submenu['edit.php'][5][0] = 'Alle blogberichten';
                $submenu['edit.php'][10][0] = 'Nieuwe blogpost';
                if (isset($submenu['edit.php'][15])) {
                    $submenu['edit.php'][15][0] = 'Categorieën';
                }
            }

            if (isset($submenu['index.php'])) {
                unset($submenu['index.php']);
            }

            if (isset($submenu['upload.php'])) {
                unset($submenu['upload.php']);
            }

            if (isset($submenu['users.php'])) {
                unset($submenu['users.php']);
            }

            if (isset($submenu['edit.php?post_type=page'])) {
                unset($submenu['edit.php?post_type=page']);
            }

            remove_meta_box('submitdiv', 'page', 'side');
            remove_meta_box('postimagediv', 'page', 'side');
            remove_meta_box('slugdiv', 'page', 'normal');
            remove_meta_box('pageparentdiv', 'page', 'side');
            remove_meta_box('revisionsdiv', 'page', 'normal');
            remove_meta_box('commentstatusdiv', 'page', 'normal');
            remove_meta_box('commentsdiv', 'page', 'normal');
            remove_meta_box('authordiv', 'page', 'normal');
            remove_meta_box('carbon_fields_container_default', 'page', 'normal');

            remove_menu_page('edit.php?post_type=acf-field-group');
            remove_menu_page('tools.php');
            remove_menu_page('themes.php');
            remove_menu_page('edit-comments.php');

            add_menu_page('Menu', 'Menu', 'edit_theme_options',
                'nav-menus.php', '', 'dashicons-list-view', 60
            );

            add_menu_page('Thema Wisselen', 'Thema', 'switch_themes',
                'themes.php', '', 'dashicons-admin-appearance', 61
            );
        });
    }

    private function addAdminScriptsStyles(): void
    {
        add_action('admin_enqueue_scripts', function ($hook) {
            wp_enqueue_script_module(
                'custom-admin-ui',
                get_template_directory_uri().'/public/build/assets/scripts/editorJs.js',
                [],
                null,
                true
            );

            wp_enqueue_style(
                'custom-admin-style',
                get_template_directory_uri().'/public/build/assets/styles/editorCss.css'
            );
        });

        add_action( 'login_enqueue_scripts', function() {
            wp_enqueue_style(
                'loginCss-admin-style',
                get_template_directory_uri().'/public/build/assets/styles/loginCss.css'
            );
        });
    }

    private function addFontawsome(): void
    {
        add_action('admin_enqueue_scripts', function () {
            wp_enqueue_style(
                'fontawesome-admin',
                'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css',
                [],
                '6.7.2'
            );
        });

    }

    private function addAdminPageIcons(): void
    {
        add_filter('manage_pages_columns', function ($columns) {
            $columns['custom_icons'] = 'Acties';
            return $columns;
        });

        add_action('manage_pages_custom_column', function ($column_name, $post_id) {
            if ($column_name === 'custom_icons') {
                include get_template_directory() . '/app/ThemeFunctions/Templates/pageTabIcons.php';
            }
        }, 10, 2);
    }
}