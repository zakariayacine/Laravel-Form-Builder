<?php

namespace ZakariaYacineBoucetta\LaravelFormBuilder\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ZakariaYacineBoucetta\LaravelFormBuilder\LaravelFormBuilder
 */
class LaravelFormBuilder extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \ZakariaYacineBoucetta\LaravelFormBuilder\LaravelFormBuilder::class;
    }
}
