@extends('layouts.app')

@section('title', 'AJHI Portal - Login')

@section('content')
<div class="max-w-sm mx-auto">
  <div class="bg-white p-7 sm:p-8 rounded-3xl shadow-2xl text-center">
    <div class="bg-amber-400 text-indigo-950 w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-3xl mb-4 shadow-lg">
      <i class="fa-solid fa-motorcycle"></i>
    </div>
    <h1 class="text-2xl font-black text-slate-800">AJHI Portal</h1>
    <p class="text-sm text-slate-500 mb-6">Auto Jats Health Index System</p>

    <div class="space-y-3">
      <a href="/staff/login" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl flex items-center justify-center gap-3 transition">
        <i class="fa-solid fa-user-shield"></i> Login Admin
      </a>
      <a href="/staff/login" class="w-full bg-slate-800 hover:bg-slate-900 text-white font-bold py-3 rounded-xl flex items-center justify-center gap-3 transition">
        <i class="fa-solid fa-wrench"></i> Login Teknisi
      </a>
      <div class="pt-4 border-t border-slate-100">
        <a href="{{ route('scan') }}" class="w-full bg-emerald-100 hover:bg-emerald-200 text-emerald-800 font-bold py-3 rounded-xl flex items-center justify-center gap-3 transition">
          <i class="fa-solid fa-qrcode"></i> Login Customer (Scan QR)
        </a>
      </div>
    </div>

    <p class="mt-6 text-[11px] text-slate-400 leading-relaxed">
      Tahap UI statis — login staff via <a href="/staff" class="text-indigo-600 font-bold">Panel Filament /staff</a>.
      Customer via token QR.
    </p>
  </div>
</div>
@endsection
