<?php namespace Bantenprov\WilayahIndonesia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The WilayahIndonesiaModel class.
 *
 * @package Bantenprov\WilayahIndonesia
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class Kabupaten extends Model
{
    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'cities';

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
	
	public function kecamatan(){
		return $this->hasMany('Bantenprov\WilayahIndonesia\Models\Kecamatan','city_id');
	}

	public function provinsi(){
		return $this->belongsTo('Bantenprov\WilayahIndonesia\Models\Provinsi','province_id');
	}
	
}