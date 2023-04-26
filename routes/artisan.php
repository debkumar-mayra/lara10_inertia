<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('clear', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('clear-compiled');
    return 'Cleared.';
});
// if (config('app.artisan') == 1) {
    Route::get('migrate', function () {
        Artisan::call('migrate');
        return 'Migrate done.';
    });
    Route::get('migrate-fresh-seed', function () {
        Artisan::call('migrate:fresh --seed');
        return 'Migrate fresh and seeder done.';
    });
    Route::get('db-seed', function () {
        Artisan::call('db:seed');
        return 'Seeder done.';
    });
    Route::get('single-seed/{class_name}', function ($class_name) {
        Artisan::call('db:seed --class=' . $class_name);
        return 'seeder done.';
    });
    Route::get('migration-roleback/{file_name}', function ($file_name) {
        Artisan::call('migrate:rollback --path=/database/migrations/' . $file_name);
        return 'roleback done.';
    });
    Route::get('storage-link', function () {
        Artisan::call('storage:link');
        return 'storage link generate.';
    });

    Route::get('view-env', function () {
        return file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/../.env", true);
    });

    Route::get('laravel-log', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
// }
