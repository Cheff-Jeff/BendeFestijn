<?php

namespace App\ThemeFunctions\Blocks;

use App\PageBuilder\BlockCollection;
use Carbon_Fields\Container\Container;

class BladeBlocks 
{
    public static function RegisterBlocks(): void 
    {
        Container::make('post_meta', 'Pagina Blokken')
            ->where('post_type', '=', 'page')
            ->add_fields(BlockCollection::ConfigureBlocks());
    }
}