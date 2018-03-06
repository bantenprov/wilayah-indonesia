<?php namespace Bantenprov\WilayahIndonesia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The WilayahIndonesiaModel class.
 *
 * @package Bantenprov\WilayahIndonesia
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class Provinsi extends Model
{
    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'provinces';

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
	
	public function kabupaten()
    {
        return $this->hasMany('Bantenprov\WilayahIndonesia\Models\Kabupaten','province_id');
    }
}