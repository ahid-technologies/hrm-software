<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Staff extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'employee_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'ni_number',
        'utr_number',
        'date_of_birth',
        'address',
        'position',
        'department',
        'joining_date',
        'status',
        'basic_salary'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'joining_date' => 'date',
        'basic_salary' => 'decimal:2'
    ];

    public function toSearchableArray()
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function workChecks()
    {
        return $this->hasMany(WorkCheck::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getExpiringDocumentsAttribute()
    {
        return $this->documents()
            ->whereNotNull('expiry_date')
            ->where('expiry_date', '<=', now()->addDays(30))
            ->get();
    }

    public function isActive()
    {
        return $this->status == 'active';
    }
}
