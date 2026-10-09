@extends('layouts.app')

@section('title', 'Data Customer')

@section('nav')
<a href="{{ route('admin.dashboard') }}" class="px-3.5 py-2 rounded-lg whitespace-nowrap text-indigo-200 hover:bg-indigo-800"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
<a href="{{ route('admin.customers') }}" class="px-3.5 py-2 rounded-lg whitespace-nowrap bg-indigo-600 text-white"><i class="fa-solid fa-users"></i> Customer</a>
<a href="{{ route('admin.logs') }}" class="px-3.5 py-2 rounded-lg whitespace-nowrap text-indigo-200 hover:bg-indigo-800"><i class="fa-solid fa-clipboard-list"></i> Log Servis</a>
@endsection

@section('content')
<div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
    <div><h2 class="text-lg font-black text-slate-800"><i class="fa-solid fa-users text-indigo-600 mr-2"></i>Data Customer</h2><p class="text-xs text-slate-500">{{ count($customers) }} terdaftar · statis</p></div>
    <a href="/staff" class="bg-indigo-600 text-white text-xs font-bold px-4 py-2 rounded-lg">+ Tambah via Filament</a>
  </div>
  <div class="overflow-x-auto">
    <table class="rtable w-full text-left text-xs border border-slate-100 rounded-xl overflow-hidden">
      <thead class="bg-slate-50 text-slate-500 uppercase text-[10px]"><tr><th class="p-3">Plat</th><th class="p-3">Nama</th><th class="p-3">Motor</th><th class="p-3">WA</th><th class="p-3">Token</th></tr></thead>
      <tbody>
      @foreach($customers as $c)
        <tr class="border-t border-slate-100 hover:bg-slate-50">
          <td class="p-3 font-bold" data-label="Plat">{{ $c['plate'] }}</td>
          <td class="p-3" data-label="Nama">{{ $c['name'] }}</td>
          <td class="p-3 text-slate-500" data-label="Motor">{{ $c['model'] }}</td>
          <td class="p-3 text-slate-500" data-label="WA">{{ $c['wa'] }}</td>
          <td class="p-3 font-mono text-slate-400" data-label="Token">{{ $c['token'] }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
