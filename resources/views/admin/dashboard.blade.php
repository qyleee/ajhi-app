@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('nav')
<a href="{{ route('admin.dashboard') }}" class="px-3.5 py-2 rounded-lg whitespace-nowrap bg-indigo-600 text-white"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
<a href="{{ route('admin.customers') }}" class="px-3.5 py-2 rounded-lg whitespace-nowrap text-indigo-200 hover:bg-indigo-800"><i class="fa-solid fa-users"></i> Customer</a>
<a href="{{ route('admin.logs') }}" class="px-3.5 py-2 rounded-lg whitespace-nowrap text-indigo-200 hover:bg-indigo-800"><i class="fa-solid fa-clipboard-list"></i> Log Servis</a>
<a href="/staff" class="px-3.5 py-2 rounded-lg whitespace-nowrap text-indigo-200 hover:bg-indigo-800"><i class="fa-solid fa-user-gear"></i> Teknisi (Filament)</a>
@endsection

@section('content')
<div class="space-y-5">
  <div class="flex items-center justify-between flex-wrap gap-3">
    <div>
      <h2 class="text-lg font-black text-slate-800"><i class="fa-solid fa-chart-pie text-indigo-600 mr-2"></i>Dashboard Admin</h2>
      <p class="text-xs text-slate-500">Ringkasan operasional Auto Jats Service (data dummy statis)</p>
    </div>
    <a href="/staff" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl"><i class="fa-solid fa-plus mr-1.5"></i>Kelola di Filament</a>
  </div>

  <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
    @foreach([['fa-users','Total Customer',count($customers)],['fa-clipboard-list','Total Log Servis',count($logs)],['fa-gauge-high','Rata-rata Index',$avg],['fa-triangle-exclamation','Unit Kritis',$crit]] as $s)
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
      <div class="flex items-center gap-3">
        <div class="bg-indigo-50 text-indigo-600 w-10 h-10 rounded-xl flex items-center justify-center"><i class="fa-solid {{ $s[0] }}"></i></div>
        <div><div class="text-[10px] uppercase tracking-wider text-slate-400 font-bold">{{ $s[1] }}</div><div class="text-2xl font-black text-slate-800">{{ $s[2] }}</div></div>
      </div>
    </div>
    @endforeach
  </div>

  <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
    <div class="flex items-center justify-between mb-3">
      <h3 class="font-bold text-slate-800 text-sm"><i class="fa-solid fa-clock-rotate-left text-indigo-600 mr-2"></i>Servis Terbaru</h3>
      <a href="{{ route('admin.logs') }}" class="text-xs text-indigo-600 font-semibold hover:underline">Lihat semua</a>
    </div>
    <div class="overflow-x-auto">
      <table class="rtable w-full text-left text-xs border border-slate-100 rounded-xl overflow-hidden">
        <thead class="bg-slate-50 text-slate-500 uppercase text-[10px]"><tr><th class="p-3">Tanggal</th><th class="p-3">Customer</th><th class="p-3">Skor</th><th class="p-3">Status</th></tr></thead>
        <tbody>
        @foreach(array_slice($logs,0,5) as $l)
          <tr class="border-t border-slate-100"><td class="p-3" data-label="Tanggal">{{ $l['date'] }}</td><td class="p-3 font-bold" data-label="Customer">{{ $l['customer_id'] }} · {{ $l['tech'] }}</td><td class="p-3 font-black" data-label="Skor">{{ $l['score'] }}/100</td><td class="p-3" data-label="Status">{{ $l['status'] }}</td></tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
