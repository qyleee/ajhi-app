@extends('layouts.app')

@section('title', 'Input Servis - Teknisi')

@section('nav')
<a href="{{ route('tech.input') }}" class="px-3.5 py-2 rounded-lg whitespace-nowrap bg-indigo-600 text-white"><i class="fa-solid fa-wrench"></i> Input Servis</a>
<a href="{{ route('admin.logs') }}" class="px-3.5 py-2 rounded-lg whitespace-nowrap text-indigo-200 hover:bg-indigo-800"><i class="fa-solid fa-clock-rotate-left"></i> Log</a>
@endsection

@section('content')
<div class="space-y-4">
  <div class="bg-indigo-950 text-white rounded-2xl p-4 sm:p-5">
    <span class="text-[10px] uppercase tracking-widest text-indigo-300 font-bold">Live Health Index (statis, JS penuh tahap berikut)</span>
    <div class="text-4xl font-black leading-none mt-1"><span id="ti-score">0</span><span class="text-base font-normal text-indigo-400">/100</span></div>
    <div id="ti-status" class="text-[11px] text-indigo-200 mt-2 font-semibold">Pilih kondisi tiap item — skor dihitung otomatis</div>
  </div>

  <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-2">
    <h2 class="font-black text-slate-800"><i class="fa-solid fa-wrench text-indigo-600 mr-2"></i>Checklist 13 Item</h2>
    <div class="grid gap-2">
      @foreach($checklist as $it)
      <div class="flex flex-col sm:flex-row sm:items-center justify-between p-2.5 rounded-xl border border-slate-100 bg-slate-50 gap-2">
        <div class="flex items-center gap-2 min-w-0">
          <span class="text-[10px] px-2 py-0.5 rounded font-bold flex-none {{ $it['level']==='Critical' ? 'bg-rose-100 text-rose-700' : ($it['level']==='Major' ? 'bg-indigo-100 text-indigo-700' : 'bg-slate-200 text-slate-600') }}">{{ $it['level'] }}</span>
          <span class="text-xs font-semibold text-slate-800">{{ $it['name'] }}</span>
          <span class="text-[10px] text-slate-400 font-bold">w{{ $it['weight'] }}</span>
        </div>
        <select data-weight="{{ $it['weight'] }}" data-level="{{ $it['level'] }}" class="ajhi-item text-xs font-semibold bg-white border border-slate-300 rounded-lg px-2 py-1.5">
          <option value="1">🟢 Normal</option>
          <option value="0.5">🟡 Perlu Perhatian</option>
          <option value="0">🔴 Kritis / Rusak</option>
        </select>
      </div>
      @endforeach
    </div>
    <button onclick="alert('Tahap statis — simpan ke DB tahap berikut.')" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl text-sm mt-2"><i class="fa-solid fa-floppy-disk mr-2"></i>Simpan Servis (statis)</button>
  </div>
</div>
@endsection

@push('scripts')
<script>
(function(){
  const sel = document.querySelectorAll('.ajhi-item');
  function calc(){
    let earned=0,total=0;
    sel.forEach(s=>{ const w=parseFloat(s.dataset.weight); total+=w; earned+=w*parseFloat(s.value); });
    const score=Math.round(earned/total*100);
    document.getElementById('ti-score').textContent=score;
    document.getElementById('ti-status').textContent = score>=85 ? 'Sehat / Optimal' : (score>=75 ? 'Perlu Perawatan Berkala' : 'PERLU PERBAIKAN SEGERA');
  }
  sel.forEach(s=>s.addEventListener('change',calc)); calc();
})();
</script>
@endpush
