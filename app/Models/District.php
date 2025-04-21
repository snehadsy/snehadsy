<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'state_xid',
    ];

    // Relationships
    public function state()
    {
        return $this->belongsTo(State::class, 'state_xid');
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function schools()
    {
        return $this->hasMany(School::class, 'district_xid');
    }
}