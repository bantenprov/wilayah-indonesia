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
 * The VillageController class.
 *
 * @package Bantenprov\WilayahIndonesia
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class VillageController extends Controller
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
        $villages = $this->indonesia->allVillages();

        foreach ($villages as $village){
            array_set($village, 'label', $village->name);
        }

        $response['villages']   = $villages;
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
    public function getByDistrict($id)
    {
        $villages = $this->indonesia->findDistrict($id, ['villages']);

        if (isset($villages->villages)) {
            $villages = $villages->villages;
        } else {
            $villages = $this->village->getAttributes();
        }

        foreach ($villages as $village){
            array_set($village, 'label', $village->name);
        }

        $response['villages']   = $villages;
        $response['error']      = false;
        $response['message']    = 'Loaded';
        $response['status']     = true;

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $village = $this->indonesia->findVillage($id);

        array_set($village, 'label', $village->name);

        $response['village']    = $village;
        $response['error']      = false;
        $response['message']    = 'Loaded';
        $response['status']     = true;

        return response()->json($response);
    }
}
