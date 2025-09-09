<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'document_id',
        'work_check_id',
        'type',
        'title',
        'message',
        'is_read',
        'is_sent',
        'scheduled_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_sent' => 'boolean',
        'scheduled_at' => 'datetime'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function workCheck()
    {
        return $this->belongsTo(WorkCheck::class);
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopePending($query)
    {
        return $query->where('is_sent', false);
    }

    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

    public function markAsSent()
    {
        $this->update(['is_sent' => true]);
    }
}
