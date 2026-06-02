<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;


class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::set('official_time_in', '08:00');
        Setting::set('grace_period_time', '08:15');
        Setting::set('official_time_out', '18:00');

        Setting::set('night_diff_start', '22:00');

        Setting::set('weekday_ot_rate', '1.25');
        Setting::set('weekend_ot_rate', '1.30');

        Setting::set('night_diff_rate', '0.10');

        Setting::set('working_hours_per_day', '10');
    }
}
