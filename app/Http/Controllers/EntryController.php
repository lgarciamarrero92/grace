<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\EntryRow;
use App\Models\EntryUser;
use App\Models\Entry;
use App\Models\User;
use DB;
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
        $entries = EntryUser::where('user_id',Auth::user()->id)->with('category','entryRows.dataInput')->get();
        return ($entries);
    }

    public function create($category_id = null){

        $categories = $this->categories();
        if(!$category_id){
            return Inertia::render('Entries/Create',['categories' => $categories]);
        }
        $category = Category::findOrFail($category_id);
        $inputs = $category->dataInputs()->get();
        
        return Inertia::render('Entries/Create',['categories' => $categories,'category' => $category,'inputs' => $inputs]);
    }

    public function edit($entry_id, Request $request){
        $entry = Entry::findOrFail($entry_id);
        $category = Category::findOrFail($request[0]["category_id"]);

        $inputs = $category->dataInputs()->with(['entryRows' => function ($query) use ($entry_id) {
            $query->where('entry_id', $entry_id);
        }])->get();

        return Inertia::render('Entries/Edit',['entry' => $entry,'category' => $category,'inputs' => $inputs]);
    }

    public function store(Request $request){

        $category_id = $request->has('category_id') ? $request['category_id'] : -1;
        $category = Category::findOrFail($category_id);
        $inputs = $category->dataInputs()->get();
        //Create validation rules
        $validation_rules = [];
        foreach ($inputs as $key => $input) {
            $details = json_decode($input->details);
            if($input->required){
                $validation_rules[$input->slug] = "required";
            }
            if(isset($details->validation->rule)){
                if(isset($validation_rules[$input->slug])){
                    $validation_rules[$input->slug] = $validation_rules[$input->slug] . "|" . $details->validation->rule;
                }else{
                    $validation_rules[$input->slug] = $details->validation->rule;
                }
            }
        }
        //Validate
        request()->validate($validation_rules);
        //Save entry and entry rows
        $entry = new Entry();
        $entry->save();
        $entry_user_saved = false;
        foreach ($inputs as $key => $input) {
            $details = json_decode($input->details,true);
            if(!$request[$input->slug])continue;
            $array_input = is_array($request[$input->slug])?$request[$input->slug]:[$request[$input->slug]];
            foreach($array_input as $_input){
                
                $entryRow = new EntryRow();
                $entryRow->value = $_input;
                $entryRow->data_input_id = $input->id;
                $entry_row_user = null;
                $entry_row_details = (object)[];

                if(isset($details["type"])){
                    $entry_row_details->type = $details["type"];
                }

                if(isset($details["type"]) && $details["type"] == "user"){
                    $entry_row_user = User::where("name",$entryRow->value)->first();
                    $category_identifier = array_key_exists($category->identifier,$details["save_as_category"])?$details["save_as_category"][$category->identifier]:"";
                    $save_as_category = Category::where("identifier",$category_identifier)->first();
                    
                    if(!$save_as_category){
                        $save_as_category = $category;
                    }
                    
                    $entry_row_details->user_id = isset($entry_row_user->id)?$entry_row_user->id:null;
                    $entry_row_details->category_id = $save_as_category->id;                    
                }

                $entryRow->details = json_encode($entry_row_details);
                $entryRow->entry()->associate($entry);

                if(isset($details["private"]) && $details["private"] == true){
                    $entryRow->private = true;
                }

                $entryRow->save();

                if($entry_row_user){
                    $entry->users()->save($entry_row_user,['category_id'=>$save_as_category->id,'entry_row_id'=>$entryRow->id]);
                    $entry_user_saved = true;
                }
            }
        }
        if(!$entry_user_saved){
            $entry->users()->save(Auth::user(),['category_id'=>$category_id]);
        }
        return redirect()->back();
    }

    public function update(Request $request,$entry_id){
        $category_id = $request->has('category_id') ? $request['category_id'] : -1;
        $category = Category::findOrFail($category_id);
        $inputs = $category->dataInputs()->get();
        //Create validation rules
        $validation_rules = [];
        foreach ($inputs as $key => $input) {
            $details = json_decode($input->details);
            if($input->required){
                $validation_rules[$input->slug] = "required"; 
            }
            if(isset($details->validation->rule)){
                if(isset($validation_rules[$input->slug])){
                    $validation_rules[$input->slug] = $validation_rules[$input->slug] . "|" . $details->validation->rule;
                }else{
                    $validation_rules[$input->slug] = $details->validation->rule;
                }
            }
        }
        //Validate
        request()->validate($validation_rules);
        //Update entry rows
        $entry = Entry::where('id',$entry_id)->first();
        $entry_user_saved = false;
        foreach ($inputs as $key => $input) {
           $entry->entryRows()->where('data_input_id',$input->id)->delete();
           $details = json_decode($input->details,true);
           if(!$request[$input->slug])continue;
           $array_input = is_array($request[$input->slug])?$request[$input->slug]:[$request[$input->slug]];
           
            foreach($array_input as $_input){
                /*
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
                */
                $entryRow = new EntryRow();
                $entryRow->value = $_input;
                $entryRow->data_input_id = $input->id;
                $entry_row_user = null;
                $entry_row_details = (object)[];

                if(isset($details["type"])){
                    $entry_row_details->type = $details["type"];
                }

                if(isset($details["type"]) && $details["type"] == "user"){
                    $entry_row_user = User::where("name",$entryRow->value)->first();
                    $category_identifier = array_key_exists($category->identifier,$details["save_as_category"])?$details["save_as_category"][$category->identifier]:"";
                    $save_as_category = Category::where("identifier",$category_identifier)->first();
                    
                    if(!$save_as_category){
                        $save_as_category = $category;
                    }
                    
                    $entry_row_details->user_id = isset($entry_row_user->id)?$entry_row_user->id:null;
                    $entry_row_details->category_id = $save_as_category->id;                    
                }

                $entryRow->details = json_encode($entry_row_details);
                $entryRow->entry()->associate($entry);

                if(isset($details["private"]) && $details["private"] == true){
                    $entryRow->private = true;
                }

                $entryRow->save();

                if($entry_row_user){
                    $entry->users()->save($entry_row_user,['category_id'=>$save_as_category->id,'entry_row_id'=>$entryRow->id]);
                    $entry_user_saved = true;
                }
            }
        }
        //Update updated_at timestamps in entry
        $entry->touch();
        //Redirect to same page
        return redirect()->back();
    }

    public function delete($entry_id){
        $entry_user = DB::table('entry_user')
        ->where('user_id',Auth::user()->id)
        ->where('entry_id', $entry_id)
        ->delete();
        $count = DB::table('entry_user')
        ->where('entry_id', $entry_id)
        ->count();
        if(!$count){
            $entry = Entry::where('id',$entry_id)->firstOrFail();
            $entry->entryRows()->withoutGlobalScope('owns')->delete();
            $entry->delete();
        }
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
        return ['id' => $category->id, 'name'=> $category->title, 'children' => $children_data];
    }
}
