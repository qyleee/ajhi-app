<?php

return [
    /*
    |--------------------------------------------------------------------------
    | AJHI Checklist Master (porting CHECKLIST index.html:181-195)
    |--------------------------------------------------------------------------
    */
    'checklist' => [
        ['id' => 'ITM-001', 'name' => 'Odometer / Jarak Tempuh', 'level' => 'Major', 'weight' => 5, 'rec' => 'Lakukan servis berkala sesuai anjuran km.'],
        ['id' => 'ITM-002', 'name' => 'Indikator Bahan Bakar', 'level' => 'Minor', 'weight' => 3, 'rec' => 'Isi bahan bakar sebelum batas minimal E.'],
        ['id' => 'ITM-003', 'name' => 'Selang Bahan Bakar', 'level' => 'Critical', 'weight' => 7, 'rec' => 'Ganti selang bahan bakar yang retak/bocor.'],
        ['id' => 'ITM-004', 'name' => 'Ban Depan (Tekanan & Tapak)', 'level' => 'Critical', 'weight' => 10, 'rec' => 'Tambah tekanan angin atau ganti ban depan jika aus.'],
        ['id' => 'ITM-005', 'name' => 'Ban Belakang (Tekanan & Tapak)', 'level' => 'Critical', 'weight' => 10, 'rec' => 'Periksa tekanan angin ban belakang dan batas kembangan.'],
        ['id' => 'ITM-006', 'name' => 'Komstir / Steering Head', 'level' => 'Critical', 'weight' => 10, 'rec' => 'Setel ulang kekencangan komstir atau ganti bearing.'],
        ['id' => 'ITM-007', 'name' => 'Rantai Roda & Gear', 'level' => 'Major', 'weight' => 8, 'rec' => 'Setel kekencangan rantai dan berikan pelumas.'],
        ['id' => 'ITM-008', 'name' => 'Rem Depan (Cakram)', 'level' => 'Critical', 'weight' => 12, 'rec' => 'Ganti kampas rem depan atau kuras minyak rem.'],
        ['id' => 'ITM-009', 'name' => 'Rem Belakang (Tromol)', 'level' => 'Critical', 'weight' => 10, 'rec' => 'Setel jarak main pedal atau ganti kampas rem tromol.'],
        ['id' => 'ITM-010', 'name' => 'Oli Mesin (Volume & Warna)', 'level' => 'Critical', 'weight' => 12, 'rec' => 'Ganti oli mesin baru untuk mencegah gesekan kasar.'],
        ['id' => 'ITM-011', 'name' => 'Lampu Rem (Stop Lamp)', 'level' => 'Critical', 'weight' => 8, 'rec' => 'Periksa saklar rem atau ganti bohlam lampu rem segera!'],
        ['id' => 'ITM-012', 'name' => 'Lampu Utama & Lampu Sein', 'level' => 'Major', 'weight' => 5, 'rec' => 'Perbaiki fitting atau ganti lampu yang putus.'],
        ['id' => 'ITM-013', 'name' => 'Aki / Tegangan Baterai', 'level' => 'Major', 'weight' => 5, 'rec' => 'Lakukan charge aki atau ganti jika voltase di bawah 12.4V.'],
    ],

    'settings' => [
        'interval_days' => 30,
        'lead_days' => 2,
    ],

    /*
    |--------------------------------------------------------------------------
    | Data dummy tahap UI statis (meniru seed() index.html:1951-1991)
    | Nanti diganti query Eloquent setelah migrasi DB.
    |--------------------------------------------------------------------------
    */
    'dummy_customers' => [
        ['id' => 'C-001', 'token' => 'KT3MTR7X9A', 'name' => 'Budi Santoso', 'wa' => '6281234567890', 'plate' => 'KT 1234 ABC', 'model' => 'Honda Vario 125'],
        ['id' => 'C-002', 'token' => 'NMAXQ2PL8B', 'name' => 'Siti Aminah', 'wa' => '6289876543210', 'plate' => 'KT 5678 DEF', 'model' => 'Yamaha NMAX 155'],
        ['id' => 'C-003', 'token' => 'SATRIA5KM7', 'name' => 'Rudi Hartono', 'wa' => '6281112223334', 'plate' => 'KT 9012 GHI', 'model' => 'Suzuki Satria F150'],
    ],

    'dummy_logs' => [
        ['id' => 'L-001', 'customer_id' => 'C-001', 'tech' => 'Andi Wijaya', 'date' => '2026-06-12', 'odo' => 12000, 'score' => 96, 'risk' => 'NORMAL', 'status' => 'Sehat / Optimal', 'note' => 'Servis rutin 12.000 KM'],
        ['id' => 'L-002', 'customer_id' => 'C-001', 'tech' => 'Andi Wijaya', 'date' => '2026-08-20', 'odo' => 15200, 'score' => 92, 'risk' => 'NORMAL', 'status' => 'Sehat / Optimal', 'note' => 'Ganti oli & setel rantai'],
        ['id' => 'L-003', 'customer_id' => 'C-001', 'tech' => 'Rizky Pratama', 'date' => '2026-10-05', 'odo' => 18500, 'score' => 78, 'risk' => 'PRIORITAS KESELAMATAN', 'status' => 'PERLU PERBAIKAN SEGERA', 'note' => 'Lampu rem mati, diganti saklar'],
        ['id' => 'L-004', 'customer_id' => 'C-002', 'tech' => 'Andi Wijaya', 'date' => '2026-09-11', 'odo' => 9400, 'score' => 90, 'risk' => 'PERHATIAN', 'status' => 'Perlu Perawatan Berkala', 'note' => 'Ban depan mulai tipis'],
        ['id' => 'L-005', 'customer_id' => 'C-003', 'tech' => 'Rizky Pratama', 'date' => '2026-09-28', 'odo' => 22100, 'score' => 82, 'risk' => 'PRIORITAS KESELAMATAN', 'status' => 'PERLU PERBAIKAN SEGERA', 'note' => 'Rem depan blong, kampas diganti'],
    ],
];
