<?php namespace Bantenprov\WilayahIndonesia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The WilayahIndonesiaModel class.
 *
 * @package Bantenprov\WilayahIndonesia
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class Kecamatan extends Model
{
    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'districts';

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
	
	public function desa(){
		return $this->hasMany('Bantenprov\WilayahIndonesia\Models\Desa','district_id');
	}

	public function kabupaten(){
		return $this->belongsTo('Bantenprov\WilayahIndonesia\Models\Kabupaten','city_id');
	}
	
}