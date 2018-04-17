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

        $response['province']   = $provinces;
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

        $response['province']   = $provinces;
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

        $response['city']   = $cities;
        $response['status'] = true;

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

        $response['city']   = $cities;
        $response['status'] = true;

        return response()->json($response);
    }

    /**
     * Display a listing of the city resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailCity($id)
    {
        $cities = $this->indonesia->findCity($id);

        array_set($cities, 'label', $cities->name);

        $response['city']   = $cities;
        $response['status'] = true;

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

        $response['district']   = $districts;
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

        $response['district']   = $districts;
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
        $districts = $this->indonesia->findDistrict($id);

        array_set($districts, 'label', $districts->name);

        $response['district']   = $districts;
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

        $response['village']    = $villages;
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

        $response['village']    = $villages;
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
        $villages = $this->indonesia->findVillage($id);

        array_set($villages, 'label', $villages->name);

        $response['village']    = $villages;
        $response['status']     = true;

        return response()->json($response);
    }
}
