# Phase 1 — Data Fondasi (Pelanggan + Kendaraan)

Status: ✅ Selesai (09 Okt 2026)

## Tujuan
Bikin fondasi data sesuai spec PM: 1 customer bisa punya banyak kendaraan,
customer berkode `CUST-XXXX`, kendaraan berkode `VEH-XXXX`.

## Cakupan
- Kolom baru `customers`: `customer_code` unik, `alamat` nullable.
- Tabel baru `vehicles`: `vehicle_code` unik, `customer_id` FK cascade, `plate` unik,
  `brand_model`, `year`, `capacity_cc`, `odometer` (nullable).
- Relasi: `Customer hasMany Vehicle`, `Vehicle belongsTo Customer`.
- Backfill: 3 customer lama → `CUST-0001..0003`, masing-masing 1 vehicle dari plat/model lama.
- `CredentialSeeder` diperbarui (idempotent via `updateOrCreate`).

## AC
- AC-P1-01: `migrate:status` menunjukkan kedua migration Ran.
- AC-P1-02: Tinker — tiap customer punya `customer_code` + tepat 1 vehicle berplat sama.
- AC-P1-03: `CredentialSeeder` bisa dijalankan ulang tanpa dobel data.
- AC-P1-04 (regresi): GET `/`, `/c/{token}` tetap 200; token salah 404; tampilan tak berubah.

## QA
- TC-P1-01: insert vehicle plat duplikat → ditolak unique constraint.
- TC-P1-02: hapus customer → vehicle ikut terhapus (cascade).
- TC-P1-03: `php artisan test` hijau.

## Hasil
Migration `2026_10_09_150843` + `2026_10_09_150844` Ran; 3 customer + 3 vehicle terisi;
test 2/2 passed; portal 200.
