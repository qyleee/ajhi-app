# AJHI — Dokumen Kerja (Gaya Ringkas)

Sumber: formulir kertas PM (Work Order, Check Sheet, Registrasi, Invoice, Kwitansi, Service Passport)
+ spesifikasi spreadsheet "Master AJHI" (4 sheet: master_checklist, Data_Pelanggan, Data_Kendaraan, Riwayat_Health_Check).

Fakta project: Laravel 13.35, Filament 5.10.1, MySQL `ajhi_app` (XAMPP), PHP 8.4.
Batasan: tampilan + alur portal existing (`/`, `/c/{token}`) JANGAN diubah.

---

## 1. BRIEF

Bengkel masih mencatat servis di kertas. Target: input registrasi → check sheet → work order
pindah ke web; hasil cetak tetap mirip kertas. Invoice, kwitansi, dan passport digital dikerjakan
belakangan karena butuh data dari phase awal.

## 2. SCOPE

**Must have (Phase 1–4):**
- P1: Tabel `vehicles` (1 customer banyak kendaraan), `customer_code` (CUST-XXXX), `alamat`.
- P2: `work_orders` bernomor otomatis + item pekerjaan + status Belum/Proses/Selesai (Filament).
- P3: Check sheet 13 item + angka ukur ban + skor AJHI otomatis tersimpan di WO.
- P4: Halaman cetak WO + regresi tampilan portal + QA penuh.

**Later:** invoice + kwitansi (butuh harga jasa/part), passport digital, tanda tangan digital
(sementara nama penandatangan terverifikasi login).

**Out-of-scope:** stok sparepart real-time, payment gateway, multi-cabang.

## 3. SPECS + Acceptance Criteria

- AC-01: Admin submit registrasi valid (nama, WA format 628xxx, 1 kendaraan plat unik) →
  tersimpan 1 customer (`CUST-XXXX`) + 1 vehicle + 1 WO bernomor, redirect ke halaman WO.
- AC-02: Plat duplikat → validasi menolak di field plat, tidak ada baris baru di database.
- AC-03: Teknisi mengisi lengkap 13 item → skor + risk/flag terhitung otomatis via
  `AjhiCalculator` dan tersimpan di WO (hasil sama dengan prototipe untuk input yang sama).
- AC-04: WO tanpa check sheet lengkap → aksi "Selesai" terkunci + pesan item yang kurang.
- AC-05: Customer membuka `/c/{token}` → tampilan dan data terlihat sama seperti sebelum
  perubahan (regresi tampilan portal).

## 4. TECHNICAL DESIGN (ringkas)

- `customers`: +`customer_code` unik, +`alamat` nullable. Kolom lama (`plate`, `model`) dipertahankan
  sementara untuk kompatibilitas.
- `vehicles`: `vehicle_code` unik (VEH-XXXX), `customer_id` FK cascade, `plate` unik,
  `brand_model`, `year`, `capacity_cc`, `odometer` (nullable).
- `work_orders` (P2): nomor unik `WO-YYYY-NNNN` (reset tiap tahun, generate dalam transaction),
  `vehicle_id`, prioritas, status, keluhan, estimasi. `work_order_items`: pekerjaan + teknisi + status.
- `inspections` + `inspection_values` (P3): nilai per item (1/0.5/0) + angka ukur + catatan;
  skor dihitung server-side, bukan di browser.
- UI staff via Filament Resources + RelationManager; cetak via Blade print (P4).
- Auth: admin full; teknisi hanya WO yang di-assign (Policy, P2).

## 5. DECISION LOG / RISK LOG

- D-01: Input staff via Filament, bukan Blade custom. Alasan: tabel + validasi + relasi lebih cepat;
  alternatif Blade ditolak (duplikasi kerja). Dampak: staff login di `/staff`.
- D-02: 1 customer boleh banyak kendaraan (ikut spec PM). Data seed lama dimigrasi jadi
  1 vehicle per customer. Alternatif 1:1 ditolak (melanggar spec Data_Kendaraan).
- R-01: Nomor WO dobel saat input bersamaan. Mitigasi: kolom unique + generate dalam transaction.
- R-02: Skor AJHI beda dari prototipe. Mitigasi: AC-03 membandingkan hasil kalkulator lama vs baru.

## 6. PROGRESS (Phase = 1 fokus, detail per file)

| Phase | File | Fokus | Status | Definition of Done |
|---|---|---|---|---|
| P1 | [phase-1-data-fondasi.md](phase-1-data-fondasi.md) | `vehicles`, `customer_code`, `alamat`, backfill | ✅ Selesai | `migrate:status` Ran; 3 customer berkode + 1 vehicle tiap customer |
| P2 | [phase-2-work-order.md](phase-2-work-order.md) | WO + nomor otomatis + job items + status + Policy | ⬜ Antre | AC-01, AC-02, AC-04 lolos |
| P3 | [phase-3-check-sheet.md](phase-3-check-sheet.md) | Check sheet + skor otomatis ke WO | ⬜ Antre | AC-03 lolos (skor = prototipe) |
| P4 | [phase-4-cetak-dan-qa.md](phase-4-cetak-dan-qa.md) | Cetak WO + regresi portal + QA | ⬜ Antre | AC-05 lolos; test hijau |
| P5 | [phase-5-invoice-kwitansi.md](phase-5-invoice-kwitansi.md) | Invoice + kwitansi (Later) | ⬜ Belum dijadwalkan | AC-05-01, AC-05-02 |
| P6 | [phase-6-passport-digital.md](phase-6-passport-digital.md) | Passport digital + loyalitas (Later) | ⬜ Belum dijadwalkan | AC-06-01, AC-06-02 |

Urutan task tiap phase: migration → model/relasi → validasi → policy/auth → UI Filament →
cetak → test → cleanup. Perintah mengacu ke yang ada di project
(`make:migration`, `make:model`, `make:filament-resource`, `make:test --phpunit`).

## 7. QA / TEST PLAN

1. TC-01 (AC-01): registrasi valid → customer + vehicle + WO tercipta, nomor sesuai format.
2. TC-02 (AC-02): plat duplikat → error di field plat, row count tetap.
3. TC-03 (AC-03): 13 item terisi → skor tersimpan = hasil `AjhiCalculator`.
4. TC-04 (AC-04): WO belum lengkap → tombol Selesai terkunci + daftar item kurang.
5. TC-05: teknisi membuka WO milik teknisi lain → 403.
6. TC-06 (AC-05): GET `/`, `/c/KT3MTR7X9A`, token salah → 200, 200, 404; tampilan tak berubah.
7. TC-07: simpan WO gagal di tengah (simulasi) → tidak ada data setengah jadi (transaction).

## 8. READINESS REVIEW

- Asumsi terkunci: nomor `WO-YYYY-NNNN` reset tahunan; harga ikut bundel invoice.
- Pertanyaan Klarifikasi: contoh `parameter_standar` per item sudah ada di sheet PM (dipakai P3).
- Risiko jadwal: P2–P4 masing-masing ± setengah hari; total tanpa invoice/passport.
- Keputusan: lanjut P2 setelah dokumen ini disetujui. Jangan mulai P3 sebelum P2 DoD terpenuhi.
