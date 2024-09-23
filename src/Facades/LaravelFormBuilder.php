<?php

namespace Zakaria Yacine Boucetta\LaravelFormBuilder\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Zakaria Yacine Boucetta\LaravelFormBuilder\LaravelFormBuilder
 */
class LaravelFormBuilder extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Zakaria Yacine Boucetta\LaravelFormBuilder\LaravelFormBuilder::class;
    }
}
