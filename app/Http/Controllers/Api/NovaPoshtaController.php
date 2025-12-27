<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\NovaPoshtaService;
use Illuminate\Http\Request;

class NovaPoshtaController extends Controller
{
    public function __construct(private NovaPoshtaService $novaPoshta)
    {
    }

    public function searchCities(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $cities = $this->novaPoshta->searchCities($query);

        return response()->json($cities);
    }

    public function getWarehouses(Request $request)
    {
        $cityRef = $request->get('city_ref', '');

        if (!$cityRef) {
            return response()->json([]);
        }

        $warehouses = $this->novaPoshta->getWarehouses($cityRef);

        return response()->json($warehouses);
    }
}
