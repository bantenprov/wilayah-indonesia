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
 * The DistrictController class.
 *
 * @package Bantenprov\WilayahIndonesia
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class DistrictController extends Controller
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
        $districts = $this->indonesia->allDistricts();

        foreach ($districts as $district){
            array_set($district, 'label', $district->name);
        }

        $response['districts']  = $districts;
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
    public function getByCity($id)
    {
        $districts = $this->indonesia->findCity($id, ['districts']);

        if (isset($districts->districts)) {
            $districts = $districts->districts;
        } else {
            $districts = $this->district->getAttributes();
        }

        foreach ($districts as $district){
            array_set($district, 'label', $district->name);
        }

        $response['districts']  = $districts;
        $response['error']      = false;
        $response['message']    = 'Loaded';
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $district = $this->indonesia->findDistrict($id);

        array_set($district, 'label', $district->name);

        $response['district']   = $district;
        $response['error']      = false;
        $response['message']    = 'Loaded';
        $response['status']     = true;

        return response()->json($response);
    }
}
