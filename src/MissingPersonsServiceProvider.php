<?php

namespace Slavic\MissingPersons;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class MissingPersonsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->requireHelpers();
        
        $this->loadMigrationsFrom(dirname(__DIR__, 1) . '/database/migrations/');
        $this->registerRoutes();
        $this->registerResources();
        $this->defineAssetPublishing();
        $this->registerSchedules();
    }
    
    public function register()
    {
        if (!defined('MP_PATH')) {
            define('MP_PATH', realpath(__DIR__.'/../'));
        }
        
        $this->registerCommands();
        $this->mergeConfigs();
    }
    
    /**
     * Register the Horizon Artisan commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Commands\RecalculationOfAgeCommand::class,
                Console\Commands\CountPersonsCommand::class
            ]);
        }
    }
    
    /**
     * Register scheduled tasks
     *
     * @return void
     */
    protected function registerSchedules()
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('persons:recalculation')->daily();
            $schedule->command('count:persons')->daily();
        });
    }
    
    
    private function requireHelpers()
    {
        require_once __DIR__ . '/Helpers/sanitize_helpers.php';
    }
    
    
    /**
     * Register the MissingPersons routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group([
            'namespace' => 'Slavic\MissingPersons\Http\Controllers',
            'middleware' => 'web',
        ], function () {
            $this->loadRoutesFrom(dirname(__DIR__, 1) . '/routes/web.php');
            $this->loadRoutesFrom(dirname(__DIR__, 1) . '/routes/breadcrumbs.php');
        });
    }
    
    /**
     * Register the MissingPersons resources.
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(dirname(__DIR__, 1) . '/resources/views', 'missing-persons');
        
        // Load translations
        $this->loadTranslationsFrom(dirname(__DIR__, 1) . '/resources/lang', 'missing-persons');
        $this->publishes([
            dirname(__DIR__, 1) . '/resources/lang' => resource_path('lang/vendor/missing-persons'),
        ]);
    }
    
    
    /**
     * Define the asset publishing configuration.
     *
     * @return void
     */
    public function defineAssetPublishing()
    {
        //\File::deleteDirectory(public_path('vendor/missing'));
        $this->publishes([
            dirname(__DIR__, 1) . '/public' => public_path('vendor/missing'),
        ], 'public');
    }
    
    
    /**
     * Register seeds.
     *
     * @param  string  $path
     * @return void
     */
    protected function loadSeedsFrom($path)
    {
        foreach (glob($path . '/*.php') as $filename) {
            include_once $filename;
            $classes = get_declared_classes();
            $class = end($classes);
            $command = \Request::server('argv', null);
            if (is_array($command)) {
                $command = implode(' ', $command);
                if ($command == 'artisan db:seed') {
                    \Artisan::call('db:seed', ['--class' => $class]);
                }
            }
        }
    }
}
