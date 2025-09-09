<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'document_type',
        'document_number',
        'issue_date',
        'expiry_date',
        'file_path',
        'original_filename',
        'notes',
        'is_expired'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
        'is_expired' => 'boolean'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function workChecks()
    {
        return $this->hasMany(WorkCheck::class);
    }

    public function getIsExpiringAttribute()
    {
        if (!$this->expiry_date) {
            return false;
        }
        return $this->expiry_date <= now()->addDays(30);
    }

    public function getDaysUntilExpiryAttribute()
    {
        if (!$this->expiry_date) {
            return null;
        }
        return now()->diffInDays($this->expiry_date, false);
    }

    public function scopeExpiring($query, $days = 30)
    {
        return $query->whereNotNull('expiry_date')
            ->where('expiry_date', '<=', now()->addDays($days));
    }

    public function scopeExpired($query)
    {
        return $query->whereNotNull('expiry_date')
            ->where('expiry_date', '<', now());
    }
}
