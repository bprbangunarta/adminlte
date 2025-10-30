<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Administrator'],
            ['name' => 'Komisaris Utama'],
            ['name' => 'Komisaris'],
            ['name' => 'Direktur Utama'],
            ['name' => 'Direktur Kepatuhan'],
            ['name' => 'Direktur Bisnis'],
            ['name' => 'Direktur Operasional'],
            ['name' => 'Kepala Kantor Kas'],
            ['name' => 'Kepala Seksi Customer Care'],
            ['name' => 'Kepala Bagian Kepatuhan'],
            ['name' => 'Kepala Bagian Kredit'],
            ['name' => 'Kepala Seksi Kredit'],
            ['name' => 'Kepala Seksi Remedial'],
            ['name' => 'Kepala Seksi Umum'],
            ['name' => 'AO Kredit'],
            ['name' => 'Kepala Seksi Dana'],
            ['name' => 'AO Dana'],
            ['name' => 'Customer Care'],
            ['name' => 'Staff Umum'],
            ['name' => 'Kepala Bagian Operasional'],
            ['name' => 'Kepala Bagian Analis'],
            ['name' => 'Kepala Seksi Pelaporan'],
            ['name' => 'Staff Legal'],
            ['name' => 'Kepala Seksi Analis'],
            ['name' => 'Kepala Bagian Audit Internal'],
            ['name' => 'Kepala Seksi SDM'],
            ['name' => 'Kepala Seksi Administrasi Kredit'],
            ['name' => 'Kepala Bagian Teknologi Informasi'],
            ['name' => 'Staff Sistem & Jaringan'],
            ['name' => 'Customer Service'],
            ['name' => 'Kepala Bagian SDM & Umum'],
            ['name' => 'Staff Remedial'],
            ['name' => 'Kepala Bagian Pendanaan'],
            ['name' => 'Akunting'],
            ['name' => 'Staff SDM'],
            ['name' => 'Staff Analis & Appraisal'],
            ['name' => 'Marketing Deposito'],
            ['name' => 'Staff Web Development'],
            ['name' => 'Staff Kepatuhan'],
            ['name' => 'Staff Audit Internal'],
            ['name' => 'Staff Administrasi Kredit'],
            ['name' => 'Teller'],
            ['name' => 'Kepala Seksi Frontliner'],
            ['name' => 'Staff Teknologi Informasi']
        ];

        foreach ($roles as $role) {
            \Spatie\Permission\Models\Role::create($role);
        }
    }
}
