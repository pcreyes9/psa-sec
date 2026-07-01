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

        Setting::set('vacation_leaves', '15');
        Setting::set('sick_leaves', '15');

        Setting::set('reg_holiday_rate', '200');
        Setting::set('non_working_holiday_rate', '130');

        Setting::set('weekend_rate', '130');
        Setting::set('reg_holiday_ot_rate', '260');

        Setting::set('non_working_holiday_ot_rate', '169');

        Setting::set('weekday_nd_rate', '137.5');
        Setting::set('weekend_nd_rate', '185.9');

        Setting::set('special_holiday_nd_rate', '185.9');
        Setting::set('special_restday_nd_rate', '214.5');

        Setting::set('reg_holiday_nd_rate', '286');
        Setting::set('reg_holiday_restday_nd_rate', '371.8');
        

        
    }
}
