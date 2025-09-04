<?php

namespace App\Editor;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use App\PageBuilder\BlockCollection;

class GlobalSettings
{
    public function init(): void
    {
        $settings = $this->AddGlobalSettings();
        $this->AddFooterBuilder($settings);
        $this->SetWordpressSiteIcon();
        $this->AddPageBuilderAssets();
    }

    private function AddGlobalSettings(): Container\Theme_Options_Container
    {
        $settings = Container::make('theme_options', 'Algemene Instellingen')
            ->set_page_menu_title('Algemene Instellingen')
            ->add_fields(array(
                Field::make('image', 'site_logo', 'Site Logo')
                    ->set_value_type('url'),
                Field::make('image', 'site_icon', 'Site icoon')
                    ->set_help_text('Het site icoon is wat je ziet in browser tabs, bladwijzer balken en binnen de WordPress mobiele apps. Het moet vierkant zijn en minstens 512 × 512 pixels.'),
            ));
        
        return $settings;
    }

    private function AddFooterBuilder($parentContainer): void
    {
        Container::make('theme_options', 'Footer Blokken')
            ->set_page_parent( $parentContainer )
            ->set_page_menu_title('Footer instellingen')
            ->add_fields(BlockCollection::ConfigureBlocks());
    }

    private function AddPageBuilderAssets(): void
    {
        if (!isset($_GET['page'])) return; 

        $currentPage = $_GET['page'];

        if (isset($currentPage) && $currentPage === 'crb_carbon_fields_container_footer_blokken.php') {
            add_action('admin_footer', function () {
                echo '<script>window.footerBlockList = '.json_encode(BlockCollection::GetUserUI()).';</script>';
            });

            add_action('admin_enqueue_scripts', function () {
                wp_enqueue_script_module(
                    'page-builder-ui',
                    get_template_directory_uri().'/public/build/assets/scripts/footerBuilderJs.js',
                    [],
                    null,
                    true
                );

                wp_enqueue_style(
                    'page-builder-style',
                    get_template_directory_uri().'/public/build/assets/styles/footerBuilderCss.css'
                );
            });
        }
    }

    private function SetWordpressSiteIcon(): void
    {
        add_action('carbon_fields_theme_options_container_saved', function () {
            $currentIcon = get_option('site_icon');
            $newIcon = carbon_get_theme_option('site_icon');

            if ($currentIcon !== $newIcon) {
                if ($newIcon) {
                    update_option('site_icon', $newIcon);
                } else {
                    delete_option('site_icon');
                }
            }
        });
    }
}