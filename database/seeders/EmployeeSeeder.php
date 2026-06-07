<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            [
                'name' => 'Chika Yunita Bahri',
                'nik' => 'EMP001',
                'department' => 'IT',
                'position' => 'Manager',
                'status' => 'aktif',
                'joined_at' => '2024-01-10',
            ],
            [
                'name' => 'Andi Saputra',
                'nik' => 'EMP002',
                'department' => 'HRD',
                'position' => 'Staff HR',
                'status' => 'aktif',
                'joined_at' => '2024-02-15',
            ],
            [
                'name' => 'Budi Santoso',
                'nik' => 'EMP003',
                'department' => 'Finance',
                'position' => 'Accountant',
                'status' => 'nonaktif',
                'joined_at' => '2023-11-05',
            ],
            [
                'name' => 'Dewi Lestari',
                'nik' => 'EMP004',
                'department' => 'Marketing',
                'position' => 'Marketing Specialist',
                'status' => 'aktif',
                'joined_at' => '2024-03-20',
            ],
            [
                'name' => 'Rizky Pratama',
                'nik' => 'EMP005',
                'department' => 'IT',
                'position' => 'Backend Developer',
                'status' => 'aktif',
                'joined_at' => '2024-04-01',
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}