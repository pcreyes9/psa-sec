<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Setting;

class Settings extends Component
{
    public $time_in;
    public $grace_period;
    public $time_out;

    public $night_diff_start;

    public $working_hours;

    public $weekday_ot_rate;
    public $weekend_ot_rate;
    public $night_diff_rate;

    public $vacation_leave;
    public $sick_leave;

    public $reg_holiday_rate;
    public $non_working_holiday_rate;

    public function mount()
    {
        $this->time_in = Setting::get(
            'official_time_in',
            '08:00'
        );

        $this->grace_period = Setting::get(
            'grace_period_time',
            '08:15'
        );

        $this->time_out = Setting::get(
            'official_time_out',
            '18:00'
        );

        $this->night_diff_start = Setting::get(
            'night_diff_start',
            '22:00'
        );

        $this->working_hours = Setting::get(
            'working_hours_per_day',
            10
        );

        $this->weekday_ot_rate = Setting::get(
            'weekday_ot_rate',
            125
        );

        $this->weekend_ot_rate = Setting::get(
            'weekend_ot_rate',
            130
        );

        $this->reg_holiday_rate = Setting::get(
            'reg_holiday_rate',
            125
        );

        $this->non_working_holiday_rate = Setting::get(
            'non_working_holiday_rate',
            130
        );

        $this->night_diff_rate = Setting::get(
            'night_diff_rate',
            10
        );

        $this->vacation_leave = Setting::get(
            'vacation_leaves',
            15
        );

        $this->sick_leave = Setting::get(
            'sick_leaves',
            15
        );
    }

    public function attendanceSettings()
    {
        $this->validate([
            'time_in' => 'required',
            'grace_period' => 'required',
            'time_out' => 'required',
            'night_diff_start' => 'required',

            'working_hours' => 'required|numeric|min:1',

            'weekday_ot_rate' => 'required|numeric|min:1',
            'weekend_ot_rate' => 'required|numeric|min:1',
            'night_diff_rate' => 'required|numeric|min:0',

            'reg_holiday_rate' => 'required|numeric|min:0',
            'non_working_holiday_rate' => 'required|numeric|min:0',

            'vacation_leave' => 'required|numeric|min:0',
            'sick_leave' => 'required|numeric|min:0'
        ]);

        Setting::set(
            'official_time_in',
            $this->time_in
        );

        Setting::set(
            'grace_period_time',
            $this->grace_period
        );

        Setting::set(
            'official_time_out',
            $this->time_out
        );

        Setting::set(
            'night_diff_start',
            $this->night_diff_start
        );

        Setting::set(
            'working_hours_per_day',
            $this->working_hours
        );

        Setting::set(
            'weekday_ot_rate',
            $this->weekday_ot_rate
        );

        Setting::set(
            'weekend_ot_rate',
            $this->weekend_ot_rate
        );

        Setting::set(
            'reg_holiday_rate',
            $this->reg_holiday_rate
        );

        Setting::set(
            'non_working_holiday_rate',
            $this->non_working_holiday_rate
        );

        Setting::set(
            'night_diff_rate',
            $this->night_diff_rate
        );

        Setting::set(
            'vacation_leaves',
            $this->vacation_leave
        );

        Setting::set(
            'sick_leaves',
            $this->sick_leave
        );

        $this->dispatch(
            'settings-saved'
        );

        session()->flash(
            'success',
            'Settings updated successfully.'
        );
    }

    public function render()
    {
        return view(
            'livewire.settings'
        );
    }
}