<?php namespace Bantenprov\WilayahIndonesia\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\WilayahIndonesia\Facades\WilayahIndonesia;
use Bantenprov\WilayahIndonesia\Models\Provinsi;
use Laravolt\Indonesia\Indonesia;
use Illuminate\Support\Facades\Input;
use Response;
/**
 * The WilayahIndonesiaController class.
 *
 * @package Bantenprov\WilayahIndonesia
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class WilayahIndonesiaController extends Controller
{
	protected $indonesia;
	protected $provinsi;
	protected $kabupaten;
	protected $kecamatan;
	protected $desa;
	
	public function __construct()
	{
		$this->indonesia 	= new Indonesia;
		$this->provinsi 	= new Provinsi;
	}
	public function provinsiindex()
	{
		$page 					= 10;
		$data 					= $this->indonesia->paginateProvinces($page);
		return Response::make(json_encode($data, JSON_PRETTY_PRINT))->header('Content-Type', "application/json");
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
	public function provinsipage()
	{
		
	}
	//END DATA PROVINSI

	//DATA KABUPATEN
	public function kabupatenindex()
	{	
		$page  					= 10;
		$res 					= $this->provinsi
								->select(
									'provinces.id as province_id',
									'provinces.name as province_name',
									'cities.id as city_id',
									'cities.name as city_name'
								)
								->leftjoin(
									'cities',
									'provinces.id','=','cities.province_id'
								)
								->paginate($page);
		return Response::make(json_encode($res, JSON_PRETTY_PRINT))->header('Content-Type', "application/json");
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
		$page  					= 10;
		$res 					= $this->provinsi
								->select(
									'provinces.id as province_id',
									'provinces.name as province_name',
									'cities.id as city_id',
									'cities.name as city_name',
									'districts.id as district_id',
									'districts.name as district_name'
								)
								->leftjoin(
									'cities',
									'provinces.id','=','cities.province_id'
								)
								->leftjoin(
									'districts',
									'cities.id','=','districts.city_id'
								)
								->paginate($page);
		return Response::make(json_encode($res, JSON_PRETTY_PRINT))->header('Content-Type', "application/json");		
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
		$page  					= 10;
		$res 					= $this->provinsi
								->select(
									'provinces.id as province_id',
									'provinces.name as province_name',
									'cities.id as city_id',
									'cities.name as city_name',
									'districts.id as district_id',
									'districts.name as district_name',
									'villages.id as village_id',
									'villages.name as village_name'
								)
								->leftjoin(
									'cities',
									'provinces.id','=','cities.province_id'
								)
								->leftjoin(
									'districts',
									'cities.id','=','districts.city_id'
								)
								->leftjoin(
									'villages',
									'districts.id','=','villages.district_id'
								)
								->paginate($page);
		return Response::make(json_encode($res, JSON_PRETTY_PRINT))->header('Content-Type', "application/json");		
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
