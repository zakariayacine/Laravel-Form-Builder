<?php

namespace ZakariaYacineBoucetta\LaravelFormBuilder;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use ZakariaYacineBoucetta\LaravelFormBuilder\Commands\LaravelFormBuilderCommand;
use ZakariaYacineBoucetta\LaravelFormBuilder\Services\FormBuilderService;
use Spatie\LaravelPackageTools\Commands\InstallCommand;

class LaravelFormBuilderServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-form-builder')
            ->hasConfigFile(['formbuilder'])
            ->hasCommand(LaravelFormBuilderCommand::class)
            ->hasInstallCommand(function(InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('zakariayacine/Laravel-Form-Builder')
                    ->endWith(function(InstallCommand $command) {
                        $command->info('Have a great day!');
                    });
            });;
    }

    public function register()
    {
        parent::register();

        // Enregistre le service FormBuilderService comme singleton
        $this->app->singleton('FormBuilderService', function ($app) {
            return new FormBuilderService();
        });
    }

    public function boot()
    {
        parent::boot();
    }
}
//php artisan vendor:publish --tag=formbuilder