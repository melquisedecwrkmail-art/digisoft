<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = ['user_id', 'service_id', 'description', 'status', 'assigned_to'];

    public function user() { return $this->belongsTo(User::class); }
    public function service() { return $this->belongsTo(Service::class); }
    public function assignedTo() { return $this->belongsTo(User::class, 'assigned_to'); }
}