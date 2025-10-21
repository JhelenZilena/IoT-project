<?php

namespace App\Http\Controllers;

use App\Models\Sensor_Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataApiController extends Controller
{
    /**
     * Retorna datos de telemetría agrupados para Chart.js
     */
    public function series(Request $request)
    {
        $request->validate([
            'station_id' => 'required|integer|exists:stations,id',
            'from' => 'nullable|date',
            'to' => 'nullable|date',
            'group' => 'nullable|in:minute,hour,day'
        ]);

        $stationId = (int) $request->station_id;
        $from = $request->input('from', now()->subDay());
        $to = $request->input('to', now());
        $group = $request->input('group', 'hour');

        // Detectar motor de base de datos
        $driver = config('database.default');

        if ($driver === 'pgsql') {
            // PostgreSQL
            $bucket = match($group) {
                'minute' => "date_trunc('minute', created_at)",
                'day' => "date_trunc('day', created_at)",
                default => "date_trunc('hour', created_at)"
            };

            $rows = SensorData::selectRaw("$bucket as b, AVG(temp_value) as t, AVG(humidity) as h")
                ->where('id_station', $stationId)
                ->whereBetween('created_at', [$from, $to])
                ->groupBy(DB::raw('b'))
                ->orderBy('b')
                ->get();
        } else {
            // MySQL
            $fmt = match($group) {
                'minute' => '%Y-%m-%d %H:%i:00',
                'day' => '%Y-%m-%d 00:00:00',
                default => '%Y-%m-%d %H:00:00'
            };

            $rows = SensorData::selectRaw("STR_TO_DATE(DATE_FORMAT(created_at, '$fmt'), '%Y-%m-%d %H:%i:%s') as b, AVG(temp_value) as t, AVG(humidity) as h")
                ->where('id_station', $stationId)
                ->whereBetween('created_at', [$from, $to])
                ->groupBy(DB::raw('b'))
                ->orderBy('b')
                ->get();
        }

        return response()->json([
            'labels' => $rows->pluck('b')->map(fn($d) => Carbon::parse($d)->format('Y-m-d H:i')),
            'temp' => $rows->pluck('t')->map(fn($v) => $v ? round((float)$v, 2) : 0),
            'hum' => $rows->pluck('h')->map(fn($v) => $v ? round((float)$v, 2) : 0),
        ]);
    }
}