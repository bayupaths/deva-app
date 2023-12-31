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

    public static function getPaymentStatusColors()
    {
        return [
            'UNPAID' => 'bg-secondary',
            'PROCESSED' => 'bg-warning',
            'SUCCESS' => 'bg-success',
            'FAILED' => 'bg-danger',
        ];
    }

    public static function getPaymentStatusColor($status)
    {
        $statusColors = self::getOrderStatusColors();
        return $statusColors[$status] ?? 'default';
    }
}