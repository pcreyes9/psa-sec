<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id',
        'attendance_date',
        'time_in',
        'time_out',
        'status',
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'time_in' => 'datetime',
        'time_out' => 'datetime',
    ];

    protected static function booted()
    {
        static::saving(function ($attendance) {

            if ($attendance->time_in && $attendance->time_out) {

                $minutes = $attendance->time_in->diffInMinutes($attendance->time_out);

                $minutes -= 60; // lunch break

                $hours = max($minutes / 60, 0);

                $attendance->total_hours = round($hours, 2);

                $attendance->overtime_hours = round(max($hours - 8, 0), 2);
            }
        });
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}