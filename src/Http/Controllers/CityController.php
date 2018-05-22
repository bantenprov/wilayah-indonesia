<?php
namespace Bantenprov\WilayahIndonesia\Http\Controllers;

/* Require */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Bantenprov\WilayahIndonesia\Facades\WilayahIndonesiaFacade;

/* Models */
use Laravolt\Indonesia\Indonesia;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

/* Etc */

/**
 * The CityController class.
 *
 * @package Bantenprov\WilayahIndonesia
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class CityController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $cities = $this->indonesia->allCities();

        foreach ($cities as $city) {
            array_set($city, 'label', $city->name);
        }

        $response['cities']     = $cities;
        $response['error']      = false;
        $response['message']    = 'Loaded';
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getByProvince($id)
    {
        $cities = $this->indonesia->findProvince($id, ['cities']);

        if (isset($cities->cities)) {
            $cities = $cities->cities;
        } else {
            $cities = $this->city->getAttributes();
        }

        foreach ($cities as $city){
            array_set($city, 'label', $city->name);
        }

        $response['cities']     = $cities;
        $response['error']      = false;
        $response['message']    = 'Loaded';
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = $this->indonesia->findCity($id);

        array_set($city, 'label', $city->name);

        $response['city']       = $city;
        $response['error']      = false;
        $response['message']    = 'Loaded';
        $response['status']     = true;

        return response()->json($response);
    }
}
