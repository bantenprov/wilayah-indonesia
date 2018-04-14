<?php
namespace Bantenprov\WilayahIndonesia\Http\Controllers;
/* Require */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/* Models */
use App\User;
use Laravolt\Indonesia\Indonesia;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

/* Etc */
use Validator;
/**
 * The ProvinceController class.
 *
 * @package Bantenprov\WilayahIndonesia
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class ProvinceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $user;

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
    public function allVillages($id = 36)
    {
        $villages   = $this->province
                        ->where($this->province->getTable().'.id', $id)
                        ->select(
                            $this->village->getTable().'.id as id',
                            DB::raw("CONCAT({$this->city->getTable()}.name,' - ',{$this->district->getTable()}.name,' - ',{$this->village->getTable()}.name) as label")
                        )
                        ->join(
                            $this->city->getTable(),
                            $this->province->getTable().'.id','=',$this->city->getTable().'.province_id'
                        )
                        ->join(
                            $this->district->getTable(),
                            $this->city->getTable().'.id','=',$this->district->getTable().'.city_id'
                        )
                        ->join(
                            $this->village->getTable(),
                            $this->district->getTable().'.id','=',$this->village->getTable().'.district_id'
                        )->get();

        $response['village']    = $villages;
        $response['status']     = true;

        return response()->json($response);
    }
}
