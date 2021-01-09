<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Auth;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;

class AchievementsController extends Controller
{
    public function all_inputs_of_node(Category $node)
    {
        if($node->isLeaf()){
            return (object)[ 'id' => $node->id,
                     'name'=> $node->title,
                     'type' => 'leaf',
                     'leafs' => Category::join('category_data_input', 'categories.id', '=', 'category_data_input.category_id')
                             ->join('data_inputs', 'category_data_input.data_input_id', '=', 'data_inputs.id')
                             ->where('categories.id', '=', $node->id)
                             ->select('data_inputs.*')
                             ->get()];
        }

        $children = $node->children()->get();
        $children_data = [];

        foreach($children as $child){
            $items = $this->all_inputs_of_node($child);
            $children_data[] = $items;
        }

        return ['id' => $node->id, 'name'=>$node->title, 'children' => $children_data];

    }

    /**
    * @OA\Get(
    *     path="/api/inputs-from-id/{id}",
    *     summary="Mostrar inputs de determinado título",
    *     tags={"logros"},
    *     @OA\Parameter(
    *         name="id",
    *         description="Id de categoría",
    *         required=true,
    *         in="path",
    *         @OA\Schema(
    *             type="integer"
    *         ),
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar inputs de determinado título."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
    public function all_inputs_from_id($id){
        $node = Category::where('id', '=', $id)->first();
        return $this->all_inputs_of_node($node);

    }

    /**
    * @OA\Get(
    *     path="/api/achievements/user/{id}",
    *     summary="Mostrar logros de determinado usuario",
    *     tags={"logros"},
    *     @OA\Parameter(
    *         name="id",
    *         description="Id del usuario",
    *         required=true,
    *         in="path",
    *         @OA\Schema(
    *             type="integer"
    *         ),
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar logros de determinado usuario."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
    public function all_achievements_from_user_id($id){
        $user = User::findOrFail($id);

        return [];
    }


    public function create(){
        //return view('achievements.create');
        $root_nodes = Category::where('parent_id', '=', null)->get();
        $result = [];

        foreach($root_nodes as $node){
            $result[] = $this->all_inputs_of_node($node);
        }

        return Inertia::render('Achievements/Create', [
            'achievements' => $result
        ]);
    }
}
