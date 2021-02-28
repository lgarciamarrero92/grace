<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryUser extends Model
{
    use HasFactory;
    protected $table = 'entry_user';
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function entryRows()
    {
        return $this->hasMany('App\Models\EntryRow','entry_id','entry_id');
    }
}
