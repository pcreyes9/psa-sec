<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [

            [
                'name' => 'Mariale Cruz',
                'email' => 'mariale@example.com',
                'phone_number' => '09171234567',
                'department' => 'Secretary',
                'position' => 'Executive Secretary',
                'monthly_salary' => 34466.18,
                'hiring_date' => '2026-05-01',
                'sss_no' => '000000000-0',
                'philhealth_no' => '000000000-0',
                'tin_no' => '000000000-0',
                'pagibig_no' => '000000000-0',
                'status' => 'Active',
            ],

            [
                'name' => 'Marsha Moreno',
                'email' => 'marsha@example.com',
                'phone_number' => '09181234567',
                'department' => 'Secretary',
                'position' => 'Membership Secretary',
                'monthly_salary' => 30078.12,
                'hiring_date' => '2026-05-01',
                'sss_no' => '000000000-0',
                'philhealth_no' => '000000000-0',
                'tin_no' => '000000000-0',
                'pagibig_no' => '000000000-0',
                'status' => 'Active',
            ],

            [
                'name' => 'Abigail Alto',
                'email' => 'abigail@example.com',
                'phone_number' => '09991234567',
                'department' => 'Secretary',
                'position' => 'CME Secretary',
                'monthly_salary' => 19793.3,
                'hiring_date' => '2026-05-01',
                'sss_no' => '000000000-0',
                'philhealth_no' => '000000000-0',
                'tin_no' => '000000000-0',
                'pagibig_no' => '000000000-0',
                'status' => 'Active',
            ],

            [
                'name' => 'Christine Catalla',
                'email' => 'christine@example.com',
                'phone_number' => '09175551234',
                'department' => 'Secretary',
                'position' => 'Publication Secretary',
                'monthly_salary' => 21035,
                'hiring_date' => '2026-05-01',
                'sss_no' => '000000000-0',
                'philhealth_no' => '000000000-0',
                'tin_no' => '000000000-0',
                'pagibig_no' => '000000000-0',
                'status' => 'Active',
            ],

            [
                'name' => 'Abe Gabrillo',
                'email' => 'abe@example.com',
                'phone_number' => '09178889999',
                'department' => 'Liaison',
                'position' => 'Liaison Officer',
                'monthly_salary' => 24615.18,
                'hiring_date' => '2026-05-01',
                'sss_no' => '000000000-0',
                'philhealth_no' => '000000000-0',
                'tin_no' => '000000000-0',
                'pagibig_no' => '000000000-0',
                'status' => 'Active',
            ],

            [
                'name' => 'Paul Reyes',
                'email' => 'paul@example.com',
                'phone_number' => '09178889999',
                'department' => 'Information Technology',
                'position' => 'IT Specialist',
                'monthly_salary' => 23793.3,
                'hiring_date' => '2026-05-01',
                'sss_no' => '000000000-0',
                'philhealth_no' => '000000000-0',
                'tin_no' => '000000000-0',
                'pagibig_no' => '000000000-0',
                'status' => 'Active',
            ],
        ];

        foreach ($employees as $data) {
            Employee::create($data);
        }
    }
}