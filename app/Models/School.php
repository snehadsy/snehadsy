<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'state_xid',
        'district_xid',
        'city_xid',
        'established_at',
        'login_id',
        'password',
    ];

    protected $hidden = ['password']; // for security during API responses

    // Relationships
    public function state()
    {
        return $this->belongsTo(State::class, 'state_xid');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_xid');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_xid');
    }


    public function students()
    {
        return $this->hasMany(Student::class, 'school_xid');
    }
}