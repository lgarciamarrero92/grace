<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
class DataInput extends Model
{
    use Translatable;
    use HasFactory;
    protected $translatable = ['display_name']; 
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }
}
