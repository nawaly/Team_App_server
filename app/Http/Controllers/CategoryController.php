<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    public function getCategories()
    { //returns all categories
        $categories = Category::all(); //ClassName::

        return response()->json([
         'categories'=>$categories
        ],200);
    }
    public function getCategory($categoryid)
    {
        $category = Category::find($categoryid);
        if(!$category){

            return response()->json([
                'error'=>"Category not found"
            ],404);
        };
        return response()->json(['category'=>$category],200);
    }
    public function postCategory(Request $request)
    {
        $validator = Validator::make($request->all(),[
        'name'=>'required',
        'icon'=>'required',
        'color'=>'required',
         ]);

        if($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors(),
                'status' => false
            ],404);
        }
        $category = new Category(); Category;
        $category->name= request('name');
        $category->icon= request('icon');
        $category->color= request('color');
        $category->save(); //saves category


        return response()->json([
            'category'=>$category
        ],201);
    }

    public function putCategory(Request $request, $categoryid)
    {
        $validator=Validator::make($request->all(),[
        'name'=>'required',
        'color'=>'required',
        'icon'=>'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors(),
                'status' => false
            ],404);
        };
        $category = Category::find($categoryid);
        if(!$category){
            return response()->json([
                'error'=>"Category not found"
            ],404);
        };
        $category->update([
        'name'=>$request->input('name'),
        'color'=>$request->input('color'),
        'icon'=>$request->input('icon'),

        ]);
        return response()->json([
            'category'=>$category
        ]);
     }
    public function deleteCategory($categoryid)
    { $category = Category::find($categoryid);
        if(!$category){
            return response()->json([
                'error'=>"Category not found"
            ],404);}
            $category->delete();{
                return response()->json([
                    'message'=>"Category deleted successfully"],200);
            }

}
}
