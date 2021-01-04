<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class AchievementsController extends Controller
{
    public function all_inputs_of_node(Category $node)
    {
        if($node->isLeaf()){
            return [ 'title'=>$node->title,
                     'children' => Category::join('category_data_row', 'categories.id', '=', 'category_data_row.category_id')
                             ->join('data_rows', 'category_data_row.data_row_id', '=', 'data_rows.id')
                             ->where('categories.id', '=', $node->id)
                             ->select('data_rows.*')
                             ->get()];
        }

        $children = $node->children()->get();
        $children_data = [];

        foreach($children as $child){
            $items = $this->all_inputs_of_node($child);
            $children_data[] = [$items];
        }

        return ['title'=>$node->title, 'children' => $children_data];

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
    public function all_inputs_from_id(Request $request, $id){
        $node = Category::where('id', '=', $id)->first();
        return $this->all_inputs_of_node($node);

    }
}
