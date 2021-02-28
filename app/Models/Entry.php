<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Entry extends Model
{
    use HasFactory;
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category','entry_user');
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
