<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWavesRequest;
use App\Http\Requests\UpdateWavesRequest;
use App\Models\Waves;

class WavesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Waves::all();;
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
    public function store(StoreWavesRequest $request)
    {
        $request = $request->validated();
        $data =  Waves::create($request);

        if ($data) {
            return response()->json([
                'isCreatedSuccessful' => true,
                'message' => 'created successful'
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Waves $waves,$id)
    {
        return $waves->where('id',$id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Waves $waves)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWavesRequest $request, Waves $waves)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Waves $waves,$id)
    {
          $wave = Waves::where('id', $id)->first();
            if (!$wave) {
                return response()->json([
                    'isDeletedSuccessful' => false,
                    'message' => 'wave not found'
                ], 404);
            }

            $wave->delete();

            return response()->json([
                'isDeletedSuccessful' => true,
                'message' => 'wave deleted successfully'
            ], 200);
    }
}
