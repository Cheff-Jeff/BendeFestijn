<?php

namespace App\PageBuilder;

use App\PageBuilder\Blocks\Hero;
use App\PageBuilder\Blocks\TextMedia;
use Carbon_Fields\Field;

class BlockCollection
{
    public static function ConfigureBlocks(): array
    {
        return [
            Field::make('complex', 'page_blocks', 'Pagina Blokken')
                ->set_layout('grid')
                ->add_fields('hero', 'Hero', Hero::RegisterFields())
                ->add_fields('text_media', 'Text en media', TextMedia::RegisterFields()),
        ];
    }

    public static function GetUserUI(): array
    {
        return [
            [
                'key' => 'hero',
                'label' => 'Hero',
                'description' => 'Een site hero is een groot visueel element bovenaan een webpagina, vaak bestaande uit een afbeelding of video met een opvallende titel en korte tekst. Het wordt meestal één keer per pagina gebruikt om direct de aandacht te trekken en de kernboodschap te communiceren.',
                'image' => get_template_directory_uri().'/app/ThemeFunctions/Assets/block-previews/hero.jpg',
            ],
            [
                'key' => 'Text en media',
                'label' => 'Text en media',
                'description' => 'Text en media is een combinatie van tekst en visuele elementen zoals afbeeldingen of video’s, die samen informatie overbrengen. Deze contentblokken worden meestal gebruikt om de boodschap van een pagina verder toe te lichten en komen vaker per pagina voor.',
                'image' => get_template_directory_uri().'/app/ThemeFunctions/Assets/block-previews/text-media.png',
            ],
        ];
    }
}