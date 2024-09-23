<?php

namespace ZakariaYacineBoucetta\LaravelFormBuilder;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use ZakariaYacineBoucetta\LaravelFormBuilder\Commands\LaravelFormBuilderCommand;

class LaravelFormBuilderServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-form-builder')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_form_builder_table')
            ->hasCommand(LaravelFormBuilderCommand::class);
    }
}
