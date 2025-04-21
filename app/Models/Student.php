<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'school_xid',
        'name',
        'standard_xid',
        'gender',
        'contact',
        'year',
        'image',
        'deleted',
    ];

    protected $casts = [
        'deleted' => 'boolean',
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_xid');
    }

    public function standard()
    {
        return $this->belongsTo(Standard::class, 'standard_xid');
    }
}
