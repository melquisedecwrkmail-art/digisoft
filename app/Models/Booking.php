<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'workspace_id', 'start_date', 'end_date',
        'total_price', 'payment_status', 'booking_status'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function workspace() { return $this->belongsTo(Workspace::class); }
}