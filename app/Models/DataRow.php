<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRow extends Model
{
    use HasFactory;

    protected $fillable = [
        'display_name', 'data_type', 'is_multiple', 'order'
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }
}
