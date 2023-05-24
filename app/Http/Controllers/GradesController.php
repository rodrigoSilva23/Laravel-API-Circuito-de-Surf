<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradesRequest;
use App\Http\Requests\UpdateGradesRequest;
use App\Models\Grades;

class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Grades::all();
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
    public function store(StoreGradesRequest $request)
    {
        $grades = Grades::create($request->validated());
        return response([
            'isCreatedSuccessful' => true,
            'message' => 'created successful',
            "grande" => $grades

        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Grades::where("id", $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grades $grades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGradesRequest $request, Grades $grades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $grades  = Grades::where('id', $id)->first();
        if (!$grades) {
            return response()->json([
                'isDeletedSuccessful' => false,
                'message' => 'grades not found'
            ], 404);
        }

        $grades->delete();

        return response()->json([
            'isDeletedSuccessful' => true,
            'message' => 'grades deleted successfully'
        ], 200);
    }
}
