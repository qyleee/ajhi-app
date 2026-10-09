@extends('layouts.app')

@section('title', 'Auto Jats Service')

@section('content')
<div class="text-center max-w-md mx-auto py-10">
  <div class="bg-amber-400 text-indigo-950 w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-3xl mb-4 shadow-lg"><i class="fa-solid fa-motorcycle"></i></div>
  <h1 class="text-2xl font-black">Auto Jats Service</h1>
  <p class="text-sm text-slate-500 mb-6">AJHI — Health Index &amp; Service Passport · Laravel + Filament · MySQL</p>
  <div class="grid gap-2 text-sm font-bold">
    <a href="{{ route('login') }}" class="bg-white border rounded-xl py-3 hover:bg-slate-50"><i class="fa-solid fa-right-to-bracket mr-2 text-indigo-600"></i>Portal Login</a>
    <a href="{{ route('scan') }}" class="bg-white border rounded-xl py-3 hover:bg-slate-50"><i class="fa-solid fa-qrcode mr-2 text-emerald-600"></i>Scan QR Customer</a>
    <a href="{{ route('admin.dashboard') }}" class="bg-white border rounded-xl py-3 hover:bg-slate-50"><i class="fa-solid fa-chart-pie mr-2 text-indigo-600"></i>Dashboard Admin (statis)</a>
    <a href="{{ route('tech.input') }}" class="bg-white border rounded-xl py-3 hover:bg-slate-50"><i class="fa-solid fa-wrench mr-2 text-slate-600"></i>Input Teknisi (statis)</a>
    <a href="/staff" class="bg-indigo-600 text-white rounded-xl py-3 hover:bg-indigo-700"><i class="fa-solid fa-user-gear mr-2"></i>Panel Staff Filament /staff</a>
  </div>
  <p class="text-[11px] text-slate-400 mt-6">Prototipe asli tersimpan di <code>prototype/index.html</code> · DB <code>ajhi_app</code> MySQL XAMPP sudah tersambung.</p>
</div>
@endsection
