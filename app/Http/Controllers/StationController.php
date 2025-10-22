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
        $stations = Station::with('city.Departaments.country')->paginate(10); // CORREGIDO: city.Departaments.country
        return view('stations.index', compact('stations'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $cities = Cities::with('Departaments.country')->orderBy('name')->get(); // CORREGIDO: with('Departaments.country')
        return view('stations.create', compact('cities'));
    }

    // Guardar nueva estación
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255', // AGREGADO: tipo string y max
            'code' => 'nullable|string|max:255|unique:stations,code', // AGREGADO: validaciones
            'id_city' => 'required|exists:cities,id',
            'status' => 'nullable'
        ]);

        Station::create([
            'name' => $data['name'],
            'code' => $data['code'] ?? null,
            'id_city' => $data['id_city'],
            'status' => $request->boolean('status', true) // AGREGADO: valor por defecto true
        ]);

        return redirect()->route('stations.index')->with('ok', 'Estación creada exitosamente');
    }

    // AGREGAR MÉTODOS FALTANTES:

    /**
     * Display the specified resource.
     */
    public function show(Station $station)
    {
        $station->load('city.Departaments.country'); // CORREGIDO: city.Departaments.country
        return view('stations.show', compact('station'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Station $station)
    {
        $cities = Cities::with('Departaments.country')->orderBy('name')->get(); // CORREGIDO: with('Departaments.country')
        return view('stations.edit', compact('station', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Station $station)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:255|unique:stations,code,' . $station->id,
            'id_city' => 'required|exists:cities,id',
            'status' => 'nullable'
        ]);

        $station->update([
            'name' => $data['name'],
            'code' => $data['code'] ?? null,
            'id_city' => $data['id_city'],
            'status' => $request->boolean('status')
        ]);

        return redirect()->route('stations.index')->with('ok', 'Estación actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Station $station)
    {
        $station->delete();
        return redirect()->route('stations.index')->with('ok', 'Estación eliminada exitosamente');
    }
}