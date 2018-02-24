<?php namespace Bantenprov\WilayahIndonesia\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\WilayahIndonesia\Facades\WilayahIndonesia;
use Bantenprov\WilayahIndonesia\Models\WilayahIndonesiaModel;
use Laravolt\Indonesia;

/**
 * The WilayahIndonesiaController class.
 *
 * @package Bantenprov\WilayahIndonesia
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class WilayahIndonesiaController extends Controller
{
	//DATA PROVINSI
	public function provinsiindex()
	{
		dd(Indonesia::allProvinces());
	}
	public function provinsicreate()
	{
		
	}
	public function provinsishow()
	{
		
	}
	public function provinsiedit()
	{
		
	}
	public function provinsidelete()
	{
		
	}
	//END DATA PROVINSI

	//DATA KABUPATEN
	public function kabupatenindex()
	{
		
	}
	public function kabupatencreate()
	{
		
	}
	public function kabupatenshow()
	{
		
	}
	public function kabupatenedit()
	{
		
	}
	public function kabupatendelete()
	{
		
	}
	//END DATA KABUPATEN

	//DATA KECAMATAN
	public function kecamatanindex()
	{
		
	}
	public function kecamatancreate()
	{
		
	}
	public function kecamatanshow()
	{
		
	}
	public function kecamatanedit()
	{
		
	}
	public function kecamatandelete()
	{
		
	}
	//END DATA KECAMATAN

	//DATA DESA
	public function desaindex()
	{
		
	}
	public function desacreate()
	{
		
	}
	public function desashow()
	{
		
	}
	public function desaedit()
	{
		
	}
	public function desadelete()
	{
		
	}
	//END DATA DESA
	
}
