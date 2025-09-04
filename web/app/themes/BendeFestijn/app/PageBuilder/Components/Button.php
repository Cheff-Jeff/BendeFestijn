<?php

namespace App\PageBuilder\Components;

use App\PageBuilder\CarbonFields\FieldsBuilder;

class Button
{
    public static function addButtonFields(string $type = 'primair'): array
    {
        return [
            FieldsBuilder::addText('button_txt', 'Knop tekst', 45),
            FieldsBuilder::addText('button_link', 'Link locatie', 32),
            FieldsBuilder::addSelect(
                'button_target',
                'Open in',
                '_self',
                [
                    '_self' => 'huidige venster',
                    '_blank' => 'nieuw venster',
                ],
                13
            ),
            FieldsBuilder::addHidden('type', $type),
        ];
    }
}