<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductionsController extends Controller
{
    
    public function locations(Request $request)
    {
        $this->validate($request, [
            'shoot_date_from' => 'required',
            'shoot_date_to' => 'required',
            'timezone' => 'required'
        ]);
        
        $timezone = $request->input('timezone');
        $from = \Carbon\Carbon::createFromTimestampMs($request->input('shoot_date_from'), $timezone);
        $to = \Carbon\Carbon::createFromTimestampMs($request->input('shoot_date_to'), $timezone);
        
        $service = resolve(\App\Services\ProductionsService::class);
        $productions = $service->getProductionsByShootDate($from, $to, $timezone);
        return response()->json([
            'count' => count($productions),
            'productions' => $productions
        ]);
    }
}
