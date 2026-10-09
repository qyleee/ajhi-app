# Phase 6 — Service Passport Digital (Later)

Status: ⬜ Belum dijadwalkan (dependensi: Phase 2–4 selesai)

## Tujuan
Gantikan "buku" Service Passport kertas: identitas + QR customer, riwayat servis,
grafik AJHI, riwayat oli/sparepart/perbaikan besar, jadwal servis berikut,
dan loyalitas (servis ke-5 gratis cuci motor, ke-10 pemeriksaan gratis, ke-15 diskon jasa).

## Cakupan (rencana)
- Portal customer (`/c/{token}`) diperkaya: kartu identitas + QR, tabel riwayat
  (tanggal, KM, jenis, WO, teknisi, skor), gauge AJHI + bar per sistem,
  riwayat oli / sparepart / perbaikan besar, timeline rekomendasi KM
  (1000–21000), cap loyalitas otomatis per hitungan kunjungan.
- Tampilan portal existing dipertahankan gayanya; hanya tambah blok baru.
- QR customer: tetap token yang sama (tidak ganti kartu yang sudah dicetak).

## AC (draft)
- AC-06-01: Customer dengan 5 kunjungan → badge "Gratis Cuci Motor" muncul otomatis.
- AC-06-02: QR lama (token existing) tetap valid dan membuka passport baru.
