<?php

namespace App\PageBuilder\Components;

use App\PageBuilder\CarbonFields\FieldsBuilder;

class Intro
{
    public static function addIntroFields(array $options = []): array
    {
        $fields = [];
        $defaults = [
            'preTitle' => true,
            'title' => true,
            'wysiwyg' => true,
            'buttons' => ['primair', 'secundair'],
        ];

        $config = array_merge($defaults, $options);

        if (! is_bool($config['title']) || ! is_bool($config['preTitle']) ||
            ! is_bool($config['wysiwyg']) || ! is_array($config['buttons']) ||
            count($config['buttons']) > 2) {
            throw new \Exception('One or more required options is missing Or incorect configured');
        }

        if ($config['preTitle'] && $config['title']) {
            $fields[] = FieldsBuilder::addSeperator('start-title', 'Blok Titel');
            $fields[] = FieldsBuilder::addText('pre-title', 'pre Titel', 35);
            $fields[] = FieldsBuilder::addText('title', 'Titel', 65);
            $fields[] = FieldsBuilder::addSeperator('end-title', 'einde Titel');
        } elseif ($config['preTitle'] && ! $config['title']) {
            $fields[] = FieldsBuilder::addSeperator('start-title', 'Blok Titel');
            $fields[] = FieldsBuilder::addText('pre-title', 'pre Titel');
            $fields[] = FieldsBuilder::addSeperator('end-title', 'einde Titel');
        } elseif ($config['title'] && ! $config['preTitle']) {
            $fields[] = FieldsBuilder::addSeperator('start-title', 'Blok Titel');
            $fields[] = FieldsBuilder::addText('title', 'Titel');
            $fields[] = FieldsBuilder::addSeperator('end-title', 'einde Titel');
        }

        if ($config['wysiwyg']) {
            $fields[] = FieldsBuilder::addSeperator('start-content', 'Blok content');
            $fields[] = FieldsBuilder::addWYSIWYG('content', 'Content');
            $fields[] = FieldsBuilder::addSeperator('end-content', 'einde content');
        }

        if ($config['buttons']) {
            $buttonGenerator = new Button;

            $fields[] = FieldsBuilder::addSeperator('start-knoppen', 'Blok knoppen');
            foreach ($config['buttons'] as $button) {
                $fields = array_merge($fields, $buttonGenerator->addButtonFields($button));
            }
        }

        return $fields;
    }
}