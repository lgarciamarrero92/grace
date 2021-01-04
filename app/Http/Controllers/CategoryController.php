<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function reorder(Request $request){
        $categoryItemOrder = json_decode($request->input('order'));
        $this->orderCategory($categoryItemOrder, null);
    }
    private function orderCategory(array $categoryItems, $parentId)
    {
        foreach ($categoryItems as $index => $categoryItem) {
            $item = Category::findOrFail($categoryItem->id);
            $item->order = $index + 1;
            $item->parent_id = $parentId;
            $item->save();

            if (isset($categoryItem->children)) {
                $this->orderCategory($categoryItem->children, $item->id);
            }
        }
    }
}
