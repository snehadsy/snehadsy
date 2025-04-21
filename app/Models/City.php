<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'district_xid',
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_xid');
    }

    public function schools()
    {
        return $this->hasMany(School::class, 'city_xid');
    }
}
