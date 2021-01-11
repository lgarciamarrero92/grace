<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use Illuminate\Support\Str;
class DataInput extends Model
{
    use Translatable;
    use HasFactory;
    protected $translatable = ['display_name']; 
    protected $appends = ['slug'];
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }
    public function entryRows()
    {
        return $this->hasMany('App\Models\EntryRow');
    }
    public function getSlugAttribute()
    { 
        return Str::slug($this->display_name,'_');   
    }
}
