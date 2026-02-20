<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'phone'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isStaff(): bool { return $this->role === 'staff'; }
    public function isClient(): bool { return $this->role === 'client'; }

    public function bookings() { return $this->hasMany(Booking::class); }
    public function serviceRequests() { return $this->hasMany(ServiceRequest::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }
}