<?php

declare(strict_types=1);

use Illuminate\Support\ServiceProvider;

class LaravelLivewireFormsProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->setupViews();
        $this->setupTranslations();
    }

    //////////////////////////////////////////////////////// Protected

    protected function setupViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-livewire-forms');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/laravel-livewire-forms'),
        ]);
    }

    protected function setupTranslations(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../lang', 'laravel-livewire-forms');

        $this->publishes([
            __DIR__ . '/../lang' => $this->app->langPath('vendor/laravel-livewire-forms'),
        ]);
    }

}
