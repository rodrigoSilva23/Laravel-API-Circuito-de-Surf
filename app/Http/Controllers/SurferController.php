<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSurferRequest;
use App\Http\Requests\UpdateSurferRequest;
use App\Models\surfer;

class surferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return surfer::all();
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
    public function store(StoreSurferRequest $request)
    {
        $data = $request->validated();
        $surfer = surfer::create($data);
        return $surfer;
    }

    /**
     * Display the specified resource.
     */
    public function show(surfer $surfer)
    {
        return $surfer;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(surfer $surfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSurferRequest $request, surfer $surfer)
    {

        $retorno = $surfer->update($request->all());
        return response()->json(['isPutSuccessful'=>$retorno], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $surfer = surfer::where('id', $id)->delete();

        return response()->json([
            'isDeletedSuccessful' => $surfer
        ], 200);
    }

}
