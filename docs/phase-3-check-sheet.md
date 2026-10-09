# Phase 3 — Check Sheet Pemeriksaan + Skor AJHI Otomatis

Status: ⬜ Antre (dependensi: Phase 2 selesai)

## Tujuan
Gantikan kertas "Check Sheet Pemeriksaan Kendaraan": teknisi mengisi kondisi per item,
skor AJHI + risk flag terhitung otomatis dan tersimpan di WO.

## Cakupan (must-have)
- Master `inspection_items` (seed dari sheet PM): 13 item + `kategori`, `parameter_standar`,
  `metode` (Visual/Ukur/Manual/Fungsional), `risk_level`, `weight`.
  ITM-011 Lampu Rem = trigger warning (sama seperti `has_critical` sekarang).
- Tabel `inspections` (1 per WO) + `inspection_values`: nilai per item (1/0.5/0),
  angka ukur (tekanan psi, ketebalan mm, voltase — nullable sesuai metode),
  catatan per item (kolom Baik/Perlu Servis/Ganti di kertas).
- Skor dihitung server-side via `AjhiCalculator` (dipakai ulang, bukan ditulis baru).
- Hasil (skor, risk, status, criticals) tersimpan di WO; gauge + bar per sistem tampil di WO.
- Road test + kondisi awal kendaraan (checkbox Ya/Tidak per baris kertas) ikut tersimpan.

## AC
- AC-03: 13 item terisi → skor + risk tersimpan di WO dan SAMA dengan prototipe
  untuk input yang sama (cek silang `AjhiCalculator`).
- AC-04: Item belum lengkap → WO tidak bisa Selesai + pesan item yang kurang.

## Tasks + DoD
1. Migration `inspection_items`, `inspections`, `inspection_values` + seed 13 item → Ran.
2. Form inspeksi Filament (per kategori kertas) → tersimpan lengkap per WO.
3. Hook hitung skor saat simpan → unit test: input default prototipe = 90 + PRIORITAS.
4. Gauge + bar per sistem di halaman WO → tampil sesuai skor.
5. Feature test AC-03 & AC-04 hijau.

## QA
- TC-P3-01: ITM-011 = 0 → flag PRIORITAS walau skor tinggi.
- TC-P3-02: angka ukur di luar batas wajar (mis. tekanan 0 psi) → warning validasi.
- TC-P3-03: edit inspeksi → skor WO terhitung ulang.
