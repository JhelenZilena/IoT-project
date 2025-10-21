<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Cities;
use Illuminate\Http\Request;

class StationController extends Controller
{
    // Mostrar lista de estaciones
    public function index()
    {
        $stations = Station::with('city.department.country')->paginate(10);
        return view('stations.index', compact('stations'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $cities = Cities::orderBy('name')->get();
        return view('stations.create', compact('cities'));
    }

    // Guardar nueva estación
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'code' => 'nullable',
            'id_city' => 'required|exists:cities,id',
            'status' => 'nullable'
        ]);

        Station::create([
            'name' => $data['name'],
            'code' => $data['code'] ?? null,
            'id_city' => $data['id_city'],
            'status' => $request->boolean('status')
        ]);

        return redirect()->route('stations.index')->with('ok', 'Estación creada exitosamente');
    }
}