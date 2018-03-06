<?php namespace Bantenprov\WilayahIndonesia\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\WilayahIndonesia\Facades\WilayahIndonesia;
use Bantenprov\WilayahIndonesia\Models\Provinsi;
use Laravolt\Indonesia\Indonesia;
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
		$page 							= 10;
		$cities 						= $this->indonesia->paginateCities($page);		
		foreach($cities as $key => $city){
			$provinces 					= $this->indonesia->paginateProvinces($city['province_id']);
			foreach($provinces as $province){
				if($city['province_id'] == $province['id']){
					$data 				= 	[
												"id"=>$city['id'],
												"province_name"=>$province['name'],
												"city_name"=>$city['name']
											];
					$cities[$key] 		= $data;
				}
			}
		}
		return Response::make(json_encode($cities, JSON_PRETTY_PRINT))->header('Content-Type', "application/json");
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
		$page 								= 10;
		$districts 							= $this->indonesia->paginateDistricts($page);
		foreach($districts as $key => $district){
			$cities 						= $this->indonesia->paginateCities($district['city_id']);
			foreach($cities as $key1 => $city){
				$provinces 					= $this->indonesia->paginateProvinces($city['province_id']);
				foreach($provinces as $province){
					if($city['province_id'] == $province['id']){
						$data 			= 	[
													"id"=>$district['id'],
													"province_name"=>$province['name'],
													"city_name"=>$city['name'],
													"district_name"=>$district['name']
												];
						$districts[$key] 		= $data;
					}
				}
			}			
		}
		return Response::make(json_encode($districts, JSON_PRETTY_PRINT))->header('Content-Type', "application/json");
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
		$page 								= 10;
		$villages 							= $this->indonesia->paginateVillages($page);
		foreach($villages as $key => $village){
			$districts 							= $this->indonesia->paginateDistricts($village['district_id']);
			foreach($districts as $key => $district){
				$cities 						= $this->indonesia->paginateCities($district['city_id']);
				foreach($cities as $key1 => $city){
					$provinces 					= $this->indonesia->paginateProvinces($city['province_id']);
					foreach($provinces as $province){
						if($city['province_id'] == $province['id']){
							$data 			= 	[
														"id"=>$village['id'],
														"province_name"=>$province['name'],
														"city_name"=>$city['name'],
														"district_name"=>$district['name'],
														"village_name"=>$village['name']
													];
							$villages[$key] 		= $data;
						}
					}
				}			
			}
		}
		return Response::make(json_encode($villages, JSON_PRETTY_PRINT))->header('Content-Type', "application/json");
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
