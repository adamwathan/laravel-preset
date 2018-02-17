<?php

namespace NothingWorks\LaravelPreset;

use Illuminate\Support\Arr;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset as BasePreset;

class Preset extends BasePreset
{
    public static function install()
    {
        static::ensureComponentDirectoryExists();
        static::updatePackages();
        static::updateStyles();
        static::updateWebpackConfiguration();
        static::updateJavaScript();
        static::updateTemplates();
        static::removeNodeModules();
        static::updateGitignore();
        static::addMacros();
    }

    protected static function updatePackageArray(array $packages)
    {
        return array_merge([
            'laravel-mix-purgecss' => '^1.0',
            'postcss-cssnext' => '^3.1',
            'postcss-import' => '^11.0',
            'tailwindcss' => '>=0.1.0',
        ], Arr::except($packages, [
            'bootstrap',
            'bootstrap-sass',
            'jquery',
            'popper.js',
        ]));
    }

    protected static function updateWebpackConfiguration()
    {
        copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    protected static function updateStyles()
    {
        tap(new Filesystem, function ($files) {
            $files->deleteDirectory(resource_path('assets/sass'));
            $files->delete(public_path('js/app.js'));
            $files->delete(public_path('css/app.css'));

            if (! $files->isDirectory($directory = resource_path('assets/css'))) {
                $files->makeDirectory($directory, 0755, true);
            }
        });

        copy(__DIR__.'/stubs/resources/assets/css/app.css', resource_path('assets/css/app.css'));
    }

    protected static function updateJavaScript()
    {
        copy(__DIR__.'/stubs/app.js', resource_path('assets/js/app.js'));
        copy(__DIR__.'/stubs/bootstrap.js', resource_path('assets/js/bootstrap.js'));
    }

    protected static function updateTemplates()
    {
        tap(new Filesystem, function ($files) {
            $files->delete(resource_path('views/home.blade.php'));
            $files->delete(resource_path('views/welcome.blade.php'));
            $files->copyDirectory(__DIR__.'/stubs/views', resource_path('views'));
        });
    }

    protected static function updateGitignore()
    {
        copy(__DIR__.'/stubs/gitignore-stub', base_path('.gitignore'));
    }

    protected static function addMacros()
    {
        copy(__DIR__.'/stubs/app/Providers/AppServiceProvider.php', base_path('app/Providers/AppServiceProvider.php'));
    }
}
