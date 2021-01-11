<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryRow extends Model
{
    use HasFactory;
    protected $fillable = [
        'value'
    ];
    public function entry()
    {
        return $this->belongsTo('App\Models\Entry');
    }
    public function dataInput()
    {
        return $this->belongsTo('App\Models\DataInput');
    }
}
