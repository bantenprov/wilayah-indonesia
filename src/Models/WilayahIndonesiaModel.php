<?php namespace Bantenprov\WilayahIndonesia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The WilayahIndonesiaModel class.
 *
 * @package Bantenprov\WilayahIndonesia
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class WilayahIndonesiaModel extends Model
{
    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'wilayah_indonesia';

    /**
    * The attributes that are mass assignable.
    *
    * @var mixed
    */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
