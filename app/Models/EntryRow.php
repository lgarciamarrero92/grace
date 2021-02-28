<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

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
    protected static function booted(){
        static::addGlobalScope('owns',function(Builder $builder){
            $builder->where('private',false)->orWhere('created_by',Auth::user()->id);
        });
    }
    public static function boot(){
        parent::boot();
        static::creating(function($model){
            $user_id = Auth::user()->id;
            $model->created_by = $user_id;
            $model->updated_by = $user_id;
        });
        static::updating(function($model){
            $user_id = Auth::user()->id;
            $model->updated_by = $user_id;
        });
    }
}
