<?php namespace Bantenprov\WilayahIndonesia\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The WilayahIndonesia facade.
 *
 * @package Bantenprov\WilayahIndonesia
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class WilayahIndonesia extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'wilayah-indonesia';
    }
}
