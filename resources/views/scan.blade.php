@extends('layouts.app')

@section('title', 'Scan QR Customer')

@section('content')
<div class="max-w-sm mx-auto">
  <div class="bg-white rounded-3xl overflow-hidden shadow-2xl">
    <div class="bg-indigo-900 text-white px-5 py-4">
      <h2 class="font-bold">Scan QR Customer</h2>
      <p class="text-[11px] text-indigo-200">Tahap statis — kamera &amp; jsQR aktif setelah backend token jadi</p>
    </div>
    <div class="p-4">
      <div class="relative bg-slate-900 rounded-2xl overflow-hidden aspect-square mb-4 flex flex-col items-center justify-center text-slate-400">
        <i class="fa-solid fa-camera text-4xl mb-2"></i>
        <span class="text-xs">Kamera belum aktif (statis)</span>
      </div>
      <form action="{{ route('customer.token') }}" method="POST" class="flex gap-2">
        @csrf
        <input type="text" name="token" placeholder="Masukkan token (cth: KT3MTR7X9A)" class="flex-1 border rounded-xl px-3 py-2 text-sm uppercase outline-none focus:ring-2 focus:ring-indigo-500" required>
        <button class="bg-slate-800 text-white px-4 rounded-xl text-sm font-bold">Masuk</button>
      </form>
      <div class="mt-3 text-[11px] text-slate-400">Token demo: <b>KT3MTR7X9A</b> · <b>NMAXQ2PL8B</b> · <b>SATRIA5KM7</b></div>
    </div>
  </div>
</div>
@endsection
