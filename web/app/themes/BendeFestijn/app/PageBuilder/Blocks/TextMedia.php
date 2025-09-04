<?php

namespace App\PageBuilder\Blocks;

use App\PageBuilder\CarbonFields\FieldsBuilder;
use App\PageBuilder\Components\Intro;

class TextMedia
{
    public static function RegisterFields(): array
    {
        return array_merge(
            [FieldsBuilder::addImage('img', 'Afbeelding')],
            Intro::addIntroFields([
                'preTitle' => false,
                'title' => true,
                'wysiwyg' => true,
                'buttons' => [],
            ])
        );
    }
}