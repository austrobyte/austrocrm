<?php

namespace Austro\Crm;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AustroCrmServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('austro-crm')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_austro_crm_token_table');
            // ->hasCommand(AustroCrmCommand::class);
    }
}
