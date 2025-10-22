<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Sensor_Data;
use App\Models\Sensor;

class DashboardController extends Controller 
{
    public function index()
    {
        $stations = Station::with('city.Departaments.country') // CORREGIDO: city.Departaments.country
            ->where('status', true)
            ->orderBy('name')
            ->get();
            
        $sensorsOnline = Sensor::where('status', true)->count();
        $lastSync = Sensor_Data::max('created_at');
        $dbDriver = strtoupper(config('database.default'));
        
        return view('index', compact('stations', 'sensorsOnline', 'lastSync', 'dbDriver'));
    }
}