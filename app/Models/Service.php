<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'category', 'description', 'base_price', 'status'];

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }
}