<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Inertia\Inertia;

class EntryController extends Controller
{
    public function create($category_id){
        $inputs = Category::findOrFail($category_id)->dataInputs()->get();
        return Inertia::render('Entries/Create',['inputs' => $inputs]);
    }
}
