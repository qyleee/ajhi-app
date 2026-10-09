@extends('layouts.app')

@section('title', $customer['plate'].' - Passport')

@section('nav')
<a href="{{ route('customer.home', $customer['token']) }}" class="px-3.5 py-2 rounded-lg whitespace-nowrap bg-emerald-600 text-white"><i class="fa-solid fa-house"></i> Beranda</a>
<a href="{{ route('customer.history', $customer['token']) }}" class="px-3.5 py-2 rounded-lg whitespace-nowrap text-emerald-200 hover:bg-indigo-800"><i class="fa-solid fa-book-open"></i> Riwayat</a>
@endsection

@section('content')
<div class="space-y-4">
  @if($reminder)
  <div class="rounded-2xl border-2 px-4 py-4 bg-orange-50 border-orange-200">
    <div class="text-[10px] uppercase tracking-widest font-bold text-orange-700">Pengingat Servis</div>
    <div class="text-sm font-black text-slate-800">{{ $customer['plate'] }} — {{ $reminder['label'] }}</div>
    <div class="text-[11px] text-slate-500">Jatuh tempo {{ $reminder['next'] }} · Index terakhir {{ $last['score'] ?? '-' }}/100</div>
  </div>
  @endif

  <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
    <span class="text-[10px] uppercase tracking-widest text-indigo-600 font-bold">Service Passport</span>
    <h2 class="text-2xl font-black text-slate-800">{{ $customer['plate'] }}</h2>
    <p class="text-xs text-slate-500">{{ $customer['name'] }} · {{ $customer['model'] }} · {{ $customer['wa'] }}</p>
    @if($last)
    <div class="mt-3 flex items-center gap-3">
      <div class="text-4xl font-black text-indigo-700">{{ $last['score'] }}<span class="text-base text-slate-400 font-normal">/100</span></div>
      <div><div class="text-xs font-bold">{{ $last['status'] }}</div><div class="text-[11px] text-slate-500">{{ $last['date'] }} · {{ $last['tech'] }} · {{ number_format($last['odo'],0,',','.') }} KM</div></div>
    </div>
    <p class="text-xs text-slate-500 mt-2">{{ $last['note'] }}</p>
    @else
    <p class="text-xs text-slate-400 mt-2">Belum ada servis.</p>
    @endif
  </div>
</div>
@endsection
