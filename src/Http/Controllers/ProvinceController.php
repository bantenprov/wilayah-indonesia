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
 * The ProvinceController class.
 *
 * @package Bantenprov\WilayahIndonesia
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class ProvinceController extends Controller
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
        $provinces = $this->indonesia->allProvinces();

        foreach ($provinces as $province){
            array_set($province, 'label', $province->name);
        }

        $response['provinces']  = $provinces;
        $response['error']      = false;
        $response['message']    = 'Loaded';
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provinces = $this->indonesia->findProvince($id);

        array_set($provinces, 'label', $provinces->name);

        $response['provinces']  = $provinces;
        $response['error']      = false;
        $response['message']    = 'Loaded';
        $response['status']     = true;

        return response()->json($response);
    }
}
