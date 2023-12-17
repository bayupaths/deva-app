<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OrderHelperProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public static function getOrderStatusColors()
    {
        return [
            'PENDING' => 'bg-secondary',
            'PROCESSING' => 'bg-warning',
            'FINISHED' => 'bg-success',
            'CANCELED' => 'bg-danger',
        ];
    }

    public static function getOrderStatusColor($status)
    {
        $statusColors = self::getOrderStatusColors();
        return $statusColors[$status] ?? 'default';
    }
}
