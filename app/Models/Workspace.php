<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    protected $fillable = ['location_id', 'name', 'type', 'description', 'price', 'capacity', 'status'];

    public function location() { return $this->belongsTo(Location::class); }
    public function bookings() { return $this->hasMany(Booking::class); }
}