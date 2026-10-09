# Phase 4 — Cetak WO + Regresi Portal + QA Penuh

Status: ⬜ Antre (dependensi: Phase 2–3 selesai)

## Tujuan
WO bisa dicetak mirip kertas (kop SMK, tabel, gauge AJHI, kolom tanda tangan),
dan portal existing terbukti tidak berubah.

## Cakupan (must-have)
- Halaman cetak WO (Blade print CSS, ikut pola `no-print`/`printing` prototipe):
  identitas pelanggan + kendaraan, keluhan, tabel pekerjaan + teknisi + status,
  tabel sparepart, diagnosis, rekomendasi, gauge + bar AJHI, estimasi, QC,
  kolom tanda tangan (nama terverifikasi login).
- Regresi portal: tampilan + alur `/`, `/c/{token}` identik sebelum/sesudah.
- QA penuh bundel 1 (TC-01 s/d TC-07 di `fase-ajhi.md`).

## AC
- AC-05: Customer membuka `/c/{token}` → tampilan dan data terlihat sama seperti sebelum
  perubahan (cek manual + HTTP 200; token salah 404).

## Tasks + DoD
1. Blade cetak WO + route `/staff` print → hasil cetak lolos cek visual vs foto WO.
2. Regresi portal (banding ID + teks kunci, pola verifikasi sebelumnya) → semua OK.
3. Jalankan seluruh QA bundel 1 → semua TC hijau, `php artisan test` hijau.
4. Cleanup + update dokumen phase → status ✅.

## QA
- TC-P4-01: cetak WO selesai → memuat semua blok kertas (kop, tabel, gauge, ttd).
- TC-P4-02: cetak WO yang belum selesai → ada watermark/status "BELUM SELESAI".
