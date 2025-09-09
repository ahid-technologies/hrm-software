<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\Attendance;
use App\Models\Document;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class HRSeeder extends Seeder
{
    public function run()
    {
        // Create sample staff
        $staff = [
            [
                'employee_id' => 'EMP001',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@company.com',
                'phone' => '+44-123-456-7890',
                'position' => 'Software Developer',
                'department' => 'IT',
                'joining_date' => now()->subYear(),
                'basic_salary' => 50000.00,
                'status' => 'active'
            ],
            [
                'employee_id' => 'EMP002',
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@company.com',
                'phone' => '+44-123-456-7891',
                'position' => 'HR Manager',
                'department' => 'HR',
                'joining_date' => now()->subMonths(6),
                'basic_salary' => 45000.00,
                'status' => 'active'
            ],
        ];

        foreach ($staff as $member) {
            $staffMember = Staff::create($member);

            // Create sample documents
            Document::create([
                'staff_id' => $staffMember->id,
                'document_type' => 'passport',
                'document_number' => 'P' . rand(1000000, 9999999),
                'issue_date' => now()->subYears(2),
                'expiry_date' => now()->addYears(3),
            ]);

            Document::create([
                'staff_id' => $staffMember->id,
                'document_type' => 'visa',
                'document_number' => 'V' . rand(1000000, 9999999),
                'issue_date' => now()->subYear(),
                'expiry_date' => now()->addMonths(6), // Expiring soon for demo
            ]);

            // Create sample attendance for last 10 days
            for ($i = 9; $i >= 0; $i--) {
                Attendance::create([
                    'staff_id' => $staffMember->id,
                    'date' => now()->subDays($i),
                    'check_in' => now()->subDays($i)->setTime(9, rand(0, 30)),
                    'check_out' => now()->subDays($i)->setTime(17, rand(0, 59)),
                    'status' => $i == 0 ? 'present' : (rand(1, 10) > 8 ? 'late' : 'present'),
                    'total_hours' => 8 * 60 + rand(-30, 30), // ~8 hours in minutes
                ]);
            }
        }

        $this->command->info('HR sample data created successfully!');
    }
}
