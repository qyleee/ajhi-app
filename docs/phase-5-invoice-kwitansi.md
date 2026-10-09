# Phase 5 — Invoice + Kwitansi (Later)

Status: ⬜ Belum dijadwalkan (dependensi: Phase 2–4 selesai)

## Tujuan
Gantikan kertas "Invoice Servis" dan "Kwitansi": harga jasa + sparepart, PPN opsional,
diskon, metode bayar (Tunai/Transfer/QRIS/Debit), garansi, dan cetak.

## Cakupan (rencana)
- Harga master jasa + harga part per WO (baru di phase ini WO menyimpan uang).
- Tabel `invoices`: nomor `INV-YYYY-NNNN`, subtotal jasa/part, diskon, PPN, grand total,
  terbilang, status bayar (Lunas/Belum Lunas), garansi pekerjaan 30 hari + sparepart 90 hari.
- Tabel `receipts` (kwitansi): nomor, tanggal, kasir, metode bayar, total.
- Cetak invoice + kwitansi mirip kertas.
- Peran kasir: user role `kasir` (tambahan dari 3 role sekarang) — keputusan saat mulai phase.

## AC (draft)
- AC-05-01: WO selesai → invoice terbit dengan total = jasa + part − diskon + PPN.
- AC-05-02: Bayar lunas → kwitansi terbit + status invoice Lunas; belum lunas → tidak ada kwitansi.
