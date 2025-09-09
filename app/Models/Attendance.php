<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'date',
        'check_in',
        'check_out',
        'total_hours',
        'status',
        'remarks'
    ];

    protected $casts = [
        'date' => 'date',
        'check_in' => 'datetime:H:i',
        'check_out' => 'datetime:H:i'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function calculateTotalHours()
    {
        if ($this->check_in && $this->check_out) {
            $checkIn = \Carbon\Carbon::parse($this->check_in);
            $checkOut = \Carbon\Carbon::parse($this->check_out);

            if ($checkOut->lessThan($checkIn)) {
                return;
            }

            $this->total_hours = $checkIn->diffInMinutes($checkOut); // store as minutes
            $this->save();
        }
    }

    public function getTotalHoursFormattedAttribute()
    {
        if ($this->total_hours) {
            $hours = floor($this->total_hours / 60);
            $minutes = $this->total_hours % 60;
            return sprintf('%02d:%02d', $hours, $minutes);
        }

        return '00:00';
    }
}
