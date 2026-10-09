@extends('layouts.app')

@section('title', 'Log Servis')

@section('nav')
<a href="{{ route('admin.dashboard') }}" class="px-3.5 py-2 rounded-lg whitespace-nowrap text-indigo-200 hover:bg-indigo-800"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
<a href="{{ route('admin.customers') }}" class="px-3.5 py-2 rounded-lg whitespace-nowrap text-indigo-200 hover:bg-indigo-800"><i class="fa-solid fa-users"></i> Customer</a>
<a href="{{ route('admin.logs') }}" class="px-3.5 py-2 rounded-lg whitespace-nowrap bg-indigo-600 text-white"><i class="fa-solid fa-clipboard-list"></i> Log Servis</a>
@endsection

@section('content')
<div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
  <h2 class="text-lg font-black text-slate-800 mb-4"><i class="fa-solid fa-clipboard-list text-indigo-600 mr-2"></i>Log Servis (statis)</h2>
  <div class="overflow-x-auto">
    <table class="rtable w-full text-left text-xs border border-slate-100 rounded-xl overflow-hidden">
      <thead class="bg-slate-50 text-slate-500 uppercase text-[10px]"><tr><th class="p-3">ID</th><th class="p-3">Tanggal</th><th class="p-3">Customer</th><th class="p-3">Teknisi</th><th class="p-3">Odo</th><th class="p-3">Skor</th><th class="p-3">Catatan</th></tr></thead>
      <tbody>
      @foreach($logs as $l)
        <tr class="border-t border-slate-100"><td class="p-3 font-mono" data-label="ID">{{ $l['id'] }}</td><td class="p-3" data-label="Tanggal">{{ $l['date'] }}</td><td class="p-3 font-bold" data-label="Customer">{{ $l['customer_id'] }}</td><td class="p-3" data-label="Teknisi">{{ $l['tech'] }}</td><td class="p-3" data-label="Odo">{{ number_format($l['odo'],0,',','.') }} KM</td><td class="p-3 font-black" data-label="Skor">{{ $l['score'] }}/100</td><td class="p-3 text-slate-500" data-label="Catatan">{{ $l['note'] }}</td></tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
