<?php

namespace App\Editor;

use Carbon_Fields\Carbon_Fields;
use App\ThemeFunctions\Blocks\BladeBlocks;
use App\PageBuilder\BlockCollection;

class PageBuilder
{
    public function init(): void
    {

        $this->InitCarbonFields();
        $this->SetClassicEditor();
        $this->InitiatePageBlocks();
        $this->addPageBuilderAssets();
        $this->addPageStatusButtons();
    }

    private function InitCarbonFields(): void
    {
        add_action('after_setup_theme', function () {
            Carbon_Fields::boot();
        });
    }

    private function SetClassicEditor(): void
    {
        add_filter('use_block_editor_for_post_type', '__return_false');

        add_action('admin_init', function () {
            remove_post_type_support('page', 'editor'); // WYSIWYG
        });

        add_filter('screen_options_show_screen', function ($show, $screen) {
            return $screen->post_type === 'page' ? false : $show;
        }, 10, 2);
    }

    private function InitiatePageBlocks(): void
    {
        add_filter('carbon_fields_register_fields', function () {
            BladeBlocks::RegisterBlocks();
        });
    }

    private function addPageStatusButtons(): void
    {
        add_filter('wp_insert_post_data', function ($data) {
            if ($data['post_type'] === 'page' && isset($_POST['save_as_draft'])) {
                $data['post_status'] = 'draft';
            }else if ($data['post_type'] === 'page' && isset($_POST['save_as_public'])){
                $data['post_status'] = 'publish';
            }

            return $data;
        }, 10, 2);
    }

    private function addPageBuilderAssets(): void
    {
        add_action('admin_enqueue_scripts', function () {
            global $post;

            if (!$post || get_post_type($post) !== "page") return;

            wp_enqueue_script_module(
                'page-builder-ui',
                get_template_directory_uri().'/public/build/assets/scripts/pageBuilderJs.js',
                [],
                null,
                true
            );

            wp_enqueue_style(
                'page-builder-style',
                get_template_directory_uri().'/public/build/assets/styles/pageBuilderCss.css'
            );
        });

        add_action('admin_footer', function () {
            global $post;
            
            if (! $post || get_post_type($post) !== 'page') return;

            echo '<script>window.customBlockList = '.json_encode(BlockCollection::GetUserUI()).';</script>';
        });

        add_action('edit_form_top', function ($post) {
            if ($post->post_type !== 'page') return;

            include get_template_directory().'/app/ThemeFunctions/Templates/pageBuilderSave.php';
        });
    }
}