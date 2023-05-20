<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSurferRequest;
use App\Http\Requests\UpdateSurferRequest;
use App\Models\surfer;
use Illuminate\Database\QueryException;

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

        $input = $request->validated();
        $data = surfer::create($input);
        return $data;
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
    public function update(UpdateSurferRequest $request, string $id)
    {

        $input = $request->validated();

        $surfer = Surfer::find($id);

        if (!$surfer) {
            return response()->json([
                'isPutSuccessful' => false,
                'message' => 'Surfer not found'
            ], 404);
        }

        $surfer->update($input);

        return response()->json([
            'isPutSuccessful' => true,
            'message' => 'surfer changed successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $surfer = Surfer::where('id', $id)->first();
            if (!$surfer) {
                return response()->json([
                    'isDeletedSuccessful' => false,
                    'message' => 'Surfer not found'
                ], 404);
            }

            $surfer->delete();

            return response()->json([
                'isDeletedSuccessful' => true,
                'message' => 'Surfer deleted successfully'
            ], 200);
        } catch (QueryException $e) {
            // Verifica se o erro é de violação de integridade referencial
            if ($e->getCode() === '23000') {
                return response()->json([
                    'isDeletedSuccessful' => false,
                    'message' => 'Unable to delete record due to foreign key constraints'
                ], 422);
            }
        }
    }
}
