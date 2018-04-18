<?php
namespace Bantenprov\WilayahIndonesia\Http\Controllers;

/* Require */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/* Models */
use Laravolt\Indonesia\Indonesia;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

/* Etc */

/**
 * The LocationController class.
 *
 * @package Bantenprov\WilayahIndonesia
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class LocationController extends Controller
{
    protected $indonesia;
    protected $province;
    protected $city;
    protected $district;
    protected $village;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->indonesia    = new Indonesia;
		$this->province     = new Province;
		$this->city         = new City;
		$this->district     = new District;
		$this->village      = new Village;
    }

    /**
     * Display a listing of the province resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allProvince()
    {
        $provinces = $this->indonesia->allProvinces();

        foreach($provinces as $province){
            array_set($province, 'label', $province->name);
        }

        $response['provinces']  = $provinces;
        $response['message']    = 'Loaded';
        $response['error']      = false;
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Display a listing of the province resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailProvince($id)
    {
        $provinces = $this->indonesia->findProvince($id);

        array_set($provinces, 'label', $provinces->name);

        $response['provinces']  = $provinces;
        $response['message']    = 'Loaded';
        $response['error']      = false;
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Display a listing of the city resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allCity()
    {
        $cities = $this->indonesia->allCities();

        foreach($cities as $city){
            array_set($city, 'label', $city->name);
        }

        $response['cities']     = $cities;
        $response['message']    = 'Loaded';
        $response['error']      = false;
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Display a listing of the city resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allCityByProvince($id)
    {
        $cities = $this->indonesia->findProvince($id, ['cities']);

        if (isset($cities->cities)) {
            $cities = $cities->cities;
        } else {
            $cities = $this->city->getAttributes();
        }

        foreach($cities as $city){
            array_set($city, 'label', $city->name);
        }

        $response['cities']     = $cities;
        $response['message']    = 'Loaded';
        $response['error']      = false;
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Display a listing of the city resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailCity($id)
    {
        $city = $this->indonesia->findCity($id);

        array_set($city, 'label', $city->name);

        $response['city']       = $city;
        $response['message']    = 'Loaded';
        $response['error']      = false;
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Display a listing of the district resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allDistrict()
    {
        $districts = $this->indonesia->allDistricts();

        foreach($districts as $district){
            array_set($district, 'label', $district->name);
        }

        $response['districts']  = $districts;
        $response['message']    = 'Loaded';
        $response['error']      = false;
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Display a listing of the district resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allDistrictByCity($id)
    {
        $districts = $this->indonesia->findCity($id, ['districts']);

        if (isset($districts->districts)) {
            $districts = $districts->districts;
        } else {
            $districts = $this->district->getAttributes();
        }

        foreach($districts as $district){
            array_set($district, 'label', $district->name);
        }

        $response['districts']  = $districts;
        $response['message']    = 'Loaded';
        $response['error']      = false;
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Display a listing of the district resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailDistrict($id)
    {
        $district = $this->indonesia->findDistrict($id);

        array_set($district, 'label', $district->name);

        $response['district']   = $district;
        $response['message']    = 'Loaded';
        $response['error']      = false;
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Display a listing of the village resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allVillage()
    {
        $villages = $this->indonesia->allVillages();

        foreach($villages as $village){
            array_set($village, 'label', $village->name);
        }

        $response['villages']   = $villages;
        $response['message']    = 'Loaded';
        $response['error']      = false;
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Display a listing of the village resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allVillageByDistrict($id)
    {
        $villages = $this->indonesia->findDistrict($id, ['villages']);

        if (isset($villages->villages)) {
            $villages = $villages->villages;
        } else {
            $villages = $this->village->getAttributes();
        }

        foreach($villages as $village){
            array_set($village, 'label', $village->name);
        }

        $response['villages']   = $villages;
        $response['message']    = 'Loaded';
        $response['error']      = false;
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Display a listing of the village resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailVillage($id)
    {
        $village = $this->indonesia->findVillage($id);

        array_set($village, 'label', $village->name);

        $response['village']    = $village;
        $response['message']    = 'Loaded';
        $response['error']      = false;
        $response['status']     = true;

        return response()->json($response);
    }
}
