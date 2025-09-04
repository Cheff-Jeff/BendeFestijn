<?php

namespace App\PageBuilder\Blocks;

use App\PageBuilder\CarbonFields\FieldsBuilder;
use App\PageBuilder\Components\Intro;

class Hero
{
    public static function RegisterFields(): array
    {
        return array_merge(
            [
                FieldsBuilder::addSeperator('start_slider', 'Achtergrond Slider'),
                FieldsBuilder::addGallery('slider_content', 'Slider'),
            ],
            Intro::addIntroFields([
                'preTitle' => true,
                'title' => true,
                'wysiwyg' => false,
                'buttons' => ['ghost'],
            ])
        );
    }
}