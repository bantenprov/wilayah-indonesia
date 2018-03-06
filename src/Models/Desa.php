<?php namespace Bantenprov\WilayahIndonesia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The WilayahIndonesiaModel class.
 *
 * @package Bantenprov\WilayahIndonesia
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class Desa extends Model
{
    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'villages';

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
		return $this->belongsTo('Bantenprov\WilayahIndonesia\Models\Kecamatan','district_id');
	}
	
}