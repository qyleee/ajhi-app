<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class CredentialSeeder extends Seeder
{
    /**
     * Kredensial tiap role — sama seperti demo prototype/index.html.
     * Staff login via /staff (email + password).
     * Customer login via token QR (/c/{token}, tanpa password).
     */
    public function run(): void
    {
        $staff = [
            ['name' => 'Admin Auto Jats', 'email' => 'admin@autojats.test', 'password' => 'admin123', 'role' => 'admin'],
            ['name' => 'Andi Wijaya', 'email' => 'teknisi@autojats.test', 'password' => 'teknisi123', 'role' => 'teknisi'],
            ['name' => 'Rizky Pratama', 'email' => 'teknisi2@autojats.test', 'password' => 'teknisi123', 'role' => 'teknisi'],
        ];

        foreach ($staff as $row) {
            User::updateOrCreate(['email' => $row['email']], $row);
        }

        $customers = [
            ['customer_code' => 'CUST-0001', 'token' => 'KT3MTR7X9A', 'name' => 'Budi Santoso', 'wa' => '6281234567890', 'plate' => 'KT 1234 ABC', 'model' => 'Honda Vario 125', 'vehicle_code' => 'VEH-0001'],
            ['customer_code' => 'CUST-0002', 'token' => 'NMAXQ2PL8B', 'name' => 'Siti Aminah', 'wa' => '6289876543210', 'plate' => 'KT 5678 DEF', 'model' => 'Yamaha NMAX 155', 'vehicle_code' => 'VEH-0002'],
            ['customer_code' => 'CUST-0003', 'token' => 'SATRIA5KM7', 'name' => 'Rudi Hartono', 'wa' => '6281112223334', 'plate' => 'KT 9012 GHI', 'model' => 'Suzuki Satria F150', 'vehicle_code' => 'VEH-0003'],
        ];

        foreach ($customers as $row) {
            $customer = Customer::updateOrCreate(
                ['token' => $row['token']],
                collect($row)->except('vehicle_code')->all()
            );
            Vehicle::updateOrCreate(
                ['plate' => $row['plate']],
                ['vehicle_code' => $row['vehicle_code'], 'customer_id' => $customer->id, 'brand_model' => $row['model']]
            );
        }
    }
}
