<?php

namespace App\Http\Controllers;

use App\Models\Launche;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LauncheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $launche = Launche::all();

        return response()->json($launche);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $launche = Launche::create([
            'id' => $request->id,
            'provider' => $request->provider
        ]);

        return response()->json($launche, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Launche $launche
     * @return JsonResponse
     */
    public function show(Launche $launche)
    {
        return response()->json($launche);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Launche $launche
     * @return JsonResponse
     */
    public function update(Request $request, Launche $launche)
    {
        $launche->update([
            'provider' => $request->provider
        ]);

        return response()->json($launche);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Launche $launche
     * @return JsonResponse
     */
    public function destroy(Launche $launche)
    {
        $launche->delete();

        return response()->json();
    }
}
