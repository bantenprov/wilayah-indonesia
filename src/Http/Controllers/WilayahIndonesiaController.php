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
	public function provinsioption()
	{
		$data 					= $this->provinsi->get();
		return Response::make(json_encode($data, JSON_PRETTY_PRINT))->header('Content-Type', "application/json");
	}
	public function provinsicreate()
	{
		$provinsi 					= $this->provinsi;
		$provinsi->id 				= Input::get('id');
		$provinsi->name 			= Input::get('name');
		$result 					= $provinsi->save();
		if($result){
			$res['message']    		= 'Success';
		}else{
			$res['message']    		= 'Error';
		}
        return json_encode($res);
	}
	public function provinsishow($id)
	{
		$data 						= $this->provinsi->find($id);
		return json_encode($data);
	}
	public function provinsiedit($id)
	{
		$data 					= $this->provinsi->find($id);
		$data->id 				= Input::get('id');
		$data->name 			= Input::get('name');
		$result 				= $data->save();
		if($result){
			$res['message']    = 'Success';
		}else{
			$res['message']    = 'Fail';
		}
        return json_encode($res);
	}
	public function provinsidelete()
	{
		$id 						= Input::get('id');
		$provinsi 					= $this->provinsi;
		$data						= $provinsi->find($id);
		$result 					= $data->delete();
		if($result){
			$res['message']    		= 'Success';
		}else{
			$res['message']    		= 'Error';
		}
        return json_encode($res);
	}
	public function provinsisearch($provinsi)
	{
		$page 					= 10;
		if($provinsi == 'provinsi'){
			$data 					= $this->indonesia->paginateProvinces($page);
		}elseif($provinsi == 'kabupaten'){
			$data 					= $this->provinsi
									->select(
										'indonesia_provinces.id as province_id',
										'indonesia_provinces.name as province_name',
										'indonesia_cities.id as city_id',
										'indonesia_cities.name as city_name'
									)
									->join(
										'indonesia_cities',
										'indonesia_provinces.id','=','indonesia_cities.province_id'
									)
									->paginate($page);
		}elseif($provinsi == 'kecamatan'){
			$data 					= $this->provinsi
									->select(
										'indonesia_provinces.id as province_id',
										'indonesia_provinces.name as province_name',
										'indonesia_cities.id as city_id',
										'indonesia_cities.name as city_name',
										'indonesia_districts.id as district_id',
										'indonesia_districts.name as district_name'
									)
									->join(
										'indonesia_cities',
										'indonesia_provinces.id','=','indonesia_cities.province_id'
									)
									->join(
										'indonesia_districts',
										'indonesia_cities.id','=','indonesia_districts.city_id'
									)
									->paginate($page);
		}elseif($provinsi == 'desa'){
		$data 					= $this->provinsi
								->select(
									'indonesia_provinces.id as province_id',
									'indonesia_provinces.name as province_name',
									'indonesia_cities.id as city_id',
									'indonesia_cities.name as city_name',
									'indonesia_districts.id as district_id',
									'indonesia_districts.name as district_name',
									'indonesia_villages.id as village_id',
									'indonesia_villages.name as village_name'
								)
								->join(
									'indonesia_cities',
									'indonesia_provinces.id','=','indonesia_cities.province_id'
								)
								->join(
									'indonesia_districts',
									'indonesia_cities.id','=','indonesia_districts.city_id'
								)
								->join(
									'indonesia_villages',
									'indonesia_districts.id','=','indonesia_villages.district_id'
								)
								->paginate($page);
		}else{
			$string 				= array('%20','+','-');
			foreach($string as $val){
				$provinsi 			= strtoupper(str_replace($val,' ',$provinsi));
			}
			$prov 						= $this->provinsi->where("name","=","$provinsi")->get();
			if($prov->count() > 0){
				$provinsi 				= $prov[0]->id;
				$data 					= $this->provinsi
										->select(
											'indonesia_provinces.id as province_id',
											'indonesia_provinces.name as province_name',
											'indonesia_cities.id as city_id',
											'indonesia_cities.name as city_name'
										)
										->join(
											'indonesia_cities',
											'indonesia_provinces.id','=','indonesia_cities.province_id'
										)
										->where('indonesia_cities.province_id','=',$provinsi)
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
		$data 					= $this->provinsi
								->select(
									'indonesia_indonesia_provinces.id as province_id',
									'indonesia_indonesia_provinces.name as province_name',
									'indonesia_cities.id as city_id',
									'indonesia_cities.name as city_name'
								)
								->join(
									'indonesia_cities',
									'indonesia_provinces.id','=','indonesia_cities.province_id'
								)
								->paginate($page);
		return Response::make(json_encode($data, JSON_PRETTY_PRINT))->header('Content-Type', "application/json");
	}
	public function kabupatencreate()
	{
		$data 						= $this->kabupaten;
		$data->province_id 			= Input::get('province_id');
		$data->id 					= Input::get('city_id');
		$data->name 				= Input::get('city_name');
		$result 					= $data->save();
		if($result){
			$res['message']    		= 'Success';
		}else{
			$res['message']    		= 'Error';
		}
        return json_encode($res);
	}
	public function kabupatenshow($id)
	{
		$data 					= $this->provinsi
								->select(
									'indonesia_provinces.id as province_id',
									'indonesia_provinces.name as province_name',
									'indonesia_cities.id as city_id',
									'indonesia_cities.name as city_name'
								)
								->join(
									'indonesia_cities',
									'indonesia_provinces.id','=','indonesia_cities.province_id'
								)
								->where('indonesia_cities.id','=',$id)
								->first();
		return json_encode($data);
	}
	public function kabupatenedit($id)
	{
		$data 						= $this->kabupaten->find($id);
		$data->province_id 			= Input::get('province_id');
		$data->id 					= Input::get('city_id');
		$data->name 				= Input::get('city_name');
		$result 					= $data->save();
		if($result){
			$res['message']    		= 'Success';
		}else{
			$res['message']    		= 'Error';
		}
        return json_encode($res);
	}
	public function kabupatendelete()
	{
		$id 						= Input::get('city_id');
		$kabupaten 					= $this->kabupaten;
		$data						= $kabupaten->find($id);
		$result 					= $data->delete();
		if($result){
			$res['message']    		= 'Success';
		}else{
			$res['message']    		= 'Error';
		}
        return json_encode($res);
	}
	public function kabupatensearch($provinsi,$kabupaten)
	{
		$page 						= 10;
		if($provinsi == 'provinsi'){
			$data 					= $this->indonesia->paginateProvinces($page);
		}elseif($provinsi == 'kabupaten'){
			$data 					= $this->provinsi
									->select(
										'indonesia_provinces.id as province_id',
										'indonesia_provinces.name as province_name',
										'indonesia_cities.id as city_id',
										'indonesia_cities.name as city_name'
									)
									->join(
										'indonesia_cities',
										'indonesia_provinces.id','=','indonesia_cities.province_id'
									)
									->paginate($page);
		}elseif($provinsi == 'kecamatan'){
			$data 					= $this->provinsi
									->select(
										'indonesia_provinces.id as province_id',
										'indonesia_provinces.name as province_name',
										'indonesia_cities.id as city_id',
										'indonesia_cities.name as city_name',
										'indonesia_districts.id as district_id',
										'indonesia_districts.name as district_name'
									)
									->join(
										'indonesia_cities',
										'indonesia_provinces.id','=','indonesia_cities.province_id'
									)
									->join(
										'indonesia_districts',
										'indonesia_cities.id','=','indonesia_districts.city_id'
									)
									->paginate($page);
		}elseif($provinsi == 'desa'){
		$data 					= $this->provinsi
								->select(
									'indonesia_provinces.id as province_id',
									'indonesia_provinces.name as province_name',
									'indonesia_cities.id as city_id',
									'indonesia_cities.name as city_name',
									'indonesia_districts.id as district_id',
									'indonesia_districts.name as district_name',
									'indonesia_villages.id as village_id',
									'indonesia_villages.name as village_name'
								)
								->join(
									'indonesia_cities',
									'indonesia_provinces.id','=','indonesia_cities.province_id'
								)
								->join(
									'indonesia_districts',
									'indonesia_cities.id','=','indonesia_districts.city_id'
								)
								->join(
									'indonesia_villages',
									'indonesia_districts.id','=','indonesia_villages.district_id'
								)
								->paginate($page);
		}else{
			$string 				= array('%20','+','-');
			foreach($string as $val){
				$provinsi 			= strtoupper(str_replace($val,' ',$provinsi));
			}
			$prov 					= $this->provinsi->where("name","=","$provinsi")->get();
			if($prov->count() > 0){
				$provinsi 				= $prov[0]->id;
				foreach($string as $val){
					$kabupaten 				= strtoupper(str_replace($val,' ',$kabupaten));
				}
				$kab 						= $this->kabupaten->where("province_id","=","$provinsi")->where("name","=","$kabupaten")->get();
				if($kab->count() == 0){
					$kabupaten 				= 'KABUPATEN '.$kabupaten;
				}
				$kab1 						= $this->kabupaten->where("province_id","=","$provinsi")->where("name","=","$kabupaten")->get();
				if($kab1->count() == 0){
					$kabupaten 				= 'KAB '.$kabupaten;
				}
				$kab2 						= $this->kabupaten->where("province_id","=","$provinsi")->where("name","=","$kabupaten")->get();
				if($kab2->count() == 0){
					$kabupaten 				= 'KAB. '.$kabupaten;
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
												'indonesia_provinces.id as province_id',
												'indonesia_provinces.name as province_name',
												'indonesia_cities.id as city_id',
												'indonesia_cities.name as city_name',
												'indonesia_districts.id as district_id',
												'indonesia_districts.name as district_name'
											)
											->join(
												'indonesia_cities',
												'indonesia_provinces.id','=','indonesia_cities.province_id'
											)
											->join(
												'indonesia_districts',
												'indonesia_cities.id','=','indonesia_districts.city_id'
											)
											->where('indonesia_districts.city_id','=',$kabupaten)
											->paginate($page);
				}else{
					$data 					= $this->provinsi
											->select(
												'indonesia_provinces.id as province_id',
												'indonesia_provinces.name as province_name',
												'indonesia_cities.id as city_id',
												'indonesia_cities.name as city_name'
											)
											->join(
												'indonesia_cities',
												'indonesia_provinces.id','=','indonesia_cities.province_id'
											)
											->where('indonesia_cities.province_id','=',$provinsi)
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
		$data 					= $this->provinsi
								->select(
									'indonesia_provinces.id as province_id',
									'indonesia_provinces.name as province_name',
									'indonesia_cities.id as city_id',
									'indonesia_cities.name as city_name',
									'indonesia_districts.id as district_id',
									'indonesia_districts.name as district_name'
								)
								->join(
									'indonesia_cities',
									'indonesia_provinces.id','=','indonesia_cities.province_id'
								)
								->join(
									'indonesia_districts',
									'indonesia_cities.id','=','indonesia_districts.city_id'
								)
								->paginate($page);
		return Response::make(json_encode($data, JSON_PRETTY_PRINT))->header('Content-Type', "application/json");
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
		}elseif($provinsi == 'kabupaten'){
			$data 					= $this->provinsi
									->select(
										'indonesia_provinces.id as province_id',
										'indonesia_provinces.name as province_name',
										'indonesia_cities.id as city_id',
										'indonesia_cities.name as city_name'
									)
									->join(
										'indonesia_cities',
										'indonesia_provinces.id','=','indonesia_cities.province_id'
									)
									->paginate($page);
		}elseif($provinsi == 'kecamatan'){
			$data 					= $this->provinsi
									->select(
										'indonesia_provinces.id as province_id',
										'indonesia_provinces.name as province_name',
										'indonesia_cities.id as city_id',
										'indonesia_cities.name as city_name',
										'indonesia_districts.id as district_id',
										'indonesia_districts.name as district_name'
									)
									->join(
										'indonesia_cities',
										'indonesia_provinces.id','=','indonesia_cities.province_id'
									)
									->join(
										'indonesia_districts',
										'indonesia_cities.id','=','indonesia_districts.city_id'
									)
									->paginate($page);
		}elseif($provinsi == 'desa'){
		$data 					= $this->provinsi
								->select(
									'indonesia_provinces.id as province_id',
									'indonesia_provinces.name as province_name',
									'indonesia_cities.id as city_id',
									'indonesia_cities.name as city_name',
									'indonesia_districts.id as district_id',
									'indonesia_districts.name as district_name',
									'indonesia_villages.id as village_id',
									'indonesia_villages.name as village_name'
								)
								->join(
									'indonesia_cities',
									'indonesia_provinces.id','=','indonesia_cities.province_id'
								)
								->join(
									'indonesia_districts',
									'indonesia_cities.id','=','indonesia_districts.city_id'
								)
								->join(
									'indonesia_villages',
									'indonesia_districts.id','=','indonesia_villages.district_id'
								)
								->paginate($page);
		}else{
			$string 				= array('%20','+','-');
			foreach($string as $val){
				$provinsi 			= strtoupper(str_replace($val,' ',$provinsi));
			}
			$prov 					= $this->provinsi->where("name","=","$provinsi")->get();
			if($prov->count() > 0){
				$provinsi 				= $prov[0]->id;
				foreach($string as $val){
					$kabupaten 				= strtoupper(str_replace($val,' ',$kabupaten));
				}
				$kab 						= $this->kabupaten->where("province_id","=","$provinsi")->where("name","=","$kabupaten")->get();
				if($kab->count() == 0){
					$kabupaten 				= 'KABUPATEN '.$kabupaten;
				}
				$kab1 						= $this->kabupaten->where("province_id","=","$provinsi")->where("name","=","$kabupaten")->get();
				if($kab1->count() == 0){
					$kabupaten 				= 'KAB '.$kabupaten;
				}
				$kab2 						= $this->kabupaten->where("province_id","=","$provinsi")->where("name","=","$kabupaten")->get();
				if($kab2->count() == 0){
					$kabupaten 				= 'KAB. '.$kabupaten;
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
						$kecamatan 				= strtoupper(str_replace($val,' ',$kecamatan));
					}
					$kec 						= $this->kecamatan->where("city_id","=","$kabupaten")->where("name","=","$kecamatan")->get();
					if($kec->count() == 0){
						$kecamatan 				= 'KECAMATAN '.$kecamatan;
					}
					$kec1 						= $this->kecamatan->where("city_id","=","$kabupaten")->where("name","=","$kecamatan")->get();
					if($kec1->count() == 0){
						$kecamatan 				= 'KEC '.$kecamatan;
					}
					$kec2 						= $this->kecamatan->where("city_id","=","$kabupaten")->where("name","=","$kecamatan")->get();
					if($kec2->count() == 0){
						$kecamatan 				= 'KEC. '.$kecamatan;
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
													'indonesia_provinces.id as province_id',
													'indonesia_provinces.name as province_name',
													'indonesia_cities.id as city_id',
													'indonesia_cities.name as city_name',
													'indonesia_districts.id as district_id',
													'indonesia_districts.name as district_name',
													'indonesia_villages.id as village_id',
													'indonesia_villages.name as village_name'
												)
												->join(
													'indonesia_cities',
													'indonesia_provinces.id','=','indonesia_cities.province_id'
												)
												->join(
													'indonesia_districts',
													'indonesia_cities.id','=','indonesia_districts.city_id'
												)
												->join(
													'indonesia_villages',
													'indonesia_districts.id','=','indonesia_villages.district_id'
												)
												->where('indonesia_villages.district_id','=',$kecamatan)
												->paginate($page);
					}else{
						$data 					= $this->provinsi
												->select(
													'indonesia_provinces.id as province_id',
													'indonesia_provinces.name as province_name',
													'indonesia_cities.id as city_id',
													'indonesia_cities.name as city_name',
													'indonesia_districts.id as district_id',
													'indonesia_districts.name as district_name'
												)
												->join(
													'indonesia_cities',
													'indonesia_provinces.id','=','indonesia_cities.province_id'
												)
												->join(
													'indonesia_districts',
													'indonesia_cities.id','=','indonesia_districts.city_id'
												)
												->where('indonesia_districts.city_id','=',$kabupaten)
												->paginate($page);
					}
				}else{
					$data 					= $this->provinsi
											->select(
												'indonesia_provinces.id as province_id',
												'indonesia_provinces.name as province_name',
												'indonesia_cities.id as city_id',
												'indonesia_cities.name as city_name'
											)
											->join(
												'indonesia_cities',
												'indonesia_provinces.id','=','indonesia_cities.province_id'
											)
											->where('indonesia_cities.province_id','=',$provinsi)
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
		$data 					= $this->provinsi
								->select(
									'indonesia_provinces.id as province_id',
									'indonesia_provinces.name as province_name',
									'indonesia_cities.id as city_id',
									'indonesia_cities.name as city_name',
									'indonesia_districts.id as district_id',
									'indonesia_districts.name as district_name',
									'indonesia_villages.id as village_id',
									'indonesia_villages.name as village_name'
								)
								->join(
									'indonesia_cities',
									'indonesia_provinces.id','=','indonesia_cities.province_id'
								)
								->join(
									'indonesia_districts',
									'indonesia_cities.id','=','indonesia_districts.city_id'
								)
								->join(
									'indonesia_villages',
									'indonesia_districts.id','=','indonesia_villages.district_id'
								)
								->paginate($page);
		return Response::make(json_encode($data, JSON_PRETTY_PRINT))->header('Content-Type', "application/json");
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
