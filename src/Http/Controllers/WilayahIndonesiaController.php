<?php namespace Bantenprov\WilayahIndonesia\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\WilayahIndonesia\Facades\WilayahIndonesia;
use Bantenprov\WilayahIndonesia\Models\Provinsi;
use Bantenprov\WilayahIndonesia\Models\Kabupaten;
use Bantenprov\WilayahIndonesia\Models\Kecamatan;
use Bantenprov\WilayahIndonesia\Models\Desa;
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
		$this->kabupaten 	= new Kabupaten;
		$this->kecamatan 	= new Kecamatan;
		$this->desa 		= new Desa;
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
	public function provinsisearch($provinsi)
	{		
		$page 					= 10;
		if($provinsi == 'provinsi'){
			$data 					= $this->indonesia->paginateProvinces($page);			
		}else{
			$string 				= array('%20','+','-');
			foreach($string as $val){
				$provinsi 			= str_replace($val,' ',$provinsi);
			}
			$prov 						= $this->provinsi->where("name","=","$provinsi")->get();
			if($prov->count() > 0){
				$provinsi 				= $prov[0]->id;
				$data 					= $this->provinsi
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
										->where('cities.province_id','=',$provinsi)
										->paginate($page);
			}else{
				$data 					= $this->indonesia->paginateProvinces($page);							
			}
		}
		return Response::make(json_encode($data, JSON_PRETTY_PRINT))->header('Content-Type', "application/json");
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
	public function kabupatensearch($provinsi,$kabupaten)
	{		
		$page 					= 10;
		if($provinsi == 'provinsi'){
			$data 					= $this->indonesia->paginateProvinces($page);			
		}else{
			$string 				= array('%20','+','-');
			foreach($string as $val){
				$provinsi 			= str_replace($val,' ',$provinsi);
			}
			$prov 					= $this->provinsi->where("name","=","$provinsi")->get();
			if($prov->count() > 0){
				$provinsi 				= $prov[0]->id;
				foreach($string as $val){
					$kabupaten 				= str_replace($val,' ',$kabupaten);
				}
				$kab 						= $this->kabupaten->where("province_id","=","$provinsi")->where("name","=","$kabupaten")->get();
				if($kab->count() == 0){
					$kabupaten 				= 'kabupaten '.$kabupaten;
				}
				$kab1 						= $this->kabupaten->where("province_id","=","$provinsi")->where("name","=","$kabupaten")->get();
				if($kab1->count() == 0){
					$kabupaten 				= 'kab '.$kabupaten;
				}
				$kab2 						= $this->kabupaten->where("province_id","=","$provinsi")->where("name","=","$kabupaten")->get();
				if($kab2->count() == 0){
					$kabupaten 				= 'kab. '.$kabupaten;
				}
				$kab3 						= $this->kabupaten->where("province_id","=","$provinsi")->where("name","=","$kabupaten")->get();
				if(($kab->count() > 0) || ($kab1->count() > 0) || ($kab2->count() > 0) || ($kab3->count() > 0)){
					if(isset($kab[0]->id)){
						$kabupaten 			= $kab[0]->id;
					}elseif(isset($kab1[0]->id)){
						$kabupaten 			= $kab1[0]->id;						
					}elseif(isset($kab2[0]->id)){
						$kabupaten 			= $kab2[0]->id;						
					}elseif(isset($kab3[0]->id)){
						$kabupaten 			= $kab3[0]->id;						
					}
					$data 					= $this->provinsi
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
											->where('districts.city_id','=',$kabupaten)
											->paginate($page);
				}else{
					$data 					= $this->provinsi
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
											->where('cities.province_id','=',$provinsi)
											->paginate($page);
				}
			}else{
				$data 					= $this->indonesia->paginateProvinces($page);							
			}
		}
		return Response::make(json_encode($data, JSON_PRETTY_PRINT))->header('Content-Type', "application/json");
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
	public function kecamatansearch($provinsi,$kabupaten,$kecamatan)
	{		
		$page 					= 10;
		if($provinsi == 'provinsi'){
			$data 					= $this->indonesia->paginateProvinces($page);			
		}else{
			$string 				= array('%20','+','-');
			foreach($string as $val){
				$provinsi 			= str_replace($val,' ',$provinsi);
			}
			$prov 					= $this->provinsi->where("name","=","$provinsi")->get();
			if($prov->count() > 0){
				$provinsi 				= $prov[0]->id;
				foreach($string as $val){
					$kabupaten 				= str_replace($val,' ',$kabupaten);
				}
				$kab 						= $this->kabupaten->where("province_id","=","$provinsi")->where("name","=","$kabupaten")->get();
				if($kab->count() == 0){
					$kabupaten 				= 'kabupaten '.$kabupaten;
				}
				$kab1 						= $this->kabupaten->where("province_id","=","$provinsi")->where("name","=","$kabupaten")->get();
				if($kab1->count() == 0){
					$kabupaten 				= 'kab '.$kabupaten;
				}
				$kab2 						= $this->kabupaten->where("province_id","=","$provinsi")->where("name","=","$kabupaten")->get();
				if($kab2->count() == 0){
					$kabupaten 				= 'kab. '.$kabupaten;
				}
				$kab3 						= $this->kabupaten->where("province_id","=","$provinsi")->where("name","=","$kabupaten")->get();
				if(($kab->count() > 0) || ($kab1->count() > 0) || ($kab2->count() > 0) || ($kab3->count() > 0)){
					if(isset($kab[0]->id)){
						$kabupaten 			= $kab[0]->id;
					}elseif(isset($kab1[0]->id)){
						$kabupaten 			= $kab1[0]->id;						
					}elseif(isset($kab2[0]->id)){
						$kabupaten 			= $kab2[0]->id;						
					}elseif(isset($kab3[0]->id)){
						$kabupaten 			= $kab3[0]->id;						
					}
					foreach($string as $val){
						$kecamatan 				= str_replace($val,' ',$kecamatan);
					}
					$kec 						= $this->kecamatan->where("city_id","=","$kabupaten")->where("name","=","$kecamatan")->get();
					if($kec->count() == 0){
						$kecamatan 				= 'kecamatan '.$kecamatan;
					}
					$kec1 						= $this->kecamatan->where("city_id","=","$kabupaten")->where("name","=","$kecamatan")->get();
					if($kec1->count() == 0){
						$kecamatan 				= 'kec '.$kecamatan;
					}
					$kec2 						= $this->kecamatan->where("city_id","=","$kabupaten")->where("name","=","$kecamatan")->get();
					if($kec2->count() == 0){
						$kecamatan 				= 'kec. '.$kecamatan;
					}
					$kec3 						= $this->kecamatan->where("city_id","=","$kabupaten")->where("name","=","$kecamatan")->get();
					if(($kec->count() > 0) || ($kec1->count() > 0) || ($kec2->count() > 0) || ($kec3->count() > 0)){
						if(isset($kec[0]->id)){
							$kecamatan 			= $kec[0]->id;
						}elseif(isset($kec1[0]->id)){
							$kecamatan 			= $kec1[0]->id;						
						}elseif(isset($kec2[0]->id)){
							$kecamatan 			= $kec2[0]->id;						
						}elseif(isset($kec3[0]->id)){
							$kecamatan 			= $kec3[0]->id;						
						}
						$data 					= $this->provinsi
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
												->where('villages.district_id','=',$kecamatan)
												->paginate($page);
					}else{
						$data 					= $this->provinsi
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
												->where('districts.city_id','=',$kabupaten)
												->paginate($page);						
					}
				}else{
					$data 					= $this->provinsi
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
											->where('cities.province_id','=',$provinsi)
											->paginate($page);
				}
			}else{
				$data 					= $this->indonesia->paginateProvinces($page);							
			}
		}
		return Response::make(json_encode($data, JSON_PRETTY_PRINT))->header('Content-Type', "application/json");
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
