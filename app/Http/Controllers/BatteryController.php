<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBatteryRequest;
use App\Http\Requests\UpdateBatteryRequest;
use App\Models\Battery;
use Illuminate\Support\Facades\DB;

class BatteryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $battery = Battery::join('surfers as surfer1', 'batteries.fk_surfer1', '=', 'surfer1.id')
            ->join('surfers as surfer2', 'batteries.fk_surfer2', '=', 'surfer2.id')
            ->select('batteries.*', 'surfer1.name as surfer1_name', 'surfer2.name as surfer2_name')
            ->get();

        return  $battery;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBatteryRequest $request)
    {
        $battery = Battery::create($request->all());
        $data = [
            'isSuccessful' => $battery->wasRecentlyCreated,
            'id' => $battery->id,
        ];
        return response($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $battery = Battery::join('surfers as surfer1', 'batteries.fk_surfer1', '=', 'surfer1.id')
            ->join('surfers as surfer2', 'batteries.fk_surfer2', '=', 'surfer2.id')
            ->where('batteries.id', $id)
            ->select('batteries.*', 'surfer1.name as surfer1_name', 'surfer2.name as surfer2_name')
            ->get();

        return  $battery;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Battery $battery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBatteryRequest $request, Battery $battery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $battery = Battery::where('id', $id)->first();
        if (!$battery) {
            return response()->json([
                'isDeletedSuccessful' => false,
                'message' => 'battery not found'
            ], 404);
        }

        $battery->delete();

        return response()->json([
            'isDeletedSuccessful' => true,
            'message' => 'battery deleted successfully'
        ], 200);
    }

    public function batteryWinner($id)
    {
        config()->set('database.connections.mysql.strict', false);
        $battery = Battery::where('id', $id)->first();
            if (!$battery) {
                return response()->json([
                    'message' => 'battery not found'
                ], 404);
            }
        $results = Battery::join('waves', 'batteries.id', '=', 'waves.fk_battery')
        ->join('grades', 'waves.id', '=', 'grades.fk_wave')
        ->select(
            'batteries.id as battery_id',
            DB::raw('(grades.partial_grades1 + grades.partial_grades2 + grades.partial_grades3) / 3 as grade'),
            DB::raw('(select name from surfers where id = waves.fk_surfer) as name')
            )
            -> groupBy('batteries.id', 'waves.id')
            ->orderBy('grade', 'desc')
            ->where('batteries.id', $id)
           ->limit(1)
           ->first();
        return $results;
    }
}
