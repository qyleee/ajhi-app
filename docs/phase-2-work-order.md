# Phase 2 — Work Order (WO)

Status: ⬜ Antre

## Tujuan
Gantikan kertas "Work Order / Perintah Kerja": WO bernomor otomatis,
prioritas servis, assignment pekerjaan per teknisi + status, sparepart yang diminta,
hasil diagnosis, estimasi, dan QC.

## Cakupan (must-have)
- Tabel `work_orders`: nomor unik `WO-YYYY-NNNN` (reset tiap tahun, generate dalam
  transaction), `vehicle_id`, `advisor` (service advisor), prioritas
  (Normal/Prioritas/Darurat), keluhan pelanggan (voice of customer),
  kondisi saat diterima, status WO (Baru/Dikerjakan/QC/Selesai), estimasi selesai.
- Tabel `work_order_items`: pekerjaan, estimasi waktu, `technician_id` (user),
  status (Belum/Proses/Selesai).
- Tabel `work_order_parts`: kode, nama sparepart, jumlah, status
  (Tersedia/Pesan/Dipasang), keterangan. Tanpa harga (harga ikut Phase 5).
- Filament `WorkOrderResource` + RelationManager items & parts.
- Policy: admin full; teknisi hanya WO yang memuat item miliknya (selain itu 403).
- Registrasi gabungan: form admin membuat customer + vehicle + WO sekaligus (AC-01).

## AC
- AC-01: Submit registrasi valid → 1 customer + 1 vehicle + 1 WO bernomor, redirect ke WO.
- AC-02: Plat duplikat → error di field plat, tidak ada baris baru.
- AC-04: WO tanpa check sheet lengkap → aksi "Selesai" terkunci + daftar item kurang.

## Tasks + DoD
1. Migration `work_orders`, `work_order_items`, `work_order_parts` → `migrate:status` Ran.
2. Model + relasi (WorkOrder, WorkOrderItem, WorkOrderPart) → tinker relasi jalan.
3. `WorkOrderNumber` generator (transaction + unique) → 2 WO bersamaan tidak dobel.
4. Filament Resource + RelationManager → CRUD `/staff` jalan.
5. `WorkOrderPolicy` → teknisi 403 ke WO orang lain (test).
6. Form registrasi gabungan → AC-01 & AC-02 lolos via feature test.

## QA
- TC-P2-01: 2 WO dibuat berurutan → nomor naik tanpa lompat/dobel.
- TC-P2-02: item status Belum→Proses→Selesai tercatat per teknisi.
- TC-P2-03: user tanpa login membuka `/staff` WO → redirect login.
