@extends('layouts.app')

@section('title', 'Riwayat - '.$customer['plate'])

@section('nav')
<a href="{{ route('customer.home', $customer['token']) }}" class="px-3.5 py-2 rounded-lg whitespace-nowrap text-emerald-200 hover:bg-indigo-800"><i class="fa-solid fa-house"></i> Beranda</a>
<a href="{{ route('customer.history', $customer['token']) }}" class="px-3.5 py-2 rounded-lg whitespace-nowrap bg-emerald-600 text-white"><i class="fa-solid fa-book-open"></i> Riwayat</a>
@endsection

@section('content')
<div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
  <h2 class="font-black text-slate-800 mb-1"><i class="fa-solid fa-book-open text-indigo-600 mr-2"></i>Riwayat Servis {{ $customer['plate'] }}</h2>
  <p class="text-xs text-slate-500 mb-4">{{ $customer['name'] }} · {{ $customer['model'] }}</p>
  <div class="space-y-2">
    @forelse($logs as $l)
    <div class="p-3 rounded-xl border border-slate-100 bg-slate-50 flex items-center justify-between gap-3 flex-wrap">
      <div><div class="text-xs font-bold">{{ $l['date'] }} · {{ number_format($l['odo'],0,',','.') }} KM</div><div class="text-[11px] text-slate-500">{{ $l['tech'] }} — {{ $l['note'] }}</div></div>
      <div class="font-black text-indigo-700">{{ $l['score'] }}/100</div>
    </div>
    @empty
    <p class="text-xs text-slate-400">Belum ada riwayat.</p>
    @endforelse
  </div>
</div>
@endsection
