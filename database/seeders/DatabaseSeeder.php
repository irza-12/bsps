<?php

namespace Database\Seeders;

use App\Models\Bsps;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin user
        User::firstOrCreate(
            ['email' => 'admin@bsps.desa.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Create default operator user
        User::firstOrCreate(
            ['email' => 'operator@bsps.desa.id'],
            [
                'name' => 'Operator',
                'password' => Hash::make('operator123'),
                'role' => 'operator',
            ]
        );

        // Real Data from Image (Tahun 2026)
        $realData = [
            [
                'nama' => 'ANI',
                'no_kk' => '1506042702140002',
                'nik' => '1506041401880001',
                'alamat' => 'Dusun Simpang Abadi RT.007',
                'dusun' => 'Simpang Abadi',
                'rt' => '007',
                'tahun' => 2026,
            ],
            [
                'nama' => 'SANIYAH',
                'no_kk' => '1506041002100002',
                'nik' => '1506044107740025',
                'alamat' => 'Dusun Simpang Abadi RT.007',
                'dusun' => 'Simpang Abadi',
                'rt' => '007',
                'tahun' => 2026,
            ],
            [
                'nama' => 'SITI RAHMAH',
                'no_kk' => '1506041801180008',
                'nik' => '1507094108840001',
                'alamat' => 'Dusun Simpang Abadi RT.007',
                'dusun' => 'Simpang Abadi',
                'rt' => '007',
                'tahun' => 2026,
            ],
            [
                'nama' => 'SITI AMINAH',
                'no_kk' => '1506040503087374',
                'nik' => '1506046006810002',
                'alamat' => 'Dusun Simpang Abadi RT.007',
                'dusun' => 'Simpang Abadi',
                'rt' => '007',
                'tahun' => 2026,
            ],
            [
                'nama' => 'M. NASIR',
                'no_kk' => '1506040604110011',
                'nik' => '1506040309660001',
                'alamat' => 'Dusun Simpang Abadi RT.006',
                'dusun' => 'Simpang Abadi',
                'rt' => '006',
                'tahun' => 2026,
            ],
            [
                'nama' => 'HARYONO',
                'no_kk' => '1506041108100001',
                'nik' => '1506040911770001',
                'alamat' => 'Dusun Simpang Abadi RT.007',
                'dusun' => 'Simpang Abadi',
                'rt' => '007',
                'tahun' => 2026,
            ],
            [
                'nama' => 'MILIN',
                'no_kk' => '1506042102250001',
                'nik' => '3501054110840003',
                'alamat' => 'Dusun Simpang Abadi RT.007',
                'dusun' => 'Simpang Abadi',
                'rt' => '007',
                'tahun' => 2026,
            ],
            [
                'nama' => 'JUMRIYANI',
                'no_kk' => '1506041203210003',
                'nik' => '1506045601910002',
                'alamat' => 'Dusun Simpang Abadi RT.006',
                'dusun' => 'Simpang Abadi',
                'rt' => '006',
                'tahun' => 2026,
            ],
            [
                'nama' => 'TAMRIN',
                'no_kk' => '1505052001150014',
                'nik' => '1505010907440001',
                'alamat' => 'Dusun Terjun Gajah RT.004',
                'dusun' => 'Terjun Gajah',
                'rt' => '004',
                'tahun' => 2026,
            ],
            [
                'nama' => 'ABU KHAIRI',
                'no_kk' => '1506041201160006',
                'nik' => '1506040606880002',
                'alamat' => 'Dusun Simpang Abadi RT.006',
                'dusun' => 'Simpang Abadi',
                'rt' => '006',
                'tahun' => 2026,
            ],
        ];

        foreach ($realData as $data) {
            Bsps::create($data);
        }
    }
}
