<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Models\Departaments;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sensors = Sensor::with('Departaments.country')
            ->orderBy('name')
            ->paginate(10);
        
        return view('sensors.index', compact('sensors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $departments = Departaments::with('country')
        ->orderBy('name')
        ->get();
    
    return view('sensors.create', compact('departments'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:sensors,code|max:255',
            'abbrev' => 'nullable|string|max:20',
            'id_Departaments' => 'required|integer|exists:departaments,id',
            'status' => 'nullable'
        ]);

        Sensor::create([
            'name' => $data['name'],
            'code' => $data['code'],
            'abbrev' => $data['abbrev'] ?? null,
            'id_Departaments' => $data['id_Departaments'],
            'status' => $request->boolean('status', true)
        ]);

        return redirect()->route('sensors.index')->with('ok', 'Sensor creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sensor $sensor)
    {
        return view('sensors.show', compact('sensor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sensor $sensor)
    {
        $Departamentss = Departaments::with('country')
            ->orderBy('name')
            ->get();
        
        return view('sensors.edit', compact('sensor', 'Departamentss'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sensor $sensor)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:sensors,code,' . $sensor->id,
            'abbrev' => 'nullable|string|max:20',
            'id_Departaments' => 'required|integer|exists:Departamentss,id',
            'status' => 'nullable'
        ]);

        $sensor->update([
            'name' => $data['name'],
            'code' => $data['code'],
            'abbrev' => $data['abbrev'] ?? null,
            'id_Departaments' => $data['id_Departaments'],
            'status' => $request->boolean('status')
        ]);

        return redirect()->route('sensors.index')->with('ok', 'Sensor actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sensor $sensor)
    {
        $sensor->delete();
        
        return redirect()->route('sensors.index')->with('ok', 'Sensor eliminado exitosamente');
    }
}