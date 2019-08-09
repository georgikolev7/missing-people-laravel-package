<?php

namespace Slavic\MissingPersons;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class MissingPersonsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(dirname(__DIR__, 1) . '/database/migrations/');
        
        $this->app['router']->namespace('Slavic\\MissingPersons\\Http\\Controllers')
                ->middleware(['web'])
                ->group(function () {
                    $this->loadRoutesFrom(dirname(__DIR__, 1) . '/routes/web.php');
                });
    }
    
    public function register()
    {
        if (!defined('MP_PATH')) {
            define('MP_PATH', realpath(__DIR__.'/../'));
        }
    }
    
    
    private function publishMigrations()
    {
        $migrations = [
            'CreateRegionsTable',
            'CreateSettlementsTable',
            'CreateColorsTables',
            'CreatePersonsTable',
            'CreatePersonLastPlaceTable',
            'CreatePersonPhotoTable'
        ];

        if ($this->app->runningInConsole()) {
            foreach ($migrations as $migration) {
                $this->publishMigration($migration);
            }
        }
    }
    
    
    private function publishMigration($migration)
    {
        if (!class_exists($migration)) {
            $timestamp = date('Y_m_d_His', time());
            $this->publishes([
                dirname(__DIR__, 1) . '/database/migrations/' . Str::snake($migration) . '.php' => database_path('migrations/' . $timestamp . '_' . Str::snake($migration) . '.php'),
            ], 'migrations');
        }
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
