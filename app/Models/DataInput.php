<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use Illuminate\Support\Str;
use App\Models\Category;
use Auth;

class DataInput extends Model
{
    use Translatable;
    use HasFactory;
    protected $translatable = ['display_name']; 
    protected $appends = ['slug','default'];

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
    public function getDefaultAttribute()
    { 
        $details = json_decode($this->details);
        if(isset($details->default)){
            return $details->default;
        }
        if(isset($details->show_auth_user_as_default_with_category)){
            $category_id = isset($this->pivot->category_id)?$this->pivot->category_id:null;
            if(!$category_id)return null;
            $category_identifier = Category::findOrFail($category_id)->identifier;
            if($details->show_auth_user_as_default_with_category == $category_identifier){
                return $this->multiple?[Auth::user()->name]:Auth::user()->name;
            }
        }
        return null;   
    }
}
