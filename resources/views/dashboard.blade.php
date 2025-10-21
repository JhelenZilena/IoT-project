@extends('layouts.app')
<label class="form-label">Hasta</label>
<input type="datetime-local" id="to" class="form-control">
</div>
<div class="col-md-2">
<label class="form-label">Agrupar</label>
<select id="group" class="form-select">
<option value="hour">Por hora</option>
<option value="minute">Por minuto</option>
<option value="day">Por día</option>
</select>
</div>
</div>

<canvas id="chart" height="120"></canvas>

@if(isset($sensorsOnline))
<div class="mt-3 small text-muted">
<strong>Sensores online:</strong> {{ $sensorsOnline }} ·
<strong>Última sincronización:</strong> {{ $lastSync }} ·
<strong>DB:</strong> {{ $dbDriver }}
</div>
@endif
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let chart;
async function loadSeries(){
const station = document.getElementById('station_id').value;
const group = document.getElementById('group').value;
const fromEl = document.getElementById('from').value;
const toEl = document.getElementById('to').value;

const qs = new URLSearchParams({ station_id: station, group });
if(fromEl) qs.append('from', new Date(fromEl).toISOString());
if(toEl) qs.append('to', new Date(toEl).toISOString());

const res = await fetch(`/api/telemetry?${qs.toString()}`);
const json = await res.json();

const data = {
labels: json.labels,
datasets: [
{ label:'Temperatura (°C)', data: json.temp, borderWidth:2, tension:.3, pointRadius:0 },
{ label:'Humedad (%)', data: json.hum, borderWidth:2, tension:.3, pointRadius:0 }
]
};
if(chart) chart.destroy();
chart = new Chart(document.getElementById('chart').getContext('2d'), {
type:'line', data, options:{ responsive:true, animation:false }
});
}
['station_id','group','from','to'].forEach(id => document.getElementById(id)?.addEventListener('change', loadSeries));
window.addEventListener('DOMContentLoaded', loadSeries);
</script>
@endpush