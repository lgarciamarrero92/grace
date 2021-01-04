<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use Baum\Node;
class Category extends Node
{
    use HasFactory;
    use Translatable;
    protected $translatable = ['title']; 
    protected $fillable = [
        'title'
    ];
    protected $orderColumn = 'order';
    public function dataInputs()
    {
        return $this->belongsToMany('App\Models\DataInput');
    }
}
