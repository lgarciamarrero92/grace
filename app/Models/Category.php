<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Baum\Node;
class Category extends Node
{
    use HasFactory;
    protected $fillable = [
        'title', 'order'
    ];
    public function dataRows()
    {
        return $this->belongsToMany('App\Models\DataRow');
    }
}
