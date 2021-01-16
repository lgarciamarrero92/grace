<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function entryRows()
    {
        return $this->hasMany('App\Models\EntryRow');
    }
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
