<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\EntryRow;
use App\Models\Entry;
use Inertia\Inertia;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
       $entries = Auth::user()->entries()->with('category','entryRows.dataInput')->get();
       return ($entries);
    }

    public function create($category_id = null){

        $categories = $this->categories();
        if(!$category_id){
            return Inertia::render('Entries/Create',['categories' => $categories]);
        }
        $category = Category::where('id',$category_id)->first();
        $inputs = Category::findOrFail($category_id)->dataInputs()->get();

        return Inertia::render('Entries/Create',['categories' => $categories,'category' => $category,'inputs' => $inputs]);
    }

    public function edit($entry_id){
        $entry = Entry::where('id',$entry_id)->firstOrFail();
        $category = Category::where('id',$entry->category_id)->firstOrFail();

        $inputs = $category->dataInputs()->with(['entryRows' => function ($query) use ($entry_id) {
            $query->where('entry_id', $entry_id);
        }])->get();

        return Inertia::render('Entries/Edit',['entry' => $entry,'category' => $category,'inputs' => $inputs]);
    }

    public function store(Request $request){

        $category_id = $request->has('category_id') ? $request['category_id'] : -1;
        $inputs = Category::findOrFail($category_id)->dataInputs()->get();
        //Create validation rules
        $validation_rules = [];
        foreach ($inputs as $key => $input) {
            $details = json_decode($input->details);
            if(isset($details->validation->rule))
                $validation_rules[$input->slug] = $details->validation->rule;
        }
        //Validate
        request()->validate($validation_rules);
        //Save entry and entry rows
        $entry = new Entry();
        $entry->category_id = $category_id;
        $entry->save();
        foreach ($inputs as $key => $input) {
           if(!$request[$input->slug])continue;
           if(is_array($request[$input->slug])){
                // Handle arrays
               foreach($request[$input->slug] as $_input){
                    $entryRow = new EntryRow();
                    $entryRow->value = $_input;
                    $entryRow->data_input_id = $input->id;
                    $entryRow->entry()->associate($entry);
                    $entryRow->save();
               }
               continue;
           }
           $entryRow = new EntryRow();
           $entryRow->value = $request[$input->slug];
           $entryRow->data_input_id = $input->id;
           $entryRow->entry()->associate($entry);
           $entryRow->save();
        }
        //Associate entry to users
        $entry->users()->saveMany([Auth::user()]);
        //Redirect to same page
        return redirect()->back();
    }

    public function update(Request $request,$entry_id){
        $category_id = $request->has('category_id') ? $request['category_id'] : -1;
        $inputs = Category::findOrFail($category_id)->dataInputs()->get();
        //Create validation rules
        $validation_rules = [];
        foreach ($inputs as $key => $input) {
            $details = json_decode($input->details);
            if(isset($details->validation->rule))
                $validation_rules[$input->slug] = $details->validation->rule;
        }
        //Validate
        request()->validate($validation_rules);
        //Update entry rows
        $entry = Entry::where('id',$entry_id)->first();
        foreach ($inputs as $key => $input) {
           $entry->entryRows()->where('data_input_id',$input->id)->delete();
           if(!$request[$input->slug])continue;
           if(is_array($request[$input->slug])){
                // Handle arrays
                foreach($request[$input->slug] as $_input){
                    if(gettype($_input) == 'object'){
                        $filename = time() . $_input->getClientOriginalName();

                        $_input->storeAs('public/documents', $filename);

                        $entryRow = new EntryRow();
                        $entryRow->value = $filename;
                        $entryRow->data_input_id = $input->id;
                        $entryRow->entry()->associate($entry);
                        $entryRow->save();
                        continue;
                    }

                    $entryRow = new EntryRow();
                    $entryRow->value = $_input;
                    $entryRow->data_input_id = $input->id;
                    $entryRow->entry()->associate($entry);
                    $entryRow->save();
                }
                continue;
            }
           $entryRow = new EntryRow();
           $entryRow->value = $request[$input->slug];
           $entryRow->data_input_id = $input->id;
           $entryRow->entry()->associate($entry);
           $entryRow->save();
        }
        //Update updated_at timestamps in entry
        $entry->touch();
        //Redirect to same page
        return redirect()->back();
    }

    public function delete($entry_id){
        $entry = Entry::where('id',$entry_id)->firstOrFail();
        $entry->entryRows()->delete();
        $entry->users()->detach();
        $entry->delete();
        return redirect()->back();
    }

    public function categories($category = null){
        if(!$category){
            $tree = [];
            $roots = Category::roots()->get();
            foreach ($roots as $key => $root) {
                $subtree = $this->categories($root);
                $tree[] = $subtree;
            }
            return $tree;
        }
        $children = $category->children()->get();
        $children_data = [];
        foreach($children as $child){
            $items = $this->categories($child);
            $children_data[] = $items;
        }
        return ['id' => $category->id, 'name'=>$category->title, 'children' => $children_data];
    }
}
