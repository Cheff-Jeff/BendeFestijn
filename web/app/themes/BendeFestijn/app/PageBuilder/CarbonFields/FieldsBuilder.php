<?php

namespace App\PageBuilder\CarbonFields;

use Carbon_Fields\Field;

class FieldsBuilder
{
    public static function addWYSIWYG(string $name, string $label, int $size = 100): Field\Field
    {
        return Field::make('rich_text', $name, $label)->set_width($size);
    }

    public static function addText(string $name, string $label, int $size = 100): Field\Field
    {
        return Field::make('text', $name, $label)->set_width($size);
    }

    public static function addImage(string $name, string $label, array $type = ['image']): Field\Field
    {
        return Field::make('image', $name, $label)
            ->set_value_type('url')
            ->set_type($type);
    }

    public static function addGallery(string $name, string $label, array $type = ['image']): Field\Field
    {
        return Field::make('media_gallery', $name, $label)
            ->set_duplicates_allowed(false)
            ->set_type($type);
    }

    public static function addSelect(string $name, string $label, string $default, array $options, int $size = 100): Field\Field
    {
        return Field::make('select', $name, $label)
            ->set_width($size)
            ->set_options($options)
            ->set_default_value($default);
    }

    public static function addHidden(string $name, string $value): Field\Field
    {
        return Field::make('hidden', $name)->set_default_value($value);
    }

    public static function addSeperator(string $name, string $label): Field\Field
    {
        return Field::make('separator', $name, $label);
    }

    public static function addForm()
    {
        return Field::make('text', 'form_shortcode', 'Formulier shortcode')
            ->set_help_text('Je kunt een formulier shortcode hier toevoegen van Contact Form 7.');
    }
}