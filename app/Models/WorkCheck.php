<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkCheck extends Model
{
    /** @use HasFactory<\Database\Factories\WorkCheckFactory> */
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'check_date',
        'document_id',
        'checked_by',
        'expiry_date',
        'notes'
    ];

    protected $casts = [
        'check_date' => 'date',
        'expiry_date' => 'date'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function isExpiring(): bool
    {
        return $this->expiry_date <= now()->addDays(30);
    }

    public function getDaysUntilExpiryAttribute(): int
    {
        return now()->diffInDays($this->expiry_date, false);
    }
}
